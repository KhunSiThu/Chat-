<?php

session_start();

include_once "db_connect.php";
$uniqueId = $_SESSION['unique_id'];

$sql = "select * from friendRequests left join users on users.unique_id = friendRequests.request_id where forConfirm_id = $uniqueId";
$Query = mysqli_query($conn, $sql);

$response = '
<h2>                <a href="../main-page.php" class="desk-dis-none"><i class="fa-solid fa-arrow-left mr-4"></i></a>
 Friend Requests <span class="req-count">' . mysqli_num_rows($Query) . '</span></h2>
<ul class="friReq-list w-full">
';

if (mysqli_num_rows($Query) > 0) {
    while ($friReq = mysqli_fetch_assoc($Query)) {
        $response .= '
         <li class="flex items-center cursor-pointer ">

            <a href="" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="' . $friReq['profile_image'] . '"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">' . $friReq['name'] . '</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <a href="../PHP/addFriend.php?friId='.$friReq['unique_id'].'" class=" btn-primary flex justify-center items-center confirm-btn">
                Confirm
            </a>

        </li>';
    }
}

echo $response.='    
    </ul>';

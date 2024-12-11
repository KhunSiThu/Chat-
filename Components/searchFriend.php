<?php
include_once "./PHP/db_connect.php";

session_start();

if(isset($_GET["search"]))
{
    $search = $_GET["search"];
}

$uniqueId = $_SESSION['unique_id'];

$sql5 = "select * from users where unique_id !=".$uniqueId;

$Query5 = mysqli_query($conn, $sql5);

?>

<div class="searchFriend-con">

    <div class="searchFriend">

        <div class="search-con">
            <form action="../main-page.php"  class="searchForm flex justify-between relative my-6  p-3 rounded-md border border-color">

                <input class="text-sm outline-none bg-transparent px-1 w-[330px] " placeholder="Search Friends ..." name="search" value="<?= isset($search) ? $search : '' ?>" />

                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                </button>

            </form>
        </div>

        <!-- <div class="search-menu">
            <button>All</button>
            <button>Requests</button>
            <button>Follow</button>
        </div> -->

        <hr>

        <div class="friList-con">


            <ul class="friend-list">


                <?php


                while ($allUser = mysqli_fetch_assoc($Query5)) :

                    if (str_contains(strtolower($allUser['name']), strtolower($search))) {


                ?>
                            <li class="flex items-center justify-between cursor-pointer">

                                <div class="flex items-center">
                                    <img src="<?= $allUser['profile_image'] ?>"
                                        class="rounded-full border-color shrink-0 pro" />
                                    <div class="ml-3">
                                        <h1 class="text-sm whitespace-nowrap mb-1"><?= $allUser['name'] ?></h1>
                                        <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                                    </div>



                                </div>

                                <?php

                                $req = "select * from friendRequests where request_id =".$uniqueId." and  forConfirm_id=".$allUser['unique_id'];
                                $con = "select * from friendRequests where forConfirm_id =".$uniqueId." and  request_id=".$allUser['unique_id'];
                                $fri = "select * from friendList where (request =$uniqueId and  confirm=".$allUser['unique_id'].") or (confirm =$uniqueId and request=".$allUser['unique_id'].")";

                                $reqQuery = mysqli_query($conn, $req);

                                $checkReq = mysqli_fetch_assoc($reqQuery);

                                $conQuery = mysqli_query($conn, $con);

                                $checkCon = mysqli_fetch_assoc($conQuery);

                                $friQuery = mysqli_query($conn, $fri);

                                $checkFri = mysqli_fetch_assoc($friQuery);
                                

                                if($checkReq) {

                                ?>

                                <a href="#" class="btn-primary opacity-60">
                                    Request
                                </a>

                                <?php
                                } else if($checkCon){
                                    ?>

                                <a href="#" class=" btn-primary">
                                    Confirm
                                </a>

                                <?php
                                } else if($checkFri){
                                    ?>

                                <a href="#" class=" btn-primary">
                                    Unfriend
                                </a>

                                <?php

                                } else {

                                ?>

                                <a href="../PHP/friendRequest.php?friendId=<?=$allUser['unique_id']?>&search=<?=$search?>" class=" btn-primary">
                                    Add
                                </a>

                                <?php
                                }
                                ?>

                            </li>

                        <?php } endwhile; ?>





        </div>
    </div>

</div>


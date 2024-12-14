<?php
include_once "./PHP/db_connect.php";

session_start();

// Ensure uniqueId is set, if not, redirect to login
$uniqueId = $_SESSION['unique_id'] ?? null;
if (!$uniqueId) {
    header("Location: ../login.php");
    exit;
}

// Query to get friend list
$sql1 = "SELECT * FROM `friendList` 
         LEFT JOIN users ON users.unique_id = friendList.request OR users.unique_id = friendList.confirm 
         WHERE (request = $uniqueId OR confirm = $uniqueId) 
         ORDER BY name;";

$Query1 = mysqli_query($conn, $sql1);
?>

<nav id="sidebar2" class="desk-side-2 transition-all duration-500 z-[100]">
    <div class="side2-header flex justify-between">
        <div class="flex items-center justify-between">
            <a href="javascript:void(0)" class="flex items-center gap-2 log-con">
                <img src="./images/chat.png" alt="">
                <h1 class="text-base font-semibold tracking-wide">Chat!</h1>
            </a>
        </div>

        <div class="mob-menu-btns">
            <a href="../mobile/friendRequestMob.php">
                <i class="fa-solid fa-user-group"></i>
            </a>

            <button class="menu-show-btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>

    <hr id="hr" />

    <div class="friList-con">
        <ul class="friend-list mt-1">
            <?php
            while ($allUser = mysqli_fetch_assoc($Query1)):
                // Avoid showing current user's own data
                if ($allUser['unique_id'] != $uniqueId):
            ?>
                    <li class="flex items-center cursor-pointer phone-dis-none">
                        <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center w-full">
                            <div class="con">
                                <img src="<?= !empty($allUser['profile_image']) ? $allUser['profile_image'] : './images/default-profile.png' ?>"
                                    class="rounded-full border-color shrink-0 pro" />
                                <?php
                                if ($allUser['status'] === "Active now") {
                                    echo '<i class="fa-solid fa-circle active"></i>';
                                }
                                ?>


                            </div>
                            <div class="ml-3">
                                <h1 class="whitespace-nowrap mb-1"><?= $allUser['name'] ?></h1>
                                <p class="text-xs whitespace-nowrap text-muted">Active free account</p>
                            </div>
                        </a>

                        <button class="fri-control">
                            <i class="fa-solid fa-ellipsis-vertical text-2xl"></i>
                        </button>
                    </li>

                    <li class="items-center cursor-pointer desk-dis-none">
                        <a href="../mobile/chat-room.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center w-full">
                            <div class="con">
                                <img src="<?= !empty($allUser['profile_image']) ? $allUser['profile_image'] : './images/default-profile.png' ?>"
                                    class="rounded-full border-color shrink-0 pro" />
                                <i class="fa-solid fa-circle active"></i>
                            </div>
                            <div class="ml-3">
                                <h1 class="whitespace-nowrap mb-1"><?= $allUser['name'] ?></h1>
                                <p class="text-xs whitespace-nowrap text-muted">Active free account</p>
                            </div>
                        </a>

                        <button class="fri-control">
                            <i class="fa-solid fa-ellipsis-vertical text-2xl"></i>
                        </button>
                    </li>

            <?php
                endif;
            endwhile;
            ?>
        </ul>
    </div>

    <!-- Add Friend Button -->
    <a href="../main-page.php?search" class="add-friend-btn btn-primary phone-dis-none">
        <i class="fa-solid fa-user-plus"></i>
    </a>

    <a href="../mobile/searchFriend.php?search" class="add-friend-btn add-friend-btn-phone btn-primary desk-dis-none">
        <i class="fa-solid fa-user-plus"></i>
    </a>
</nav>
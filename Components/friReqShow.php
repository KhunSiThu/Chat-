<?php
include_once "./PHP/db_connect.php";

session_start();

$sql3 = "select * from users where unique_id = $uniqueId";
$Query3 = mysqli_query($conn, $sql3);
$youData = mysqli_fetch_assoc($Query3);

?>

<nav id="friReqShow" class=" transition-all duration-500  z-[100]">

<h2>Friend Requests</h2>

    <ul class="friReq-list w-full">
        
        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>

        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>

        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>

        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>

        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>

        <li class="flex items-center cursor-pointer ">

            <a href="main-page.php?chooseFri=<?= $allUser['unique_id'] ?>" class="flex items-center cursor-pointer w-full ">
                <div class="con mr-3">
                    <img src="<?= $allUser['profile_image'] ?>"
                        class="rounded-full border-color shrink-0 pro" />
                    <!-- <i class="fa-solid fa-circle active"></i> -->
                </div>
                <div class="ml-3">
                    <h1 class="whitespace-nowrap mb-1">Khun Si Thu</h1>
                    <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                </div>
            </a>

            <button class="btn btn-primary flex justify-center items-center">
                Confirm
            </button>

        </li>
    </ul>

</nav>
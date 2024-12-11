<?php
session_start();



if (isset($_GET["chooseFri"])) {
  $_SESSION["chooseFri"] = $_GET["chooseFri"];
}

include_once "./PHP/db_connect.php";



$uniqueId = $_SESSION['unique_id'];

?>

<?php require_once "./Components/header.php"; ?>


<div id="main-page" class="relativeh-full min-h-screen font-[sans-serif]">
  <div class="flex justify-between">

    <?php require_once "./Components/sidebar2.php"; ?>

    <div class="main-container">

      <?php if (isset($_GET["search"])) { ?>

        <?php require_once "./Components/searchFriend.php"; ?>

      <?php } else { ?>

      <?php require_once "./Components/chat-room.php"; ?>

      <?php  } ?>

      <?php require_once "./Components/themes.php"; ?>

    </div>

    <?php require_once "./Components/sidebar3.php"; ?>

  </div>
</div>



<?php require_once "./Components/footer.php"; ?>
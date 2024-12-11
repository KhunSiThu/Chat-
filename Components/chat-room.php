<?php
  session_start();

if (!isset($_SESSION['unique_id'])) {
  header("location: login.php");
}

if (isset($_SESSION['chooseFri'])) {

  include_once "./PHP/db_connect.php";



  $chooseFri = $_SESSION['chooseFri'];

  $sql2 = "select * from users where unique_id = $chooseFri";
  $Query2 = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($Query2);

?>

  <section class="chat-room">


    <div class="flex justify-between chat-nav items-center ">

      <div class="flex items-center  ">
        <img class="pro border-color" src="<?= $row['profile_image'] ?>"
          class="w-16 h-16 rounded-full border-color border-2 shrink-0" />
        <div class="ml-4">
          <h1 class="text-2xl whitespace-nowrap"><?= $row['name'] ?></h1>
          <p class="text-xs whitespace-nowrap 
          <?= $row['status'] === "Active now" ? "active" : "text-muted"; ?>
          "><?= $row['status'] === "Active now" ? "Active now" : "Line Out"; ?></p>
        </div>
      </div>

      <i class="fa-solid fa-ellipsis-vertical text-2xl"></i>
    </div>

    <div class="chat-container p-10">



    </div>

    <form id="send-message-form" action="../index.php" class="flex justify-center chat-box" method="post">

      <input hidden name="uniqueId" id="send" type="text" value="<?= $uniqueId ?>">
      <input hidden name="receive" id="receive" type="text" value="<?= $chooseFri ?>">

      <div class="flex justify-between border-color">

        <button class="sendImg-btn btn btn-primary">
          <i class="fa-solid fa-image"></i>
        </button>

        <input type="text" name="message" class="sendText">

        
      </div>

      <button class="send-message-btn btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>

    </form>



  </section>

<?php } else { ?>

  <section class="no-chat-con">
    <div>
      <img src="../images/chat.png" alt="">
      <h1>Chat!</h1>
    </div>
  </section>

<?php } ?>
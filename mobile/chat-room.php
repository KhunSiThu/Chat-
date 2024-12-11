<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <link rel="stylesheet" href="../CSS/output.css">

    <link rel="stylesheet" href="../CSS/style.css">

    <link rel="stylesheet" href="../CSS/responsive.css">


</head>

<body>


<?php
  session_start();

if (!isset($_SESSION['unique_id'])) {
  header("location: ../PHP/login.php");
}

if (isset($_GET['chooseFri'])) {

  include_once "./db_connect.php";


  $_SESSION['chooseFri'] = $_GET['chooseFri'];

  $chooseFri = $_SESSION['chooseFri'];

  $sql2 = "select * from users where unique_id = $chooseFri";
  $Query2 = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($Query2);

?>

  <section class="chat-room">


    <div class="flex justify-between chat-nav items-center ">

    <a href="../main-page.php" class="desk-dis-none "><i class="fa-solid fa-arrow-left text-2xl"></i></a>

      <div class="flex items-center  ">
        <img class="pro border-color" src="<?= $row['profile_image'] ?>"
          class="w-16 h-16 rounded-full border-color border-2 shrink-0" />
        <div class="ml-4">
          <h1 class="text-xl whitespace-nowrap"><?= $row['name'] ?></h1>
          <p class="text-xs whitespace-nowrap 
          <?= $row['status'] === "Active now" ? "active" : "text-muted"; ?>
          "><?= $row['status'] === "Active now" ? "Active now" : "Line Out"; ?></p>
        </div>
      </div>

      <i class="fa-solid fa-ellipsis-vertical text-xl"></i>
    </div>

    <div class="chat-container p-5">



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

  <h1>Choose Friend</h1>

<?php } ?>



    <!-- <script src="../JS/main-page.js"></script> -->
<script src="./chat-room.js"></script>

</body>

<script src="../node_modules/flyonui/flyonui.js"></script>

<script>
  var root = document.querySelector(":root");
  
  const changeBG = () => {
    root.style.setProperty('--light-color-lightness', lightColorLightness);
    root.style.setProperty('--white-color-lightness', whiteColorLightness);
    root.style.setProperty('--dark-color-lightness', darkColorLightness);
}


 if(localStorage.getItem("primaryHue")) {
    root.style.setProperty('--primary-color-hue', localStorage.getItem("primaryHue"));
 }

 if(localStorage.getItem("dark"))
    {
       darkColorLightness = localStorage.getItem("dark");
       whiteColorLightness = localStorage.getItem("white");
       lightColorLightness = localStorage.getItem("light",);
   
       changeBG();
    }
</script>

</html>
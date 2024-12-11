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
    include_once "../PHP/db_connect.php";

    session_start();

    if (isset($_GET["search"])) {
        $search = $_GET["search"];
    }

    $uniqueId = $_SESSION['unique_id'];

    $sql5 = "select * from users where unique_id !=" . $uniqueId;

    $Query5 = mysqli_query($conn, $sql5);

    ?>



    <div class="searchFriend-con">

        <div class="searchFriend">

            <div class="search-con">
                <a href="../main-page.php" class="desk-dis-none"><i class="fa-solid fa-arrow-left"></i></a>
                <form action="./searchFriend.php" class="searchForm flex justify-between relative my-6  p-3 rounded-md border border-color">

                   

                    <input class="text-sm outline-none bg-transparent px-1 w-[330px] " placeholder="Search Friends ..." name="search" value="<?= isset($search) ? $search : '' ?>" />

                    <button type="submit">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    </button>

                </form>
            </div>


            <div class="friList-con">


                <ul class="friend-list">


                    <?php

                     $resultCount = 0;


                    while ($allUser = mysqli_fetch_assoc($Query5)) :

                        

                        if (str_contains(strtolower($allUser['name']), strtolower($search))) {

                           $resultCount++; 


                    ?>
                            <li class="flex items-center justify-between cursor-pointer">

                                <div class="flex items-center">
                                    <img src="<?= $allUser['profile_image'] ?>" class="pro" />
                                    <div class="ml-3">
                                        <h1 class="text-sm whitespace-nowrap mb-1"><?= $allUser['name'] ?></h1>
                                        <p class="text-xs whitespace-nowrap text-muted ">Active free account</p>
                                    </div>



                                </div>

                                <?php

                                $req = "select * from friendRequests where request_id =" . $uniqueId . " and  forConfirm_id=" . $allUser['unique_id'];
                                $con = "select * from friendRequests where forConfirm_id =" . $uniqueId . " and  request_id=" . $allUser['unique_id'];
                                $fri = "select * from friendList where (request =$uniqueId and  confirm=" . $allUser['unique_id'] . ") or (confirm =$uniqueId and request=" . $allUser['unique_id'] . ")";

                                $reqQuery = mysqli_query($conn, $req);

                                $checkReq = mysqli_fetch_assoc($reqQuery);

                                $conQuery = mysqli_query($conn, $con);

                                $checkCon = mysqli_fetch_assoc($conQuery);

                                $friQuery = mysqli_query($conn, $fri);

                                $checkFri = mysqli_fetch_assoc($friQuery);


                                if ($checkReq) {

                                ?>

                                    <a href="#" class="btn-primary opacity-60">
                                        Request
                                    </a>

                                <?php
                                } else if ($checkCon) {
                                ?>

                                    <a href="#" class=" btn-primary">
                                        Confirm
                                    </a>

                                <?php
                                } else if ($checkFri) {
                                ?>

                                    <a href="#" class=" btn-primary">
                                        Unfriend
                                    </a>

                                <?php

                                } else {

                                ?>

                                    <a href="../PHP/friendRequest.php?friendId=<?= $allUser['unique_id'] ?>&search=<?= $search ?>&mobile" class=" btn-primary">
                                        Add
                                    </a>

                                <?php
                                }
                                ?>

                            </li>

                    <?php }
                    endwhile; 
                    
                    if($resultCount < 1) :
                    ?>

                        <h2 class="mt-10">No Results Try again! ... </h2>
                    <?php endif; ?>



            </div>
        </div>

    </div>



    <!-- <script src="../JS/main-page.js"></script> -->


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
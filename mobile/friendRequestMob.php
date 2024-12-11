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


    <div class="mobile-friReq">
        <div class="friReq-list-con2">

        </div>
    </div>



    <!-- <script src="../JS/main-page.js"></script> -->


</body>

<script src="../node_modules/flyonui/flyonui.js"></script>

<script>
// Get Friends Request 

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./get-friReq.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          let data = xhr.response;
          document.querySelector(".friReq-list-con2").innerHTML = data;
        }
      }
    };
  
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
  }, 500);


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
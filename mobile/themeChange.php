<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/output.css">

    <style>
        .customize-theme {
            display: block;
            width: 100vw;
            position: relative;
           

            .close-theme {
                background-color: var(--color-white);
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 20px;
        
            }

            h2 {
                font-size: 20px;
                font-weight: bold;
            }

            p {
                color: var(--color-primary);
                font-size: 20px;
            }

            .card {
                width: 100%;
                height: 80vh;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                background: none;

                padding: 30px;

                h4 {
                    margin-bottom: 20px;
                }
            }

            .background {
               
                width: 100%;
                padding: 0;
                    margin: 0;
                    gap: 0;

                .choose-bg {
                    
                    padding: 0;
                    margin: 0;
                    width: 28%;

                    div {
                        padding: 10px;
                    margin: 0;
                    }
                }
            }
        }
    </style>
</head>

<body>

    <div class="customize-theme">
        <div class="flex w-full justify-end close-theme">
            <h2 >Customize your view</h2>
            <a href="../main-page.php" class="m-5"><i class="fa-solid fa-xmark text-3xl fa-fade "></i></i></a>
        </div>
        <div class="card">

            
            <p class="">Manage your font size, color, and background.</p>

            <div class="font-size">
                <h4>Font Size</h4>
                <div>
                    <h6>Aa</h6>
                    <div class="choose-size">
                        <span class="font-size-1 fontSize"></span>
                        <span class="font-size-2 fontSize active"></span>
                        <span class="font-size-3 fontSize"></span>
                        <span class="font-size-4 fontSize"></span>
                        <span class="font-size-5 fontSize"></span>
                    </div>
                    <h3>Aa</h3>
                </div>
            </div>

            <div class="color">
                <h4>Color</h4>
                <div class="choose-color">
                    <span class="color-1 active"></span>
                    <span class="color-2"></span>
                    <span class="color-3"></span>
                    <span class="color-4"></span>
                    <span class="color-5"></span>
                </div>
            </div>

            <div class="background">
                <h4>Background</h4>
                <div class="choose-bg">

                    <div class="bg-1 active">
                        <span></span>
                        <h5 for="bg-1">Light</h5>
                    </div>
                    <div class="bg-2">
                        <span></span>
                        <h5 for="bg-2">Dim</h5>
                    </div>
                    <div class="bg-3">
                        <span></span>
                        <h5 for="bg-3">Lights</h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Theme 

    const theme = document.querySelector("#theme");
    const themeModal = document.querySelector(".customize-theme");
    const fontSizes = document.querySelectorAll(".fontSize");
    var root = document.querySelector(":root");
    const colorPalette = document.querySelectorAll(".choose-color span");
    const Bg1 = document.querySelector(".bg-1");
    const Bg2 = document.querySelector(".bg-2");
    const Bg3 = document.querySelector(".bg-3");

    const chatRoom = document.querySelector(".chat-room");


    const changeBG = () => {
        root.style.setProperty('--light-color-lightness', lightColorLightness);
        root.style.setProperty('--white-color-lightness', whiteColorLightness);
        root.style.setProperty('--dark-color-lightness', darkColorLightness);
    }


    if (localStorage.getItem("primaryHue")) {
        root.style.setProperty('--primary-color-hue', localStorage.getItem("primaryHue"));
    }

    if (localStorage.getItem("dark")) {
        darkColorLightness = localStorage.getItem("dark");
        whiteColorLightness = localStorage.getItem("white");
        lightColorLightness = localStorage.getItem("light", );

        changeBG();
    }

    //  const openThemeModal = () => {
    //      themeModal.style.display = "grid";
    //      // chatRoom.style.display = "none";
    //  }

    //  const closeThemeModal = (e) => {
    //      if (e.target.classList.contains("customize-theme")) {
    //          themeModal.style.display = "none";
    //          // chatRoom.style.display = "block";
    //      }
    //  }

    //  themeModal.addEventListener("click", closeThemeModal);

    //  theme.addEventListener("click", openThemeModal);

    const removeSizeSelector = () => {
        fontSizes.forEach(size => {
            size.classList.remove('active');
        })
    }

    const changeActiveColorClass = () => {
        colorPalette.forEach(color => {
            color.classList.remove("active");
        })
    }


    colorPalette.forEach(color => {
        color.addEventListener('click', () => {
            let primaryHue;

            changeActiveColorClass();

            if (color.classList.contains('color-1')) {
                primaryHue = 252;
            } else if (color.classList.contains('color-2')) {
                primaryHue = 52;
            } else if (color.classList.contains('color-3')) {
                primaryHue = 352;
            } else if (color.classList.contains('color-4')) {
                primaryHue = 152;
            } else if (color.classList.contains('color-5')) {
                primaryHue = 202;
            }

            color.classList.add("active");

            localStorage.setItem("primaryHue", primaryHue);

            root.style.setProperty('--primary-color-hue', primaryHue);
        });
    });








    Bg1.addEventListener('click', () => {

        localStorage.removeItem("dark");
        localStorage.removeItem("white");
        localStorage.removeItem("light");

        Bg1.classList.add('active');
        Bg2.classList.remove('active');
        Bg3.classList.remove('active');
        window.location.reload();
        changeBG();
    });

    Bg2.addEventListener('click', () => {

        darkColorLightness = "95%";
        whiteColorLightness = "20%";
        lightColorLightness = "15%";

        localStorage.setItem("dark", "95%");
        localStorage.setItem("white", "20%");
        localStorage.setItem("light", "15%");

        Bg1.classList.remove('active');
        Bg2.classList.add('active');
        Bg3.classList.remove('active');

        changeBG();
    });

    Bg3.addEventListener('click', () => {

        darkColorLightness = "95%";
        whiteColorLightness = "10%";
        lightColorLightness = "0%";

        localStorage.setItem("dark", "95%");
        localStorage.setItem("white", "10%");
        localStorage.setItem("light", "0%");

        Bg1.classList.remove('active');
        Bg2.classList.remove('active');
        Bg3.classList.add('active');

        changeBG();
    });
</script>

</html>
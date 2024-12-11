


// Get Friends Request 

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./PHP/get-friReq.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          let data = xhr.response;
          document.querySelector(".friReq-list-con").innerHTML = data;
        }
      }
    };
  
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
  }, 500);


 
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

 const openThemeModal = () => {
     themeModal.style.display = "grid";
     // chatRoom.style.display = "none";
 }

 const closeThemeModal = (e) => {
     if (e.target.classList.contains("customize-theme")) {
         themeModal.style.display = "none";
         // chatRoom.style.display = "block";
     }
 }

 themeModal.addEventListener("click", closeThemeModal);

 theme.addEventListener("click", openThemeModal);

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

         localStorage.setItem("primaryHue",primaryHue);

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

     localStorage.setItem("dark","95%");
     localStorage.setItem("white","20%");
     localStorage.setItem("light","15%");

     Bg1.classList.remove('active');
     Bg2.classList.add('active');
     Bg3.classList.remove('active');

     changeBG();
 });

 Bg3.addEventListener('click', () => {

     darkColorLightness = "95%";
     whiteColorLightness = "10%";
     lightColorLightness = "0%";

     localStorage.setItem("dark","95%");
     localStorage.setItem("white","10%");
     localStorage.setItem("light","0%");

     Bg1.classList.remove('active');
     Bg2.classList.remove('active');
     Bg3.classList.add('active');

     changeBG();
 });

 //  Search Show

 const addFriendBtn = document.querySelector(".add-friend-btn");
 const searchFriendCon = document.querySelector(".searchFriend-con");
 
 addFriendBtn.addEventListener("click", () => {
     themeModal.style.display = "none";
     chatRoom.style.display = "none";
     document.querySelector('#search-link').click();
     
 })

  //For mobile Phone 

const mainContainer = document.querySelector(".main-container");

const friReqShowBtn = document.querySelector(".friReq-show-btn");
const menuShowBtn = document.querySelector(".menu-show-btn");
const sidebar2 = document.querySelector("#sidebar2");
const sidebar3 = document.querySelector("#sidebar3");



  menuShowBtn.addEventListener("click", () => {
    sidebar3.style.display = 'flex';
    sidebar2.style.display = "none";
    document.querySelector("#sidebar3 .menu").style.display = "flex";

    document.querySelector(".phone-menu-close").addEventListener("click",() => {
        sidebar3.style.display = 'none';
        sidebar2.style.display = "block";
    });

    theme.classList.add("phoneTheme");

    const phoneTheme = document.querySelector(".phoneTheme");

    phoneTheme.addEventListener("click", () => {
        sidebar3.style.display = 'none';
        mainContainer.style.display = "block";
    })
  })

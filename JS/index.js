const signUp = document.querySelector(".signUp");
const login = document.querySelector(".login");

const loginLink = document.querySelector(".signUp .login-link");
const signUpLink = document.querySelector(".login .signUp-link");
const loginBtn = document.querySelector("#login-btn");

const eyeIcon = document.querySelector(".eye-icon");
const eyeIcon1 = document.querySelector(".eye-icon1");
const eyeIcon2 = document.querySelector(".eye-icon2");
const pass = document.querySelector("#password");
const pass1 = document.querySelector("#password1");
const pass2 = document.querySelector("#password2");
const fullName = document.querySelector("#fullName");
const email = document.querySelector("#email");
const email1 = document.querySelector("#email1");

const submitButton = document.querySelector("#submit-btn");
const password1Message = document.querySelector("#password1-message");
const password2Message = document.querySelector("#password2-message");

// document.querySelector("#email").addEventListener("input",() => {
//     document.querySelector("#email-error").classList.add("hidden");
// })


// Toggle between Sign Up and Login
signUpLink.addEventListener("click", () => {
  signUp.classList.remove("hidden");
  login.classList.add("hidden");
});

loginLink.addEventListener("click", () => {
  signUp.classList.add("hidden");
  login.classList.remove("hidden");
});

// Toggle visibility of password
eyeIcon.addEventListener("click", () => {
    if (eyeIcon.classList.contains("fa-eye-slash")) {
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
        pass.type = "text";
    } else {
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
        pass.type = "password";
    }
});

eyeIcon1.addEventListener("click", () => {
    if (eyeIcon1.classList.contains("fa-eye-slash")) {
        eyeIcon1.classList.remove("fa-eye-slash");
        eyeIcon1.classList.add("fa-eye");
        pass1.type = "text";
    } else {
        eyeIcon1.classList.remove("fa-eye");
        eyeIcon1.classList.add("fa-eye-slash");
        pass1.type = "password";
    }
});

eyeIcon2.addEventListener("click", () => {
    if (eyeIcon2.classList.contains("fa-eye-slash")) {
        eyeIcon2.classList.remove("fa-eye-slash");
        eyeIcon2.classList.add("fa-eye");
        pass2.type = "text";
    } else {
        eyeIcon2.classList.remove("fa-eye");
        eyeIcon2.classList.add("fa-eye-slash");
        pass2.type = "password";
    }
});

let isPassword1Valid = false;
let isPassword2Valid = false;

// Password validation for password1 (Create Password)
pass1.addEventListener("input", function () {
    const password = pass1.value;
    let isValid = true;

    // Check password length
    if (password.length < 8) {
        password1Message.innerHTML = "<i class='fa-solid fa-circle-exclamation fa-fade'></i> Password must be at least 8 characters.";
        password1Message.style.color = "red";
        isValid = false;
        localStorage.removeItem("valid");
    } 

    // Check for uppercase letter
    if (!/[A-Z]/.test(password)) {
        password1Message.innerHTML = "<i class='fa-solid fa-circle-exclamation fa-fade'></i> Password must contain at least one uppercase letter.";
        password1Message.style.color = "red";
        isValid = false;
        localStorage.removeItem("valid");
    } 

    // Check for a number
    if (!/\d/.test(password)) {
        password1Message.innerHTML = "<i class='fa-solid fa-circle-exclamation fa-fade'></i> Password must contain at least one number.";
        password1Message.style.color = "red";
        isValid = false;
        localStorage.removeItem("valid");
    }  

    isPassword1Valid = isValid;

    // Check for a number
    if (isPassword1Valid) {
        password1Message.innerHTML = "<i class='fa-regular fa-circle-check fa-fade'></i> Password is correct.";
        password1Message.style.color = "green";
        isValid = false;
        localStorage.setItem("valid",true);
    }

    
});

// Password match check for password2 (Confirm Password)
pass2.addEventListener("input", function () {
    const password1 = pass1.value;
    const password2 = pass2.value;

    if (password2 !== password1) {
        password2Message.innerHTML = "<i class='fa-solid fa-circle-exclamation fa-fade'></i> Passwords do not match.";
        password2Message.style.color = "red";
        isPassword2Valid = false;
        submitButton.type = "button";
    } else {
        password2Message.innerHTML = "<i class='fa-regular fa-circle-check fa-fade'></i> Passwords match.";
        password2Message.style.color = "green";
        isPassword2Valid = true;
    }

   
});



// Ensure the input fields are focused if they are empty
submitButton.addEventListener("click", function () {
    if (!fullName.value) {
        fullName.focus();
    } else if (!email.value) {
        email.focus();
    } else if (!pass1.value) {
        pass1.focus();
    } else if (!pass2.value) {
        pass2.focus();
    }  else {
        isPassword1Valid = localStorage.getItem("valid")
        if(isPassword1Valid && pass1.value == pass2.value) {
            localStorage.removeItem("valid");
            submitButton.type = "submit";
        }
    }
});



loginBtn.addEventListener("click", function () {
if (!email1.value) {
        email1.focus();
    } else if (!pass.value) {
        pass.focus();
    } else {
        loginBtn.type = "submit"
    }
});


// hiddenError("#email","#email-error");
// hiddenError("#email1","#email-error1");
// hiddenError("#password","#email-error2");

// function hiddenError ($a,$b) {
//     document.querySelector($a).addEventListener("input",() => {
//         document.querySelector($b).classList.add("hidden");
//     })
// }

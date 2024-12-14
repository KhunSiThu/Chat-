<?php 

require_once "./Components/header.php"; 

session_start(); 

if($_SESSION['unique_id']) {

    include_once "./PHP/db_connect.php"; 

    $sql = "select status from users where unique_id =" . $_SESSION['unique_id'];
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($query);

    if($row['status'] === "Active now") {
        header("Location:./main-page.php?");
    }
}

?>



<!-- Sign Up -->
<div class="signUp flex w-screen h-screen justify-center items-center 
<?= $_GET['response'] == "success" ? "hidden" : "" ?>
<?= isset($_GET['response']) ? "" : "hidden" ?>
">
    <div class="flex flex-col min-w-full justify-center p-10 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col justify-center items-center">
            <div class="chatLog-con flex justify-center items-center">
                <img class="" src="./images/chat.png" alt="Your Company" />
            </div>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                Sign up for your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="./PHP/signUp.php" method="POST">
                <div>
                    <label for="fullName" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="fullName" required
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="text" name="email" id="email" autocomplete="email" required
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>

                    <?php if ($_GET['response'] != "success") : ?>
                        <p id="email-error" class="text-red-500 mt-2 text-sm"><?= $_GET['response'] ?></p>
                    <?php endif; ?>
                </div>

                <!-- Gender Selection -->
                <div>
                    <label for="hs-select-label" class="block text-sm/6 font-medium text-gray-900">Gender</label>
                    <select id="hs-select-label" class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" name="gender">
                        <option selected>Female</option>
                        <option>Male</option>
                        <option>Other</option>
                    </select>
                </div>

                <div>
                    <label for="password1" class="block text-sm font-medium text-gray-900">Create Password</label>
                    <div class="mt-2 pass-con relative">
                        <input type="password" name="password" id="password1" required
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        <i class="eye-icon1 fa-regular fa-eye-slash absolute right-3 top-4 cursor-pointer"></i>
                    </div>

                    <!-- Password Strength Criteria for password1 -->
                    <div id="password1-criteria" class="text-sm text-gray-600 mt-2">
                        <span id="password1-message" class="text-red-500"></span>
                    </div>
                </div>

                <div>
                    <label for="password2" class="block text-sm font-medium text-gray-900">Confirm Password</label>
                    <div class="mt-2 pass-con relative">
                        <input type="password" name="password2" id="password2" required
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        <i class="eye-icon2 fa-regular fa-eye-slash absolute right-3 top-4 cursor-pointer"></i>
                    </div>

                    <!-- Password Match Check for password2 -->
                    <div id="password2-criteria" class="text-sm text-gray-600 mt-2">
                        <span id="password2-message" class="text-red-500"></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="button" id="submit-btn" class="flex w-1/3 mt-4 justify-center rounded-md bg-indigo-600 p-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ">
                        Sign Up
                    </button>
                </div>

            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Already have an account?
                <button type="button" class="login-link font-semibold text-indigo-600 hover:text-indigo-500">Login</button>
            </p>
        </div>
    </div>
</div>

<!-- Login -->
<div class="login flex w-screen h-screen justify-center items-center
<?= $_GET['response'] == "success" || !isset($_GET['response']) ? "" : "hidden" ?>
<?= $_GET['response'] != "success" && isset($_GET['response']) ? "hidden" : "" ?>
">
    <div class="flex flex-col min-w-full justify-center p-10 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm flex flex-col justify-center items-center">
            <div class="chatLog-con flex justify-center items-center">
                <img class="" src="./images/chat.png" alt="Your Company" />
            </div>
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="./PHP/login.php" method="POST">
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">User Name or Email</label>
                    <div class="mt-2">
                        <input type="text" name="name_email" id="email1"
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                    </div>

                    <?php if ($_GET['user']) : ?>
                        <p id="email-error1" class="text-red-500 mt-2 text-sm"><?= $_GET['user'] ?></p>
                    <?php endif; ?>

                </div>

                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="mt-2 relative">
                        <input type="password" name="password" id="password"
                            class="block w-full rounded-md bg-white p-3 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                        <i class="eye-icon fa-regular fa-eye-slash absolute right-3 top-4 cursor-pointer"></i>
                    </div>

                    <?php if ($_GET['pass']) : ?>
                        <p id="email-error2" class="text-red-500 mt-2 text-sm"><?= $_GET['pass'] ?></p>
                    <?php endif; ?>

                </div>

                <div class="flex justify-center">
                    <button type="button" id="login-btn"
                        class="flex w-1/3 justify-center rounded-md bg-indigo-600 p-3 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign In
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Don't have an account?
                <button type="submit" class="signUp-link font-semibold text-indigo-600 hover:text-indigo-500">Sign Up</button>
            </p>
        </div>
    </div>
</div>

<script src="./JS/index.js"></script>

</body>

<script src="../node_modules/flyonui/flyonui.js"></script>

<script>
   
</script>
</html>


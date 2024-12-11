<?php

include_once "db_connect.php";

session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];


if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $sql = mysqli_query($conn, "select email from users where email = '$email'");
    if (mysqli_num_rows($sql) > 0) {
        $response = "$email - This email already exist!";
    } else {
      
        $status = "Active now";
        $random_id = rand(time(), 10000000);

        $sql2 = mysqli_query($conn, "insert into users (unique_id,name,email,password,gender,status) values ($random_id,'$name','$email','$password','$gender','$status')");

        if ($sql2) {
            $sql3 = mysqli_query($conn, "select * from users where email = '$email'");

            if (mysqli_num_rows($sql3) > 0) {
                $row = mysqli_fetch_assoc($sql3);
                $_SESSION['random_id'] = $row['random_id'];
                $response = "success";
            }
        }
    }
} else {
    $response = "$email - This is not a valid email!";
}

$conn->close();

header("Location:../index.php?response=$response");

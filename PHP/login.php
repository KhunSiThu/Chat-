<?php

include_once "db_connect.php";

session_start();

$name_email = $_POST['name_email'];
$password = $_POST['password'];



if (filter_var($name_email, FILTER_VALIDATE_EMAIL)) {

    $sql = mysqli_query($conn, "select * from users where email = '$name_email'");
} else {
    $sql = mysqli_query($conn, "select * from users where name = '$name_email'");
}

if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
    $uniqueId = $row['unique_id'];
    $_SESSION['unique_id'] = $row['unique_id'];
    $gender = $row['gender'];
    if($row['password'] == $password) {
        
        header("Location:../upProfile.php?gender=$gender");
    } else {

        header("Location:../index.php?pass=Password is incorrect!");
    }
} else { 
    header("Location:../index.php?user= $name_email - Not found user!");
}
$conn->close();


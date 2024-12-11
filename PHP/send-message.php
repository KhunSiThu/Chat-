<?php 

session_start();

include_once "db_connect.php";

$uniqueId = $_SESSION['unique_id'];
$chooseFri = $_SESSION['chooseFri'];
$message = $_POST['message'];

if(!empty($message)) {
    $sql = "insert into messages (send_id,receive_id,message) values ($uniqueId,$chooseFri,'$message')";
    $query = mysqli_query($conn,$sql);
}

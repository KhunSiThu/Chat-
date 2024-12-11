<?php 

session_start();

include_once "db_connect.php";

$uniqueId = $_SESSION['unique_id'];
$friendId = $_GET['friId'];

if(!empty($uniqueId)) {
    $sql = "insert into friendList (request,confirm) values ($friendId,$uniqueId)";
    $query = mysqli_query($conn,$sql);

    $sql2 = "delete from friendRequests where request_id = $friendId and forConfirm_id = $uniqueId";
    $query2 = mysqli_query($conn,$sql2);

    if($query2) {
        header("Location:./friendRequestMob.php");
    }
}
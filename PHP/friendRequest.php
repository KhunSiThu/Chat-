<?php 

session_start();

include_once "db_connect.php";

$uniqueId = $_SESSION['unique_id'];
$friendId = $_GET['friendId'];

if(!empty($uniqueId)) {
    $sql = "insert into friendRequests (request_id,forConfirm_id) values ($uniqueId,$friendId)";
    $query = mysqli_query($conn,$sql);

    if($query) {
        if(isset($_GET['mobile'])) {
            header("Location:../mobile/searchFriend.php?search=".$_GET['search']);
        } else {
            header("Location:../main-page.php?search=".$_GET['search']);
        }
        
    }
}
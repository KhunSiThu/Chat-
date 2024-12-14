<?php

include_once "db_connect.php";

session_start();

if (isset($_SESSION['unique_id'])) {
    $uniqueId = $_SESSION['unique_id'];

    $stmt = $conn->prepare("UPDATE users SET status = 'Out Line' WHERE unique_id = ?");
    $stmt->bind_param("i", $uniqueId);

    $stmt->execute();

    session_destroy();

    header("Location:../index.php");
    exit();
} else {
    echo "Error: User not logged in.";
}

?>

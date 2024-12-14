<?php

session_start();

include_once "db_connect.php";

$uniqueId = $_SESSION['unique_id'];
$friendId = $_GET['friId'];

if (!empty($uniqueId) && !empty($friendId)) {
    // Check if the users are already friends
    $checkFriendSql = "SELECT 'Friend' FROM friendList WHERE (request = ? AND confirm = ?) OR (confirm = ? AND request = ?)";
    $stmt = $conn->prepare($checkFriendSql);
    $stmt->bind_param("iiii", $friendId, $uniqueId, $friendId, $uniqueId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Not friends, add to friend list and remove the friend request
        $addFriendSql = "INSERT INTO friendList (request, confirm) VALUES (?, ?)";
        $stmt = $conn->prepare($addFriendSql);
        $stmt->bind_param("ii", $friendId, $uniqueId);

        if ($stmt->execute()) {
            $deleteRequestSql = "DELETE FROM friendRequests WHERE request_id = ? AND forConfirm_id = ?";
            $stmt = $conn->prepare($deleteRequestSql);
            $stmt->bind_param("ii", $friendId, $uniqueId);

            if ($stmt->execute()) {
                // Redirect after successfully adding friend
                $redirectPage = isset($_GET['search']) ? "../main-page.php?search=" . urlencode($_GET['search']) : "../main-page.php";
                header("Location: $redirectPage");
                exit();
            }
        }
    } else {
        // Already friends, remove from friend list
        $removeFriendSql = "DELETE FROM friendList WHERE (request = ? AND confirm = ?) OR (confirm = ? AND request = ?)";
        $stmt = $conn->prepare($removeFriendSql);
        $stmt->bind_param("iiii", $friendId, $uniqueId, $friendId, $uniqueId);

        if ($stmt->execute()) {
            // Redirect after successfully removing friend
            $redirectPage = isset($_GET['search']) ? "../main-page.php?search=" . urlencode($_GET['search']) : "../main-page.php";
            header("Location: $redirectPage");
            exit();
        }
    }
} else {
    // Handle error for missing uniqueId or friendId
    echo "Invalid operation. Please try again.";
}
?>

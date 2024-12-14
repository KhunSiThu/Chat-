<?php 

session_start();

include_once "db_connect.php";

$uniqueId = $_SESSION['unique_id'];
$friendId = $_GET['friendId'];

if (!empty($uniqueId) && !empty($friendId)) {
    // Check if a friend request already exists
    $checkFriendSql = "SELECT 'Request' FROM friendRequests WHERE (request_id = ? AND forConfirm_id = ?)";
    $stmt = $conn->prepare($checkFriendSql);
    $stmt->bind_param("ii", $uniqueId, $friendId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // No request found, send a friend request
        $insertRequestSql = "INSERT INTO friendRequests (request_id, forConfirm_id) VALUES (?, ?)";
        $stmt = $conn->prepare($insertRequestSql);
        $stmt->bind_param("ii", $uniqueId, $friendId);
        if ($stmt->execute()) {
            $redirectPage = isset($_GET['mobile']) ? "../mobile/searchFriend.php" : "../main-page.php";
            header("Location: $redirectPage?search=" . urlencode($_GET['search']));
            exit();
        }
    } else {
        // Request exists, remove it
        $deleteRequestSql = "DELETE FROM friendRequests WHERE (request_id = ? AND forConfirm_id = ?) OR (request_id = ? AND forConfirm_id = ?)";
        $stmt = $conn->prepare($deleteRequestSql);
        $stmt->bind_param("iiii", $uniqueId, $friendId, $friendId, $uniqueId);
        if ($stmt->execute()) {
            $redirectPage = isset($_GET['mobile']) ? "../mobile/searchFriend.php" : "../main-page.php";
            header("Location: $redirectPage?search=" . urlencode($_GET['search']));
            exit();
        }
    }
} else {
    // Handle error for missing uniqueId or friendId
    echo "Invalid operation. Please try again.";
}
?>

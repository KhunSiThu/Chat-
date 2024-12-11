<?php

include_once "db_connect.php";

session_start();

$uniqueId = $_SESSION['unique_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

    $image = $_FILES['image'];

    if ($image['error'] === 0) {
        
        $fileTmpPath = $image['tmp_name'];
        $fileName = $image['name'];
        $fileSize = $image['size'];
        $fileType = $image['type'];

        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = uniqid() . '.' . $fileExtension;

        $uploadDir = '../PHP/images/';
        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($fileTmpPath, $destination)) {

            $sql = "UPDATE users SET profile_image = ? WHERE unique_id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param('si', $destination, $uniqueId);

                if ($stmt->execute()) {
                    header("Location:../main-page.php?");
                } 
                
                $stmt->close();
            } 
        } 
    } 
}

$conn->close();
?>

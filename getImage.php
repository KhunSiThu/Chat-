<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include_once "./PHP/db_connect.php";



// Fetch the image
$id = 4; // Image ID
$sql = "SELECT name, profile_image FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($name, $image);
$stmt->fetch();

// Set the image content-type and output
header("Content-Type: image/jpeg"); // Change to image/png or image/gif if needed



?>

<img src="<?=$image ?>" alt="">

</body>
</html>
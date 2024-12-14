<?php

include_once "db_connect.php";

session_start();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];

// Validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    
    // Check if the email already exists using a prepared statement
    $sql = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $sql->bind_param("s", $email); // Bind email to the prepared statement
    $sql->execute();
    $sql->store_result(); // Store the result to check if email exists
    
    if ($sql->num_rows > 0) {
        $response = "$email - This email already exists!";
    } else {
        // Generate a unique ID and hash the password
        $status = "Active";
        $random_id = rand(time(), 10000000);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
        
        // Insert new user with prepared statement
        $sql2 = $conn->prepare("INSERT INTO users (unique_id, name, email, password, gender, status) VALUES (?, ?, ?, ?, ?, ?)");
        $sql2->bind_param("isssss", $random_id, $name, $email, $hashed_password, $gender, $status);
        
        if ($sql2->execute()) {
            // Retrieve the newly inserted user and set session
            $sql3 = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $sql3->bind_param("s", $email);
            $sql3->execute();
            $result = $sql3->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['unique_id'] = $row['unique_id']; // Correct session variable
                $response = "success";
            }
        }
    }
} else {
    $response = "$email - This is not a valid email!";
}

$conn->close();

// Redirect with response message
header("Location:../index.php?response=$response");
exit();


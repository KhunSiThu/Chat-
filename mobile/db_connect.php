<?php 

$conn = mysqli_connect("localhost","khun","asdf","chat_db");

if(!$conn) {
    echo mysqli_connect_error();
}
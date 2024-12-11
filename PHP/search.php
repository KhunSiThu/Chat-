<?php 

$search = $_POST['search'];

echo $search;

if($search) {
    header("Location:../main-page.php?search=$search");
} else {
    header("Location:../main-page.php?");
}
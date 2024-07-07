<?php
session_start();
include 'db.php';
$product_id = $_POST['product_id'];
$user_id = $_SESSION['session'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$query = "INSERT INTO reviews (Product_id,User_id,Rating,Comment,Date) VALUES('$product_id','$user_id','$rating','$review',NOW())";
$result = mysqli_query($con, $query);
if ($result) {
    echo "success";
}
?>
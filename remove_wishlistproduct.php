<?php
// Connect to the database
include 'db.php';

// Remove the product from the cart table
$wishlist_id = $_POST['wishlist_id'];
$query1 = "DELETE FROM wishlist WHERE Wish_id = '$wishlist_id'";
$result1 = mysqli_query($con, $query1);

// Return a success message
echo 'Product deleted from cart';
?>
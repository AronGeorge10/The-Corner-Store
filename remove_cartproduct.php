<?php
// Connect to the database
include 'db.php';

// Remove the product from the cart table
$cart_id = $_POST['cart_id'];
$query1 = "DELETE FROM cart WHERE Cart_id = '$cart_id'";
$result1 = mysqli_query($con, $query1);

// Return a success message
echo 'Product deleted from cart';
?>
<?php
session_start();
include 'db.php';
if (isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $cart_id = $cart_item['cart_id'];
        $new_quantity = $_POST['quantity_'.$cart_item['product_id'].'_'.$cart_item['weight_id']];
        $new_price = ($cart_item['total_price']/$cart_item['quantity']) * $new_quantity;
        
        $update_query = "UPDATE cart SET Quantity=$new_quantity, Price=$new_price WHERE Cart_id=$cart_id";
        mysqli_query($con, $update_query);
    }
    // clear the cart session
    unset($_SESSION['cart']);
}
header('Location: viewcart.php'); // redirect back to the view cart page
?>

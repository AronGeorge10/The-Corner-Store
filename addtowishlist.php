<?php
session_start();
include 'db.php';
if (isset($_POST['product_id']) && isset($_POST['weight_id']) && $_SESSION['session']) {
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $weight_id = mysqli_real_escape_string($con, $_POST['weight_id']);
    $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
    $user_id = mysqli_real_escape_string($con, $_SESSION['session']);

    // Add the product to the user's wishlist in the database
    $query1 = "INSERT INTO wishlist (User_id, Product_id, Weight_id, Quantity, Created_at) VALUES ('$user_id', '$product_id','$weight_id','$quantity',NOW())";
    mysqli_query($con, $query1);

    $query2 = "SELECT p.Product_Name, w.Weight, w.Unit, w.Price FROM product p JOIN weight_options w ON p.Product_id = w.Product_id WHERE w.Weight_id = $weight_id";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_array($result2);
    $product = [
        'name' => $row2['Product_Name'],
        'weight' => $row2['Weight'],
        'unit' => $row2['Unit'],
        'quantity' => $quantity
    ];
    // If cart is empty, initialize it as an empty array
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = [];
    }
    // Add product to wishlist
    array_push($_SESSION['wishlist'], $product);

    echo "Product added to wishlist!"; // Send a response back to the AJAX request
}
?>
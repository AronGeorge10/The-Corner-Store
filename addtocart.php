<?php
session_start();
include 'db.php';
$user_id = $_SESSION['session'];
$product_id = $_POST["productId"];
$weight_id = $_POST["weightId"];
$quantity = $_POST["quantity"];
$query1 = "SELECT p.Product_Name, w.Weight, w.Unit, w.Price FROM product p JOIN weight_options w ON p.Product_id = w.Product_id WHERE w.Weight_id = $weight_id";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);
$price = floatval($quantity) * floatval($row1['Price']);
$query4 = "INSERT INTO cart (User_id,Product_id,Weight_id,Quantity,Price,Created_at) VALUES ($user_id,$product_id,$weight_id,$quantity,$price,NOW())";
$result4 = mysqli_query($con, $query4);
if ($result4) {
    echo "Success";
}
?>
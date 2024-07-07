<?php
include 'db.php';
// Get the product name, weight, and unit from the POST request
$pro_name = $_POST['pro_name'];
$pro_weight = $_POST['pro_weight'];
$pro_unit = $_POST['pro_unit'];

$query1 = "SELECT Product_id from product WHERE Product_Name='$pro_name'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);
$pro_id = $row1['Product_id'];
// Check if there is a previous weight for this product
$query2 = "SELECT Weight, Unit, Price FROM weight_options WHERE Product_id='$pro_id' ORDER BY Product_id DESC LIMIT 1";
$result2 = mysqli_query($con, $query2);
if (mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $prev_unit = $row2['Unit'];
    $prev_weight = $row2['Weight'];
    $prev_price = $row2['Price'];
    error_log($prev_unit, $prev_weight, $prev_price);
}

// Calculate the price based on the previous weight and price
if ($pro_unit == 'kg') {
    $pro_weight = $pro_weight * 1000; //Convert to gram
} else if ($pro_unit == 'ml') {
    $pro_weight = $pro_weight / 1000; //Convert to litre
}

if ($prev_unit == 'kg') {
    $prev_weight = $prev_weight * 1000; //Convert to gram
} else if ($prev_unit == 'ml') {
    $prev_weight = $prev_weight / 1000; //Convert to litre
}

$price_per_unit = $prev_price / $prev_weight;
$price = $price_per_unit * $pro_weight;

// Return the price as a JSON object
echo json_encode(array('price' => $price));
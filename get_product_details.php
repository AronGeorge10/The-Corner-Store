<?php
include 'db.php';
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the product ID from the AJAX request
$productId = $_POST['productId'];

// Fetch the product data from the database
$query1 = "SELECT * FROM products WHERE Product_id = $productId";
$result1 = mysqli_query($con, $query1);
$query2 = "SELECT * FROM weight_options WHERE Product_id=$productId";
$result2 = mysqli_query($con, $query2);
if (!$result1 && !$result2) {
  error_log("Error in query: " . mysqli_error($con));
  die("Error in query: " . mysqli_error($con));
}

// Convert the product data into an associative array
$productData = mysqli_fetch_assoc($result1);

// Close the database connection
mysqli_close($con);

// Send the product data back as a JSON response
header('Content-Type: application/json');
echo json_encode($productData);
?>
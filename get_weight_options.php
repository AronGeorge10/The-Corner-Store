<?php
include 'db.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the product ID from the AJAX request
$productId = $_POST['productId'];
error_log($productId);
// Fetch the weight options for the product from the database
$query = "SELECT Weight_id from weight_options where Product_id='$productId'";
$result = mysqli_query($con, $query);
if (!$result) {
    error_log("Error in query: " . mysqli_error($con));
    die("Error in query: " . mysqli_error($con));
}

// Convert the weight options into an associative array
$weightOptions = array();
while ($row = mysqli_fetch_assoc($result)) {
    $weightOptions[] = $row;
}

// Close the database connection
mysqli_close($con);

// Send the weight options back as a JSON response
header('Content-Type: application/json');
echo json_encode($weightOptions);
?>
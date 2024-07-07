<?php
include 'db.php';
$product_id = $_POST['product_id'];
$weight_id = $_POST['weight_id'];
$query1 = "SELECT Stock FROM weight_options WHERE Weight_id='$weight_id' AND Product_id='$product_id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);
if ($row1['Stock'] == 0) {
    echo $row1['Stock'];
}
else{
    echo "1";
}
?>
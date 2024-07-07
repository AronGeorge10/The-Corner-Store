<?php
include 'db.php';
if (isset($_POST["pro_weight"])) {
    $productname = mysqli_real_escape_string($con, $_POST["pro_name"]);
    $productweight = mysqli_real_escape_string($con, $_POST["pro_weight"]);
    $productunit = mysqli_real_escape_string($con, $_POST["pro_unit"]);
    $query1 = "SELECT Product_id from product WHERE Product_Name='$productname'";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $productid = $row1['Product_id'];
    $query2 = "SELECT * FROM weight_options WHERE Product_id = '$productid'AND Weight='$productweight' AND Unit='$productunit'";
    $result2 = mysqli_query($con, $query2);
    echo mysqli_num_rows($result2);
}
?>
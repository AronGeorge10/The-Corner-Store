<?php
include 'db.php';
if (isset($_POST['productId'])) {
    $id = $_POST['productId'];

    // Retrieve the current status of the customer
    $status_query = "SELECT `Status` FROM `product` WHERE `Product_id` = $id";
    $status_result = mysqli_query($con, $status_query);
    $status = mysqli_fetch_array($status_result)['Status'];

    // Update the customer's status
    if ($status == 1) {
        $disable_query = "UPDATE `product` SET `Status` = 0 WHERE `Product_id` = $id";
        mysqli_query($con, $disable_query);

    } else {
        $enable_query = "UPDATE `product` SET `Status` = 1 WHERE `Product_id` = $id";
        mysqli_query($con, $enable_query);
    }
}
?>
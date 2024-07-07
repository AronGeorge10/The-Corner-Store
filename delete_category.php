<?php
include 'db.php';
if (isset($_POST['categoryId'])) {
    $id = $_POST['categoryId'];

    // Retrieve the current status of the customer
    $status_query = "SELECT `Status` FROM `category` WHERE `Category_id` = $id";
    $status_result = mysqli_query($con, $status_query);
    $status = mysqli_fetch_array($status_result)['Status'];

    // Update the customer's status
    if ($status == 1) {
        $disable_query = "UPDATE `category` SET `Status` = 0 WHERE `Category_id` = $id";
        $disable_query1 = "UPDATE `product` SET `Status` = 0 WHERE `Category_id` = $id";
        mysqli_query($con, $disable_query);
        mysqli_query($con, $disable_query1);

    } else {
        $enable_query = "UPDATE `category` SET `Status` = 1 WHERE `Category_id` = $id";
        mysqli_query($con, $enable_query);
    }
}
?>
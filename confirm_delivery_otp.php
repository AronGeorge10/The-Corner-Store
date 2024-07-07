<?php
include 'db.php';
$id = $_POST['orderId'];
$user_id = $_POST['userId'];
$otp = $_POST['otp'];
$query1 = "SELECT * FROM delivery WHERE User_id='$user_id' AND Order_id='$id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);
// check if the OTP is valid
if ($otp === $row1['otp']) {
    $query2 = "UPDATE delivery SET Status='Delivered' WHERE User_id='$user_id' AND Order_id='$id'";
    $result2 = mysqli_query($con, $query2);
    echo "success";
} else {
    // OTP is invalid, send an error response
    echo "failed";
}

?>
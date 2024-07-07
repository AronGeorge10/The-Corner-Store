<?php
include 'db.php';
if (isset($_POST["pro_name"])) {
    $productname = mysqli_real_escape_string($con, $_POST["pro_name"]);
    $query = "SELECT * FROM product WHERE Product_Name = '$productname'";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
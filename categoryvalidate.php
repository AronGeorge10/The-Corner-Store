<?php
include 'db.php';
if (isset($_POST["cat_name"])) {
    $categoryname = mysqli_real_escape_string($con, $_POST["cat_name"]);
    $query = "SELECT * FROM category WHERE Category_Name = '$categoryname'";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
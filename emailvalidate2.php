<?php
include 'db.php';
if (isset($_POST["email"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $query = "SELECT * FROM register_tbl WHERE Email = '$email'";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
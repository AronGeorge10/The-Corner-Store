<?php
include 'db.php';
if (isset($_POST["email"])) {
    $uid = $_POST["uid"];
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $query = "SELECT * FROM register_tbl WHERE Email = '$email' AND `User_id` !=$uid";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
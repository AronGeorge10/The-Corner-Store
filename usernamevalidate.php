<?php
include 'db.php';
if (isset($_POST["username"])) {
    $uid = $_POST["uid"];
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $query = "SELECT * FROM register_tbl WHERE Username = '$username' AND `User_id` !=$uid";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
<?php
include 'db.php';
if (isset($_POST["username"])) {
    $uname = mysqli_real_escape_string($con, $_POST["username"]);
    $query = "SELECT * FROM register_tbl WHERE Username = '$uname'";
    $result = mysqli_query($con, $query);
    echo mysqli_num_rows($result);
}
?>
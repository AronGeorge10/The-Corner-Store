<?php
include 'db.php';
// get the user id from the POST data
$userId = $_POST['id'];

// fetch the user details from the database using $userId
$query = "SELECT * FROM `register_tbl` r LEFT JOIN `address` a ON r.User_id=a.User_id WHERE r.User_id='$userId'";
$result = mysqli_query($con, $query);

// return the user details as JSON data
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  echo json_encode($row);
} else {
  echo json_encode(array('error' => 'User not found'));
}
?>
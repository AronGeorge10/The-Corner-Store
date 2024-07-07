<?php
$conn = mysqli_connect("localhost", "root", "", "supermarket") or die("Connect failed: %s\n" . $conn->error);

$email = $_POST['email'];
$verification_code = $_POST['verification_code'];

// Check if the verification code is correct for the given email
$sql = "SELECT * FROM email_verify WHERE Email='$email' AND verification_code='$verification_code'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Update the account status to verified
  $sql = "UPDATE register_tbl SET Status=1 WHERE Email='$email'";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    // Display success message
    echo "Your account has been verified successfully.";
  } else {
    // Display error message
    echo "Error updating account status.";
  }
} else {
  // Display error message
  echo "Invalid verification code.";
}

mysqli_close($conn);
?>

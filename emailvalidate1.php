<?php
include 'db.php';
if (isset($_POST['username'])) {
   $username = mysqli_real_escape_string($con, $_POST['username']);

   $query = "select count(*) as cntUser from register_tbl where Username='" . $username . "'";

   $result = mysqli_query($con, $query);
   $response = "<span style='color: green;'>Available.</span>";
   if (mysqli_num_rows($result)) {
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];

      if ($count > 0) {
         $response = "<span style='color: red;'>Not Available.</span>";
      }

   }

   echo $response;
   die;
}
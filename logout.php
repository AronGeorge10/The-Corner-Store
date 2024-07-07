<?php
session_start();
session_destroy();
unset($_SESSION['session']);
unset($_SESSION['cart']);
unset($_SESSION['wishlist']);
unset($_SESSION['order']);
unset($_SESSION['sub_total']);
$url = "login.php";
echo ("<script>location.href='$url'</script>");
?>
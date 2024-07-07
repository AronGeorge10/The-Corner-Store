<?php
session_start();
include 'db.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$user_id = $_SESSION['session'];
$amt = $_POST['amount'];
$razorpayPaymentId = $_POST['razorpayPaymentId'];
$query1 = "INSERT INTO orders (User_id,Status,Amount,Currency,Created_at) VALUES('$user_id','Processing',$amt,'INR',NOW())";
$result1 = mysqli_query($con, $query1);
if (!$result1) {
    error_log("Error in query1: " . mysqli_error($con));
    die("Error in query1: " . mysqli_error($con));
}
$q = "SELECT Order_id from orders where User_id=$user_id";
$res = mysqli_query($con, $q);
$r = mysqli_fetch_array($res);
$order_id = $r['Order_id'];
$_SESSION['order'] = $order_id;

$query3 = "INSERT INTO payment (Order_id,Payment_id,Amount,Currency,Status,Created_at) VALUES($order_id,'$razorpayPaymentId',$amt,'INR','Success',NOW())";
$result3 = mysqli_query($con, $query3);
if (!$result3) {
    error_log("Error in query3: " . mysqli_error($con));
    die("Error in query3: " . mysqli_error($con));
}

// loop through the cart items and insert them into the order_items table
$cart_items = json_decode(json_encode($_POST['items']), true);
foreach ($cart_items as $cart_item) {
    $product_id = $cart_item['product_id'];
    $weight_id = $cart_item['weight_id'];
    $quantity = $cart_item['quantity'];
    $price = $cart_item['total_price'];
    $query2 = "INSERT INTO order_items (Order_id,Product_id,Weight_id,Quantity,Price) VALUES('$order_id','$product_id','$weight_id','$quantity','$price')";
    $result2 = mysqli_query($con, $query2);
    $query4 = "UPDATE weight_options SET Stock=Stock-$quantity where Product_id=$product_id AND Weight_id=$weight_id";
    $result4 = mysqli_query($con, $query4);
    if (!$result2) {
        error_log("Error in query2: " . mysqli_error($con));
        die("Error in query2: " . mysqli_error($con));
    }
}
$query5 = "Delete from cart where User_id='$user_id'";
$result5 = mysqli_query($con, $query5);
if ($result1 && $result2 && $result3 && $result5) {
    error_log("Payment processed successfully");
    echo "success";
}
mysqli_close($con);
?>
<?php
session_start();
if ($_SESSION['logout'] == "") {
    header("location:login.php");
}
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once('razorpay-php/Razorpay.php');
    use Razorpay\Api\Api;

    $api_key = "rzp_test_Mw00rhtTxNAOPp";
    $api_secret = "mVXkEqWZLXY8y0VMLZF3hQIb";
    $api = new Api($api_key, $api_secret);
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>The Corner Store</title>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<style>
    .main-button input {
        display: inline-block;
        font-size: 15px;
        height: 47px;
        padding: 3px 20px;
        background-color: #ed563b;
        color: #fff;
        text-align: center;
        font-weight: 400;
        text-transform: uppercase;
        transition: all .3s;
    }

    .main-button input:hover {
        background-color: #f9735b;
        color: #fff;
    }
</style>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <section class="section section-bg" id="call-to-action"
        style="background-image: url(assets/images/delivery.jpg);height: 720;width: 480;">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Easy <em>Checkout</em></h2>
                        <p>We will deliver the products to your housesteps faster than you could expect</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $user_id = $_SESSION['session'];
    if ($user_id) {
        $user_id = $_SESSION['session'];
        $query1 = "SELECT * FROM `register_tbl` WHERE `User_id` = '$user_id'";
        $query2 = "SELECT * FROM `address` WHERE `User_id` = '$user_id'";
        $result1 = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);
        $row1 = mysqli_fetch_array($result1);
        $row2 = mysqli_fetch_array($result2);
    }
    ?>
    <?php
    $cart_query = "SELECT sum(price) as Sum from cart where User_id=$user_id";
    $cart_result = mysqli_query($con, $cart_query);
    $cart_row = mysqli_fetch_array($cart_result);
    $sub_total = $_SESSION['sub_total'];
    $total = $sub_total + 20;
    $cart_items = $_SESSION['cart'];
    ?>

    <section class="section">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form id="checkout" action="" method="post">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <label>House Name:</label>
                                    <input type="text" name="house" value="<?php echo $row2['House_Name']; ?>" required>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label>City:</label>
                                    <input type="text" name="city" value="<?php echo $row2['City']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <label>Zip:</label>
                                    <input type="text" name="pin" value="<?php echo $row2['Zip_Code']; ?>" required>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label>Landmark: </label>
                                    <input type="text" name="landmark">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="g-recaptcha" data-sitekey="6Le8RDUlAAAAAOVBkyE5S8OcG0TsWU9HKRPoJZHi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-button">
                                        <div class="float-right">
                                            <input id="btn" class="btn btn-primary" type="submit" name="submit"
                                                value="Confirm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <br>
                </div>


                <div class="col-md-4">
                    <ul class="list-group list-group-no-border">
                        <li class="list-group-item" style="margin:0 0 -1px">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Sub-total</strong>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-right">₹
                                        <?php echo $sub_total; ?>.00
                                    </h5>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item" style="margin:0 0 -1px">
                            <div class="row">
                                <div class="col-6">
                                    <strong>Delivery Charge</strong>
                                </div>

                                <div class="col-6">
                                    <h5 class="text-right">₹ 20.00</h5>
                                </div>
                            </div>
                        </li>

                        <li class="list-group-item" style="margin:0 0 -1px">
                            <div class="row">
                                <div class="col-6">
                                    <h4><strong>Total</strong></h4>
                                </div>

                                <div class="col-6">
                                    <h4 class="text-right">₹
                                        <?php echo $sub_total + 20; ?>.00
                                    </h4>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <br>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2020 The Corner Store
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap -->
    <!-- <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script> -->

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <!-- <script src="assets/js/waypoints.min.js"></script> -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <?php
    if (isset($_POST['submit'])) {
        $house = $_POST['house'];
        $city = $_POST['city'];
        $pin = $_POST['pin'];
        $landmark = $_POST['landmark'];
        $total = $sub_total + 20;
        if (isset($_POST['g-recaptcha-response'])) {
            $recaptcha = $_POST['g-recaptcha-response'];
            if (!$recaptcha) {
                ?>
                <script>alert("Check recaptcha box"); </script>
                <?php
                exit;
            } else {
                $secret = "6Le8RDUlAAAAAL_Vw24tKohhedZAAywzYwmg8kQ1";
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $recaptcha;
                $response = file_get_contents($url);
                $responseKeys = json_decode($response, true);
                if ($responseKeys['success']) {
                    ?>
                    <?php
                    $query8 = "SELECT Order_id FROM orders ORDER BY Order_id DESC LIMIT 1";
                    $result8 = mysqli_query($con, $query8);
                    $row8 = mysqli_fetch_array($result8);
                    //$order_id = $_SESSION['order'];
                    $order_id = $row8['Order_id'];
                    $query3 = "update orders set Status='Placed', Updated_at=NOW() where Order_id='$order_id'";
                    $result3 = mysqli_query($con, $query3);
                    $query4 = "SELECT User_id FROM register_tbl WHERE Role=2 AND Status=1";
                    $result4 = mysqli_query($con, $query4);
                    $delivery_boys = mysqli_fetch_all($result4, MYSQLI_ASSOC);
                    // Get the count of deliveries already assigned to each delivery boy
                    $counts = array();
                    foreach ($delivery_boys as $delivery_boy) {
                        $delivery_boy_id = $delivery_boy['User_id'];
                        $query5 = "SELECT COUNT(*) AS count FROM delivery WHERE Delivery_boy_id='$delivery_boy_id'";
                        $result5 = mysqli_query($con, $query5);
                        $count = mysqli_fetch_assoc($result5)['count'];
                        $counts[$delivery_boy_id] = $count;
                    }
                    // Assign the delivery to the delivery boy with the least number of deliveries assigned
                    $delivery_boy_id = array_keys($counts, min($counts))[0];
                    // Update the delivery table with the assigned delivery boy
                    $query6 = "INSERT INTO delivery (User_id,Order_id,House_Name,City,Pin_Code,Landmark,Status) VALUES('$user_id','$order_id','$house','$city','$pin','$landmark','Processing')";
                    $result6 = mysqli_query($con, $query6);
                    $query7 = "UPDATE delivery SET Delivery_boy_id='$delivery_boy_id' WHERE Order_id='$order_id'";
                    $result7 = mysqli_query($con, $query7);
                    if ($result3 && $result4 && $result5 && $result6 && $result7) {
                        ?>
                        <script>
                            window.location.href = "new.php";
                        </script>
                        <?php
                    }
                }
            }
        }
    }
    ?>

</body>

</html>
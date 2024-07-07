<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

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


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">The <em> Corner Store</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="new.php">Home</a></li>
                            <li><a href="products.php">Products</a></li>
                            <li><a href="checkout.php" class="active">Checkout</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">About</a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="about.php">About Us</a>
                                    <a class="dropdown-item" href="blog.php">Blog</a>
                                    <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                                    <a class="dropdown-item" href="terms.php">Terms</a>
                                </div>
                            </li>
                            <li><a href="contact.php">Contact</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

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
    $cart_query = "SELECT sum(price) from cart where User_id=$user_id";
    $cart_result = mysqli_query($con, $cart_query);
    $cart_row = mysqli_fetch_array($cart_result);
    $sub_total = $cart_row['sum(price)'];
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
                                    <label>Name:</label>
                                    <input type="text" name="name" value="<?php echo $row1['Name']; ?>" required>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label>Mobile Number:</label>
                                    <input type="text" name="phone" value="<?php echo $row1['Phone']; ?>" required>
                                </div>
                            </div>
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
                                    <input type="text" name="zip" value="<?php echo $row2['Zip_Code']; ?>" required>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <label>Landmark: </label>
                                    <input type="text" name="landmark" required>
                                </div>
                            </div>
                            <!-- <div class="row justify-content-center">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="g-recaptcha" data-sitekey="6Le8RDUlAAAAAOVBkyE5S8OcG0TsWU9HKRPoJZHi">
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="main-button">
                                        <div class="float-left">
                                            <a href="viewcart.php">Back</a>
                                        </div>

                                        <div class="float-right">
                                            <input id="btn" class="pay-button" type="submit" name="submit" value="PAY">
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

    <script>
        $('#btn').click(function () {
            var options = {
                "key": "rzp_test_Mw00rhtTxNAOPp", // Enter the Key ID generated from the Dashboard
                "amount": "<?= $total * 100 ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                "currency": "INR",
                "name": "The Corner Store",
                "description": "Grocery Purchase",
                "image": "assets/images/TCS.png",
                "handler": function (response) {
                    var paymentData = {
                        items: <?php echo json_encode($cart_items); ?>, // an array of items in the cart
                        email: "<?php echo $row1['Email']; ?>",
                        amount: <?= $total ?>,
                        razorpayPaymentId: response.razorpay_payment_id
                    };
                    $.ajax({
                        type: "POST",
                        url: "process-payment2.php",
                        data: paymentData,
                        success: function (msg) {
                            console.log("Ajax request successful");
                            $('.pay-button').hide()
                        },
                        error: function () {
                            console.log("AJAX call failed");
                        }
                    });
                },
                "prefill": {
                    "name": "<?php echo $row1['Name']; ?>",
                    "email": "<?php echo $row1['Email']; ?>",
                    "contact": "7559936759"
                },
                "notes": {
                    "address": "<?php echo $row2['House_Name']; ?>\n<?php echo $row2['City']; ?>\n<?php echo $row2['Zip_Code']; ?>"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.on('payment.failed', function (response) {
                alert(response.error.code);
                alert(response.error.description);
                alert(response.error.source);
                alert(response.error.step);
                alert(response.error.reason);
                alert(response.error.metadata.order_id);
                alert(response.error.metadata.payment_id);
            });
            var rzp = new Razorpay(options);
            rzp.open();
        })
    </script>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $house = $_POST['house'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
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
                    // Store the order and payment details in the database
                    $query3 = "INSERT INTO orders (User_id,Amount,Currency,Created_at) VALUES($user_id,$total,'INR',NOW())";
                    $result3 = mysqli_query($con, $query3);
                    $q = "SELECT Order_id from orders where User_id=$user_id";
                    $res = mysqli_query($con, $q);
                    $r = mysqli_fetch_array($res);
                    $order_id = $r['Order_id'];
                    // $query4 = "INSERT INTO payment (Order_id,Payment_id,Amount,Currency,Status,Created_at) VALUES($order_id,'$payment_id',$total,'INR','Pending',NOW())";
                    // $result4 = mysqli_query($con, $query4);
                }
            }
        }
    }
    ?>

</body>

</html>
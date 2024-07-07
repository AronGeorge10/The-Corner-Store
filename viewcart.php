<?php
session_start();
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
    <!-- Razorpay -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>The Corner Store</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <script>

        function updatePrice(quantityInput, unitprice, weightId) {
            // Client-side validation for quantity input
            let value = quantityInput.value;
            value = value.replace(/[^\d]/g, '').replace(/\./g, '');
            if (value < 1) {
                value = 1;
            }
            quantityInput.value = value;

            // Calculate total price and update UI
            let quantity = parseFloat(value);
            let totalPrice = quantity * parseFloat(unitprice);
            let priceString = document.getElementById("price_" + weightId).value;
            let price = parseFloat(priceString.replace(/[^\d.]/g, ''));
            document.getElementById("price_" + weightId).value = "₹ " + totalPrice.toFixed(2);
            $('#save-btn').attr("disabled", false);

            // Update subtotal and total price to update order summary
            let subtotalElement = document.getElementById("sub-total");
            let subtotal = parseFloat(subtotalElement.innerHTML.substring(2));
            let newsubtotal = parseFloat(subtotal) + parseFloat(totalPrice) - price;
            newsubtotal = parseFloat(newsubtotal.toFixed(2));
            console.log(quantity, totalPrice, subtotal, price, newsubtotal);
            document.getElementById("sub-total").innerHTML = "₹ " + newsubtotal.toFixed(2);
            Total = newsubtotal + 20;
            document.getElementById("total").innerHTML = "₹ " + Total.toFixed(2);
        }

        function deleteProduct(product_id, weight_id, cart_id, price) {
            var confirmationMessage = 'Are you sure you want to remove this product from the cart ?';
            if (confirm(confirmationMessage)) {

                $.ajax({
                    url: 'remove_cartproduct.php',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        weight_id: weight_id,
                        cart_id: cart_id
                    },
                    success: function (response) {
                        // Remove the product card from the cart
                        $('#product_' + product_id + '_' + weight_id).remove();
                        $('#save-btn').attr("disabled", false);

                        // Update subtotal and total price to update order summary
                        let subtotalElement = document.getElementById("sub-total");
                        let subtotal = parseFloat(subtotalElement.innerHTML.substring(2));
                        let newsubtotal = parseFloat(subtotal) - parseFloat(price);
                        newsubtotal = parseFloat(newsubtotal.toFixed(2));
                        console.log(subtotal, price, newsubtotal);
                        document.getElementById("sub-total").innerHTML = "₹ " + newsubtotal.toFixed(2);
                        Total = newsubtotal + 20;
                        document.getElementById("total").innerHTML = "₹ " + Total.toFixed(2);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Error deleting product: ' + textStatus + ' ' + errorThrown);
                    }
                });
            }
        }


    </script>

    <style>
        @import url(http://fonts.googleapis.com/css?family=Calibri:400,300,700);

        .mt-100 {
            margin-top: 100px;

        }


        .card {
            margin-bottom: 30px;
            border: 0;
            -webkit-transition: all .3s ease;
            transition: all .3s ease;
            letter-spacing: .5px;
            border-radius: 8px;
            -webkit-box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, .05);
            box-shadow: 1px 5px 24px 0 rgba(68, 102, 242, .05);
        }

        .card .card-header {
            background-color: #fff;
            border-bottom: none;
            padding: 24px;
            border-bottom: 1px solid #f6f7fb;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }



        .card .card-body {
            padding: 30px;
            background-color: transparent;
        }

        .btn-primary,
        .btn-primary.disabled,
        .btn-primary:disabled {
            background-color: #4466f2 !important;
            border-color: #4466f2 !important;
        }
    </style>

</head>

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
                            <li><a href="order_history.php">Order History</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">About</a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item active" href="about.php">About Us</a>
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
        style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>My <em>Cart</em></h2>
                        <p>View the products in your cart</p>
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
    $cart_query = "SELECT * from cart where User_id=$user_id";
    $cart_result = mysqli_query($con, $cart_query);
    $cart_sum_query = "SELECT sum(price) from cart where User_id=$user_id";
    $cart_sum_result = mysqli_query($con, $cart_sum_query);
    $cart_sum_row = mysqli_fetch_array($cart_sum_result);
    $cart_items = array();
    $sub_total = $cart_sum_row['sum(price)'];
    $total = $sub_total + 20;
    ?>
    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">

            <br>
            <br>
            <br>
            <div class="row">
                <?php
                $sub_total = 0;
                $cart_count = mysqli_num_rows($cart_result);
                if ($cart_count != 0) {
                    ?>
                    <div class="col-md-8">
                        <form action="savecart.php" method="POST">
                            <?php
                            while ($cart_row = mysqli_fetch_array($cart_result)) {
                                $product_id = $cart_row['Product_id'];
                                $product_query = "SELECT * from product where Product_id=$product_id";
                                $product_result = mysqli_query($con, $product_query);
                                $weight_id = $cart_row['Weight_id'];
                                $weight_query = "SELECT * from weight_options where Weight_id=$weight_id";
                                $weight_result = mysqli_query($con, $weight_query);
                                $price = $cart_row['Price'];
                                $sub_total = $sub_total + $price;
                                
                                while ($product_row = mysqli_fetch_array($product_result)) {
                                    while ($weight_row = mysqli_fetch_array($weight_result)) {
                                        $cart_item = array(
                                            'cart_id' => $cart_row['Cart_id'],
                                            'product_id' => $product_id,
                                            'product_name' => $product_row['Product_Name'],
                                            'product_image' => $product_row['Product_Image'],
                                            'weight_id' => $weight_id,
                                            'weight' => $weight_row['Weight'],
                                            'unit' => $weight_row['Unit'],
                                            'price' => $weight_row['Price'],
                                            'quantity' => $cart_row['Quantity'],
                                            'total_price' => $price
                                        );
                                        array_push($cart_items, $cart_item);
                                        // Assign the cart items to the $_SESSION['cart'] variable
                                        $_SESSION['cart'] = $cart_items;
                                        ?>
                                        <div class="card mb-3"
                                            id="product_<?php echo $cart_row['Product_id'] . '_' . $cart_row['Weight_id']; ?>">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img class="product-image img-fluid rounded h-100"
                                                        src="<?php echo 'product_uploads/' . $product_row['Product_Image']; ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <?php echo $product_row['Product_Name']; ?> -
                                                            <?php echo $weight_row['Weight']; ?>
                                                            <?php echo $weight_row['Unit']; ?>
                                                        </h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="quantity">
                                                                    Quantity
                                                                </label>
                                                                <input type="number" class="form-control quantity-input"
                                                                    value="<?php echo $cart_row['Quantity']; ?>"
                                                                    id="quantity_<?php echo $cart_row['Product_id'] . '_' . $cart_row['Weight_id'] . '_' . $cart_row['Price']; ?>"
                                                                    name="quantity_<?php echo $cart_row['Product_id'] . '_' . $cart_row['Weight_id']; ?>"
                                                                    data-price="<?php echo $cart_row['Price'] / $cart_row['Quantity']; ?>"
                                                                    data-weight-price="<?php echo $weight_row['Price']; ?>"
                                                                    data-original-quantity="<?php echo $cart_row['Quantity']; ?>"
                                                                    onchange="updatePrice(this, <?php echo $weight_row['Price']; ?>, <?php echo $cart_row['Weight_id']; ?>)"
                                                                    <?php if ($weight_row['Stock'] == 0)
                                                                        echo 'disabled'; ?>>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="price">Price</label>
                                                                <input type="text" class="form-control price-input"
                                                                    id="price_<?php echo $cart_row['Weight_id']; ?>"
                                                                    value="₹ <?php echo $cart_row['Price']; ?>.00" disabled>
                                                            </div>

                                                        </div><br>
                                                        <?php
                                                        if ($weight_row['Stock'] == 0) {
                                                            ?>
                                                            <span class="text-danger">Out of stock</span>
                                                            <?php
                                                        }
                                                        ?>
                                                        <div>
                                                            <a class="btn btn-danger float-right" style="cursor:pointer;color:#fff;"
                                                                onclick="deleteProduct(<?php echo $cart_row['Product_id'] . ',' . $cart_row['Weight_id'] . ',' . $cart_row['Cart_id'] . ',' . $cart_row['Price']; ?>)"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </div><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col ml-3 mt-3">
                                    <button class="btn btn-primary" id="save-btn" name="save" disabled>Save Changes</button>
                                </div>
                            </div>
                            <form>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Order Summary</h5>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Subtotal</td>
                                            <td id="sub-total">₹
                                                <?php echo $sub_total; ?>.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Delivery Charge</td>
                                            <td id="shipping">₹ 20.00</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td id="total">₹
                                                <?php echo $sub_total + 20; ?>.00
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a class="btn btn-primary btn-block" id="btn"
                                    style="color:#fff;cursor:pointer;">Checkout</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    $_SESSION['sub_total']=$sub_total;
                } else { ?>

                    <!-- Empty cart icon -->
                    <div class="container-fluid  mt-100">
                        <div class="row">

                            <div class="col-md-12">

                                <div class="card">
                                    <div class="card-body cart">
                                        <div class="col-sm-12 empty-cart-cls text-center">
                                            <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130"
                                                class="img-fluid mb-4 mr-3">
                                            <h3><strong>Your Cart is Empty</strong></h3>
                                            <h4>Add something to make me happy :)</h4>
                                            <a href="products.php" class="btn btn-primary cart-btn-transform m-3"
                                                data-abc="true">continue shopping</a>


                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->

    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Copyright © 2023 The Corner Store
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <!-- <script src="assets/js/jquery-2.1.0.min.js"></script> -->

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
                        razorpayPaymentId: response.razorpay_payment_id,
                    };
                    $.ajax({
                        type: "POST",
                        url: "process-payment.php",
                        data: paymentData,
                        success: function (msg) {
                            console.log("Ajax request successful");
                            window.location.href = 'deliver.php?payment_id=' + response.razorpay_payment_id;
                        },
                        error: function () {
                            console.log("AJAX call failed");
                        }
                    });
                },
                "prefill": {
                    "name": "<?php echo $row1['Name']; ?>",
                    "email": "<?php echo $row1['Email']; ?>",
                    "contact": "<?php echo $row1['Phone']; ?>"
                },
                "notes": {
                    "address": "<?php echo $row2['House_Name']; ?>\n<?php echo $row2['City']; ?>\n<?php echo $row2['Zip_Code']; ?>"
                },
                "theme": {
                    "color": "#3399cc"
                }
            }; var rzp1 = new Razorpay(options);
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

</body>

</html>
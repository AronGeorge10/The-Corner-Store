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
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>The Corner Store</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <script>

        function deleteProduct(product_id, weight_id, wishlist_id) {
            var confirmationMessage = 'Are you sure you want to remove this product from the wishlist ?';
            if (confirm(confirmationMessage)) {

                $.ajax({
                    url: 'remove_wishlistproduct.php',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        weight_id: weight_id,
                        wishlist_id: wishlist_id
                    },
                    success: function (response) {
                        // Remove the product card from the wishlist
                        $('#product_' + product_id + '_' + weight_id).remove();
                        $('#save-btn').attr("disabled", false);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log('Error deleting product: ' + textStatus + ' ' + errorThrown);
                    }
                });
            }
        }

        function updatePrice(quantityInput) {
            // Client-side validation for quantity input
            let value = quantityInput.value;
            value = value.replace(/[^\d]/g, '').replace(/\./g, '');
            if (value < 1) {
                value = 1;
            }
            quantityInput.value = value;
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
                        <h2>My <em>Shopping list</em></h2>
                        <p>View the products in your shopping list</p>
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
        $result1 = mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($result1);
    }
    ?>

    <?php
    $wishlist_query = "SELECT * from wishlist where User_id=$user_id";
    $wishlist_result = mysqli_query($con, $wishlist_query);
    $wishlist_items = array();
    ?>
    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">

            <br>
            <br>
            <br>
            <div class="row">
                <?php
                $wishlist_count = mysqli_num_rows($wishlist_result);
                if ($wishlist_count != 0) {
                    ?>
                    <div class="col-md-8 mx-auto">
                        <form action="" method="POST">
                            <?php
                            while ($wishlist_row = mysqli_fetch_array($wishlist_result)) {
                                $product_id = $wishlist_row['Product_id'];
                                $product_query = "SELECT * from product where Product_id=$product_id";
                                $product_result = mysqli_query($con, $product_query);
                                $weight_id = $wishlist_row['Weight_id'];
                                $weight_query = "SELECT * from weight_options where Weight_id=$weight_id";
                                $weight_result = mysqli_query($con, $weight_query);
                                while ($product_row = mysqli_fetch_array($product_result)) {
                                    while ($weight_row = mysqli_fetch_array($weight_result)) {
                                        $wishlist_item = array(
                                            'wishlist_id' => $wishlist_row['Wish_id'],
                                            'product_id' => $product_id,
                                            'product_name' => $product_row['Product_Name'],
                                            'product_image' => $product_row['Product_Image'],
                                            'weight_id' => $weight_id,
                                            'weight' => $weight_row['Weight'],
                                        );
                                        array_push($wishlist_items, $wishlist_item);
                                        // Assign the wishlist items to the $_SESSION['wishlist'] variable
                                        $_SESSION['wishlist'] = $wishlist_items;
                                        ?>
                                        <div class="card mb-3"
                                            id="product_<?php echo $wishlist_row['Product_id'] . '_' . $wishlist_row['Weight_id']; ?>">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img class="product-image img-fluid rounded h-100"
                                                        src="<?php echo 'product_uploads/' . $product_row['Product_Image']; ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title d-flex align-items-center">
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
                                                                    value="<?php echo $wishlist_row['Quantity']; ?>"
                                                                    name="quantity_<?php echo $wishlist_row['Product_id'] . '_' . $wishlist_row['Weight_id']; ?>"
                                                                    onchange="updatePrice(this)">
                                                            </div>
                                                        </div>
                                                        <div class="row float-right">
                                                            <div>
                                                                <button class="btn btn-primary float-right mr-2 cart-btn"
                                                                    id="cart-btn-<?php echo $product_row['Product_id'] . '-' . $weight_row['Weight_id']; ?>"
                                                                    data-weight-id="<?php echo $weight_row['Weight_id']; ?>"
                                                                    data-product-id="<?php echo $product_row['Product_id']; ?>"
                                                                    style="cursor:pointer;color:#fff;">
                                                                    <i class="bx bxs-cart-add"></i>
                                                                </button>

                                                            </div>
                                                            <div>
                                                                <a class="btn btn-danger float-right" style="cursor:pointer;color:#fff;"
                                                                    onclick="deleteProduct(<?php echo $wishlist_row['Product_id'] . ',' . $wishlist_row['Weight_id'] . ',' . $wishlist_row['Wish_id']; ?>)"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
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
                            <form>
                    </div>
                    <?php
                } else { ?>

                    <!-- Empty wishlist icon -->
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
        $(document).ready(function () {

            $('.cart-btn').click(function (event) {
                event.preventDefault();
                var button = $(this);
                var productId = button.data("product-id");
                var weightId = button.data("weight-id");
                var quantity = $(".quantity-input").val();
                // Send AJAX request to add product to cart
                $.ajax({
                    url: "addtocart.php",
                    type: "POST",
                    data: { productId: productId, weightId: weightId, quantity: quantity },
                    success: function (response) {
                        alert(response);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert("Error adding product to cart: " + errorThrown);
                    }
                });
            });


        });
    </script>

</body>

</html>
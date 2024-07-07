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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>The Corner Store</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <!-- JQuery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">

    <script>
        // JavaScript code for filter function
        function filterProducts(category) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("products-list").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "filter-products.php?category=" + category, true);
            xhttp.send();
        }

    </script>

    <style>
        .profile-menu {
            /* top: 25px; */
            /* right: 30px; */
            margin-left: -20px;
        }

        .profile-menu .action {
            margin-left: 105%;
            display: block;
            width: 54px;
            height: 54px;
            background-color: #222533;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
        }

        .profile-menu .action img {
            width: 100%;
            height: 135%;
        }

        .profile-menu .menu {
            width: 310px;
            padding: 30px;
            background-color: #fc1e24;
            border-radius: 10px;
            position: absolute;
            top: 91px;
            right: 32px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .profile-menu .menu.active {
            opacity: 1;
            visibility: visible;
        }

        .profile-menu .menu::before {
            content: "";
            width: 16px;
            height: 16px;
            background-color: #fc1e24;
            border-top-left-radius: 3px;
            position: absolute;
            top: -8px;
            right: 19px;
            transform: rotate(45deg);
        }

        .profile-menu .menu .profile {
            display: flex;
            /* align-items: center; */
            margin-bottom: 30px;
        }

        .profile-menu .menu .profile img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            user-select: none;
        }

        .profile-menu .menu .profile .info {
            margin-left: 15px;
        }

        .profile-menu .menu .profile .info h2 {
            color: #dadada;
            font-size: 18px;
            font-weight: 400;
            text-transform: capitalize;
            margin-bottom: 4px;
        }

        .profile-menu .menu .profile .info p {
            color: #7d8193;
            font-size: 16px;
            font-weight: 400;
        }

        .profile-menu .menu ul li {
            list-style: none;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-menu .menu ul li:last-child {
            margin: 0;
        }

        .profile-menu .menu ul li a {
            color: #e5e5e5;
            font-size: 16px;
            font-weight: 400;
            text-decoration: none;
        }

        .profile-menu .menu ul li img {
            width: 26px;
            margin-right: 10px;
            user-select: none;
        }

        .btn {
            background-color: #ed563b;
        }

        .btn:hover {
            background-color: #f57a64;
        }

        .filter-dropdown {
            display: none;
            position: absolute;
            /* top: 50px; */
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            z-index: 1;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        h2,
        h4,
        h6,
        p,
        em {
            cursor: default;
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
                        <a href="new.php" class="logo">The <em> Corner Store</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="new.php">Home</a></li>
                            <li><a href="products.php" class="active">Products</a></li>
                            <li><a href="order_history.php">Order History</a></li>
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
                            <?php
                            $user_id = $_SESSION['session'];
                            $_SESSION['session'] = $user_id;
                            $query1 = "SELECT * FROM register_tbl WHERE User_id='$user_id'";
                            $result = mysqli_query($con, $query1);
                            $row = mysqli_fetch_array($result);
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="uploads/<?php echo $row['Image'] ?>" width="50" height="50"
                                        class="rounded-circle" style="margin-top: -19px;">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" style="color: #ed563b;" href="viewprofile.php">View
                                        Profile</a>
                                    <a class="dropdown-item" style="color: #ed563b;" href="viewcart.php">My Cart</a>
                                    <a class="d2 dropdown-item" style="color: #ed563b;" href="viewwishlist.php">My
                                        Wishlist</a>
                                    <a class="dropdown-item" style="color: #ed563b;" href="logout.php">Log Out</a>
                                </div>
                            </li>
                </div>
                </li>
                </ul>

                <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action"
        style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Our <em>Products</em></h2>
                        <p>We offer you fresh products of the highest quality</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Fleet Starts ***** -->
    <section class="section" id="trainers">
        <div class="container">
            <br>

            <div id="products-list">
                <div class="row">
                    <br>
                    <br>
                    <?php
                    $query4 = "SELECT * FROM category where Status not like 0";
                    $result4 = mysqli_query($con, $query4);
                    ?>

                    <!-- HTML code for filter dropdown with filter icon -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="filter-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-filter"></i>
                            Filter
                        </button>
                        <div class="dropdown-menu" aria-labelledby="filter-dropdown">
                            <a class="dropdown-item" href="#" onclick="filterProducts('All')">All</a>
                            <?php
                            while ($row4 = mysqli_fetch_array($result4)) {
                                ?>
                                <a class="dropdown-item" href="#"
                                    onclick="filterProducts('<?php echo $row4['Category_Name']; ?>')">
                                    <?php echo $row4['Category_Name']; ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    $query2 = "SELECT * from product where Status not like 0";
                    $result2 = mysqli_query($con, $query2);

                    while ($row2 = mysqli_fetch_array($result2)) {
                        $query3 = "SELECT wo.Weight_id,wo.Weight, wo.Unit, wo.Price
                    FROM weight_options wo
                    INNER JOIN (
                        SELECT Product_id, MIN(Price) AS min_price
                        FROM weight_options
                        GROUP BY Product_id
                    ) AS min_prices
                    ON wo.Product_id = min_prices.Product_id AND wo.Price = min_prices.min_price
                    WHERE wo.Product_id = {$row2['Product_id']}
                    ";
                        $result3 = mysqli_query($con, $query3);
                        $row3 = mysqli_fetch_array($result3);
                        ?>
                        <div class="col-lg-4">
                            <a href="product-details.php?Product_id=<?php echo $row2['Product_id']; ?>">
                                <div class="trainer-item">
                                    <div class="image-thumb">
                                        <img src="<?php echo 'product_uploads/' . $row2['Product_Image']; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <span>
                                            ₹
                                            <?php echo $row3['Price']; ?><span class="text-dark">/pack</span>
                                        </span>
                                        <h4>
                                            <?php echo $row2['Product_Name']; ?> -
                                            <?php echo $row3['Weight']; ?>
                                            <?php echo $row3['Unit']; ?>

                                        </h4>

                                        <p>
                                            <?php echo $row2['Description']; ?>
                                        </p>
                                        <?php
                                        $product_id = $row2['Product_id'];
                                        $weight_id = $row3['Weight_id'];
                                        $stock_query = "SELECT Stock FROM weight_options WHERE Weight_id='$weight_id' AND Product_id='$product_id'";
                                        $stock_result = mysqli_query($con, $stock_query);
                                        $stock_row = mysqli_fetch_array($stock_result);
                                        if ($stock_row['Stock'] == 0) {
                                            ?>
                                            <p class="text-danger">Out of stock</p>
                                            <?php
                                        }
                                        ?>
                                        <ul class="social-icons">
                                            <li><a href="product-details.php?product_id=<?php echo $row2['Product_id']; ?>">+
                                                    Order</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <br>

            <nav>
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </section>
    <!-- ***** Fleet Ends ***** -->


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
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>
    <script src="assets/js/mixitup.js"></script>
    <script src="assets/js/accordions.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>


</body>

</html>
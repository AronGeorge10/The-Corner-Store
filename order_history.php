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

    <title>The Corner Store</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        #addcart {
            display: inline-block;
            font-size: 15px;
            padding: 0px 20px;
            background-color: #ed563b;
            color: #fff;
            text-align: center;
            font-weight: 400;
            text-transform: uppercase;
            transition: all .3s;
        }

        button:disabled {
            cursor: default !important;
        }

        /* Review sytem */
        .star-rating {
            display: inline-block;
            font-size: 24px;
            color: #ddd;
        }

        .star-rating .star {
            cursor: pointer;
            display: inline-block;
            width: 20px;
            overflow: hidden;
        }

        .star-rating .star:hover,
        .star-rating .star.active {
            color: #ffcc00;
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
                            <li><a href="products.php">Products</a></li>
                            <li><a href="order_history.php" class="active">Order History</a></li>
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
                                    <a class="d1 dropdown-item" style="color: #ed563b;" href="viewprofile.php">Edit
                                        Profile</a>
                                    <a class="d2 dropdown-item" style="color: #ed563b;" href="viewcart.php">My Cart</a>
                                    <a class="d3 dropdown-item" style="color: #ed563b;" href="viewwishlist.php">My
                                        Wishlist</a>
                                    <a class="d3 dropdown-item" style="color: #ed563b;" href="logout.php">Log Out</a>
                                </div>
                            </li>
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

    <!-- ***** Call to Action Start ***** -->
    <section class="section section-bg" id="call-to-action"
        style="background-image: url(assets/images/delivery.jpg);height: 720;width: 480;">
        <div class="container">

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cta-content">
                        <br>
                        <br>
                        <h2>Order <em>History</em></h2>
                        <p>Here you can view the details of all your past orders</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- ***** Call to Action End ***** -->

    <!-- ***** Fleet Starts ***** -->
    <section class="section">
        <div class="container">
            <br>
            <br>
            <div class="row">
                <?php
                $query2 = "SELECT * from orders WHERE User_id='$user_id'";
                $result2 = mysqli_query($con, $query2);
                $id = 1;
                while ($row2 = mysqli_fetch_array($result2)) {
                    ?>
                    <!-- Table with striped rows -->
                    <div class="table-responsive">
                        <table id="customerTable" class="table table-lg table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Amount(INR)</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>
                                    <?php echo $id; ?>
                                </td>
                                <td>
                                    <?php echo $row2['Status']; ?>
                                </td>
                                <td>
                                    <?php echo $row2['Amount']; ?>
                                </td>
                                <td>
                                    <?php echo $row2['Updated_at']; ?>
                                </td>
                                <td>
                                    <?php echo "<a href='invoice.php?id=$row2[Order_id]'>Download</a>" ?>
                                </td>
                                </tr>
                                <?php
                }
                $id = $id + 1;
                ?>
                        </tbody>
                    </table>
                </div>
                <!-- End Table with striped rows -->
            </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
    </script>

</body>

</html>
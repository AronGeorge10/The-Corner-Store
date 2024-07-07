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

    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- JQuery cdn -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
        h2,
        h4,
        h6,
        p,
        em {
            cursor: default;
        }

        .d1::before {
            content: "\f007";
            font-family: FontAwesome;
            display: inline-block;
            margin-right: 10px;
        }

        .d2::before {
            content: "\f07a";
            font-family: FontAwesome;
            display: inline-block;
            margin-right: 10px;
        }

        .d3::before {
            content: "\f004";
            font-family: FontAwesome;
            display: inline-block;
            margin-right: 10px;
        }

        .d4::before {
            content: "\f2f5";
            font-family: FontAwesome;
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<?php
if ($_SESSION['session'] != NULL) {
    ?>

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
                            <a href="new.php" style="cursor:pointer;" class="logo">The<em style="cursor:pointer;"> Corner
                                    Store</em></a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li><a href="#" class="active">Home</a></li>
                                <li id="products"><a href="products.php">Products</a></li>
                                <li><a href="order_history.php">Order History</a></li>
                                <li class="#">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                        aria-haspopup="true" aria-expanded="false">About</a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" style="color: #ed563b;" href="about.php">About Us</a>
                                        <a class="dropdown-item" style="color: #ed563b;" href="blog.php">Blog</a>
                                        <a class="dropdown-item" style="color: #ed563b;" href="#">Testimonials</a>
                                        <a class="dropdown-item" style="color: #ed563b;" href="#">Terms</a>
                                    </div>
                                </li>
                                <li><a href="#">Contact</a></li>
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
                                        <a class="d1 dropdown-item" style="color: #ed563b;" href="viewprofile.php">View
                                            Profile</a>
                                        <a class="d2 dropdown-item" style="color: #ed563b;" href="viewcart.php">My Cart</a>
                                        <a class="d3 dropdown-item" style="color: #ed563b;" href="viewwishlist.php">My
                                            Wishlist</a>
                                        <a class="d4 dropdown-item" style="color: #ed563b;" href="logout.php">Log Out</a>
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

        <!-- ***** Main Banner Area Start ***** -->
        <div class="main-banner" id="top">
            <video autoplay muted loop id="bg-video">
                <source src="assets/images/video.mp4" type="video/mp4" />
            </video>

            <div class="video-overlay header-text">
                <div class="caption">
                    <h6>The Corner Store</h6>
                    <h2>Best <em>Grocery Store</em> in town</h2>
                    <div class="main-button">
                        <a href="#">Contact us</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Main Banner Area End ***** -->

        <!-- ***** Cars Starts ***** -->
        <section class="section" id="trainers">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading">
                            <h2>Our <em>Products</em></h2>
                            <img src="assets/images/line-dec.png" alt="">
                            <p>We only offer the best products which are freshly handpicked from the best farms out there
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    $query2 = "SELECT * from product where Status not like 0 LIMIT 3";
                    $result2 = mysqli_query($con, $query2);


                    while ($row2 = mysqli_fetch_array($result2)) {
                        $query3 = "SELECT weight_options.Price
                        FROM weight_options
                        INNER JOIN (
                          SELECT Product_id, MIN(Price) AS min_price
                          FROM weight_options
                          GROUP BY Product_id
                        ) AS min_prices
                        ON weight_options.Product_id = min_prices.Product_id AND weight_options.Price = min_prices.min_price
                        WHERE weight_options.Product_id = {$row2['Product_id']}
                        ";
                        $result3 = mysqli_query($con, $query3);
                        ?>

                        <div class="col-lg-4">
                            <a href="products.php">
                                <div class="trainer-item">
                                    <div class="image-thumb">
                                        <img src="<?php echo 'product_uploads/' . $row2['Product_Image']; ?>" alt="">
                                    </div>
                                    <div class="down-content">
                                        <?php
                                        while ($row3 = mysqli_fetch_array($result3)) { ?>
                                            <span>
                                                <sup>₹</sup>
                                                <?php echo $row3['Price']; ?>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                        <h4>
                                            <?php echo $row2['Product_Name']; ?>
                                        </h4>

                                        <p>
                                            <?php echo $row2['Description']; ?>
                                        </p>

                                        <ul class="social-icons">
                                            <li><a href="products.php">+ View More</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                    }
                    ?>
                </div>

                <br>

                <div class="main-button text-center">
                    <a href="products.php">View our products</a>
                </div>
            </div>
        </section>
        <!-- ***** Cars Ends ***** -->

        <section class="section section-bg" id="schedule"
            style="background-image: url(assets/images/about-fullscreen-1-1920x700.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading dark-bg">
                            <h2>Read <em>About Us</em></h2>
                            <img src="assets/images/line-dec.png" alt="">
                            <p>Welcome to our online grocery store! We are a team of passionate individuals who believe that
                                shopping for groceries should be convenient, easy, and enjoyable.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cta-content text-center">
                            <p>Our journey began with a simple goal - to make grocery shopping hassle-free for everyone. We
                                noticed that many people lead busy lives and struggle to find time to visit a physical
                                store. So we decided to create an online platform that allows customers to order groceries
                                from the comfort of their homes.</p>
                            <p>We work tirelessly to ensure that our customers have access to a wide range of high-quality
                                products at competitive prices. From fresh produce to pantry staples, we have everything you
                                need to create delicious meals and keep your home stocked with essentials.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ***** Blog Start ***** -->
        <!-- <section class="section" id="our-classes">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading">
                            <h2>Read our <em>Blog</em></h2>
                            <img src="assets/images/line-dec.png" alt="">
                            <p>Discover the latest about our products and our advices in growing organic vegetables</p>
                        </div>
                    </div>
                </div>
                <div class="row" id="tabs">
                    <div class="col-lg-4">
                        <ul>
                            <li><a href='#tabs-1'>Everything You Need to Know About Watering Tomatoes.</a></li>
                            <li><a href='#tabs-2'>You Probably Had No Clue How These Everyday Foods Grow.</a>
                            </li>
                            <li><a href='#tabs-3'>Boost Your Immune System Naturally With Broccoli.</a></li>
                            <div class="main-rounded-button"><a href="#">Read More</a></div>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <section class='tabs-content'>
                            <article id='tabs-1'>
                                <img src="assets/images/blog-image-1-940x460.jpg" alt="">
                                <h4>Everything You Need to Know About Watering Tomatoes.</h4>

                                <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                    27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i> 15 comments</p>

                                <p>Growing your own tomatoes can be so rewarding - especially when you take that first bite
                                    of fresh, juicy goodness. You’ll have to go through the steps of maintaining them
                                    properly to get them to grow to their full potential.
                                    You need to water your tomatoes in the early morning at the soil level, avoiding the
                                    foliage.
                                    We’ll cover what can happen with improper watering and several tips on overall tomato
                                    plant care.</p>
                                <div class="main-button">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <img src="assets/images/blog-2.jpg" alt="">
                                <h4>You Probably Had No Clue How These Everyday Foods Grow.</h4>
                                <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                    27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i> 15 comments</p>
                                <p>Peanuts, vanilla, black pepper – these foods are by no means exotic, and you probably use
                                    them regularly in the kitchen. But, can you envisage a peanut flower, a vanilla orchid
                                    or a peppercorn vine? Keep reading to learn the extraordinary beginnings of these
                                    ordinary foods. Peanuts Image credit: Jojonicdao There are several misconceptions about
                                    the peanut.</p>
                                <div class="main-button">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <img src="assets/images/blog-3.jpg" alt="">
                                <h4>Boost Your Immune System Naturally With Broccoli.</h4>
                                <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                    27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i> 15 comments</p>
                                <p>Broccoli is one of the best vegetables you can eat to promote good health, and help
                                    prevent many often devastating health problems including hypertension, diabetes, cancer,
                                    osteoarthritis and allergies. And the good news for people who struggle to grow broccoli
                                    in their own kitchen gardens (because it does have a tendency to bolt before the heads
                                    have formed) is that fresh broccoli sprouts are considerably more potent than the heads.
                                </p>
                                <div class="main-button">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- ***** Blog End ***** -->

        <!-- ***** Testimonials Item Start ***** -->
        <section class="section" id="features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="section-heading">
                            <h2>Read our <em>Testimonials</em></h2>
                            <img src="assets/images/line-dec.png" alt="waves">
                            <p>Read what our customers have to say about our products and services</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="features-items">
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="First One">
                                </div>
                                <div class="right-content">
                                    <h4>Brie Larson</h4>
                                    <p><em>"I had a great experience shopping on your online grocery store. The website was
                                            user-friendly, and it was easy to find what I was looking for. The delivery was
                                            on time, and the driver was courteous and helpful. I will definitely be using
                                            your service again."</em></p>
                                </div>
                            </li>
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="second one">
                                </div>
                                <div class="right-content">
                                    <h4>Harry Potter</h4>
                                    <p><em>"I was disappointed with the quality of the produce I received in my order. Some
                                            of the items were wilted or bruised. I would appreciate it if you could improve
                                            the freshness of your produce and ensure that it is properly packaged during
                                            delivery."</em></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="features-items">
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="fourth muscle">
                                </div>
                                <div class="right-content">
                                    <h4>John Wick</h4>
                                    <p><em>"I love the convenience of your online grocery store, but I do think that some of
                                            the prices are a bit high compared to other options. I would appreciate more
                                            sales and promotions, especially for loyal customers."</em></p>
                                </div>
                            </li>
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="training fifth">
                                </div>
                                <div class="right-content">
                                    <h4>Tony Stark</h4>
                                    <p><em>"I had an issue with my order, but your customer service team was very helpful in
                                            resolving the problem. They were responsive and proactive in addressing my
                                            concerns. Thank you for your excellent service."</em></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <br>

                <div class="main-button text-center">
                    <a href="testimonials.php">Read More</a>
                </div>
            </div>
        </section>
        <!-- ***** Testimonials Item End ***** -->

        <!-- ***** Call to Action Start ***** -->
        <section class="section section-bg" id="call-to-action"
            style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="cta-content">
                            <h2>Send us a <em>message</em></h2>
                            <p>Ut consectetur, metus sit amet aliquet placerat, enim est ultricies ligula, sit amet dapibus
                                odio augue eget libero. Morbi tempus mauris a nisi luctus imperdiet.</p>
                            <div class="main-button">
                                <a href="#">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Call to Action End ***** -->



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
    <?php
    echo ("<script> $('#logout').hide()</script>");
    $session = $_SESSION['session'];
    if ($session > 0) {
        echo ("<script> $('#logout').show()</script>");
        echo ("<script> $('#register').hide()</script>");
        if (isset($_POST['logout'])) {
            session_destroy();
            unset($_SESSION['session']);
            $url = "new.php";
            echo ("<script>location.href='$url'</script>");

            // JavaScript code to disable back button after logout
            echo "<script>
        if (typeof history.pushState === 'function') {
            history.pushState('no-back-slash', null, null);
            window.onpopstate = function () {
                history.pushState('no-back-slash', null, null);
            };
        }
        </script>";
        }
    }
    ?>


    <?php
    $user_id = $_SESSION['session'];
    if ($user_id > 0) {
        echo ("<script>$('.log-out').hide()</script>");

        $con = mysqli_connect("localhost", "root", "", "supermarket") or die("Connection error");
        $query1 = "SELECT * FROM `register_tbl` WHERE User_id = '$user_id'";
        $result = mysqli_query($con, $query1);
        $row = mysqli_fetch_array($result);
        $pro_name = $row['Name'];
        $pro_pic = $row['Image'];
        $username = $row['Username'];

        echo ("<script>$('.usr_pro_pic').attr('src','./uploads/$pro_pic');</script>");
        echo ("<script>$('.username').text('$username');</script>");

    } else {
        echo ("<script>$('.profile-menu').hide()</script>");
    }

    ?>
    </body>
    <?php
}
?>

</html>

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

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
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
                            <a href="new.php" style="cursor:pointer;" class="logo">The<em style="cursor:pointer;"> Corner
                                    Store</em></a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li><a href="login.php" class="active">Home</a></li>
                                <li><a href="login.php">Products</a></li>
                                <li><a href="login.php">Order History</a></li>
                                <li class="login.php">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                        aria-haspopup="true" aria-expanded="false">About</a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="login.php">About Us</a>
                                        <a class="dropdown-item" href="login.php">Blog</a>
                                        <a class="dropdown-item" href="login.php">Testimonials</a>
                                        <a class="dropdown-item" href="login.php">Terms</a>
                                    </div>
                                </li>
                                <li><a href="login.php">Contact</a></li>
                                <li>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                        aria-haspopup="true" aria-expanded="false">Sign In</a>
                                <div class="dropdown-menu">
                                        <a class="dropdown-item" href="login.php">Login</a>
                                        <a class="dropdown-item" href="register.php">Register</a>                                    
                                    </div>
                                </li>
                                <li class="nav-item">
                                    
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
                        <a href="login.php">Contact us</a>
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
                            <h2>Our <em>Foods</em></h2>
                            <img src="assets/images/line-dec.png" alt="">
                            <p>Nunc urna sem, laoreet ut metus id, aliquet consequat magna. Sed viverra ipsum dolor,
                                ultricies fermentum massa consequat eu.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="trainer-item">
                            <div class="image-thumb">
                                <img src="assets/images/product-4-720x480.jpg" alt="">
                            </div>
                            <div class="down-content">
                                <span>
                                    <del><sup>₹</sup>15.00</del> <sup>₹</sup>10.00
                                </span>

                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing.</h4>

                                <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris
                                    sit amet eleifend.</p>

                                <ul class="social-icons">
                                    <li><a href="login.php">+ View More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trainer-item">
                            <div class="image-thumb">
                                <img src="assets/images/product-5-720x480.jpg" alt="">
                            </div>
                            <div class="down-content">
                                <span>
                                    <del><sup>₹</sup>15.00</del> <sup>₹</sup>10.00
                                </span>

                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing.</h4>

                                <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris
                                    sit amet eleifend.</p>

                                <ul class="social-icons">
                                    <li><a href="login.php">+ View More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="trainer-item">
                            <div class="image-thumb">
                                <img src="assets/images/product-6-720x480.jpg" alt="">
                            </div>
                            <div class="down-content">
                                <span>
                                    <del><sup>₹</sup>15.00</del> <sup>₹</sup>10.00
                                </span>

                                <h4>Lorem ipsum dolor sit amet, consectetur adipisicing.</h4>

                                <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris
                                    sit amet eleifend.</p>

                                <ul class="social-icons">
                                    <li><a href="login.php">+ View More</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="main-button text-center">
                    <a href="login.php">View our products</a>
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
        <section class="section" id="our-classes">
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
                            <li><a href='#tabs-2'>Aspernatur excepturi magni, placeat rerum nobis magnam libero! Soluta.</a>
                            </li>
                            <li><a href='#tabs-3'>Sunt hic recusandae vitae explicabo quidem laudantium corrupti non
                                    adipisci nihil.</a></li>
                            <div class="main-rounded-button"><a href="login.php">Read More</a></div>
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
                                    <a href="login.php">Continue Reading</a>
                                </div>
                            </article>
                            <article id='tabs-2'>
                                <img src="assets/images/blog-image-2-940x460.jpg" alt="">
                                <h4>Aspernatur excepturi magni, placeat rerum nobis magnam libero! Soluta.</h4>
                                <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                    27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i> 15 comments</p>
                                <p>Integer dapibus, est vel dapibus mattis, sem mauris luctus leo, ac pulvinar quam tortor a
                                    velit. Praesent ultrices erat ante, in ultricies augue ultricies faucibus. Nam tellus
                                    nibh, ullamcorper at mattis non, rhoncus sed massa. Cras quis pulvinar eros. Orci varius
                                    natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                                <div class="main-button">
                                    <a href="login.php">Continue Reading</a>
                                </div>
                            </article>
                            <article id='tabs-3'>
                                <img src="assets/images/blog-image-3-940x460.jpg" alt="">
                                <h4>Sunt hic recusandae vitae explicabo quidem laudantium corrupti non adipisci nihil.</h4>
                                <p><i class="fa fa-user"></i> John Doe &nbsp;|&nbsp; <i class="fa fa-calendar"></i>
                                    27.07.2020 10:10 &nbsp;|&nbsp; <i class="fa fa-comments"></i> 15 comments</p>
                                <p>Fusce laoreet malesuada rhoncus. Donec ultricies diam tortor, id auctor neque posuere sit
                                    amet. Aliquam pharetra, augue vel cursus porta, nisi tortor vulputate sapien, id
                                    scelerisque felis magna id felis. Proin neque metus, pellentesque pharetra semper vel,
                                    accumsan a neque.</p>
                                <div class="main-button">
                                    <a href="login.php">Continue Reading</a>
                                </div>
                            </article>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Blog End ***** -->

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
                                <a href="login.php">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ***** Call to Action End ***** -->

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

</html>
<?php
require_once 'vendor/autoload.php';
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
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Panel</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Favicons -->
    <link href="assets/images/TCS.png" rel="icon">
    <link href="assets2/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets2/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets2/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets2/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets2/css/style.css" rel="stylesheet">
    <style>
        .row {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: nowrap;
            margin-top: calc(-1 * var(--bs-gutter-y));
            margin-right: calc(-.5 * var(--bs-gutter-x));
            margin-left: calc(-.5 * var(--bs-gutter-x));
            justify-content: center;
        }
    </style>
    <script>

        $(document).ready(function () {
            // Client-side validation for name input
            $('#nameInput').on('keyup', function () {
                var name = $('#nameInput').val();
                if (!name.match(/^[a-zA-Z][a-zA-Z\s]{3,}$/)) {
                    $('#nameInput').next().text('Enter a valid name');
                    $('#save').attr("disabled", true);
                } else {
                    $('#nameInput').next().text('');
                    $('#save').attr("disabled", false);
                }
            });

            //  Client-side validation for email input
            $('#emailInput').on('keyup', function () {
                var email = $('#emailInput').val();
                if (!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
                    $('#emailInput').next().text('Enter a valid email');
                }
                else {
                    // Check if the email already exists
                    $('#emailInput').next().text('');
                    $.ajax({

                        method: 'POST',
                        url: 'emailvalidate2.php',
                        data: {
                            email: email
                        },
                        success: function (data) {
                            if (data != '0') {
                                $('#emailInput').next().text('Email already exists');
                                $('#save').attr("disabled", true);
                            } else {
                                $('#emailInput').next().text('');
                                $('#save').attr("disabled", false);
                            }
                        }
                    });
                }
            });

            //Client-side validation for username input
            $('#usernameInput').on('keyup', function () {
                var username = $('#usernameInput').val();
                if (!username.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z][a-zA-Z0-9]{5,9}$/)) {
                    $('#usernameInput').next().text('Enter a valid username')
                } else {
                    // Check if the username already exists
                    $('#usernameInput').next().text('');
                    $.ajax({
                        method: "POST",
                        url: 'usernamevalidate2.php',
                        data: {
                            username: username
                        },
                        success: function (data) {
                            if (data != '0') {
                                $('#usernameInput').next().text('Username already exists');
                                $('#save').attr("disabled", true);
                            } else {
                                $('#usernameInput').next().text('');
                                $('#save').attr("disabled", false);
                            }
                        }
                    });
                }
            });

            // Client-side validation for password input
            $('#passwordInput').on('keyup', function () {
                var passwd = $('#passwordInput').val();
                if (!passwd.match(/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/)) {
                    $('#passwordInput').next().text('Enter a valid password');
                    $('#save').attr("disabled", true);
                } else {
                    $('#passwordInput').next().text('');
                    $('#save').attr("disabled", false);
                }
            });

            // Client-side validation for confirm password input
            $('#confirmpasswordInput').on('keyup', function () {
                var passwd = $('#passwordInput').val();
                var cpasswd = $('#confirmpasswordInput').val();
                if (cpasswd !== passwd) {
                    $('#confirmpasswordInput').next().text('Passwords do not match');
                    $('#save').attr("disabled", true);
                } else {
                    $('#confirmpasswordInput').next().text('');
                    if ($('#passwordInput').next().text() !== '') {
                        $('#save').attr("disabled", true);
                    } else {
                        $('#save').attr("disabled", false);
                    }
                }
            });

            // Client-side validation for phone input
            $('#phoneInput').on('keyup', function () {
                var phone = $('#phoneInput').val();
                if (!phone.match(/^\d{10}$/)) {
                    $('#phoneInput').next().text('Enter a valid phone number');
                    $('#save').attr("disabled", true);
                } else {
                    $('#phoneInput').next().text('');
                }
            });

            // Client-side validation for image input
            $('#imageInput').on('change', function () {
                var file = $('#imageInput').val();
                if (!file.match(/\.(jpg|jpeg|png|gif)$/i)) {
                    $('#imageInput').next().text('Please select a valid image file');
                    $('#save').attr("disabled", true);
                } else {
                    $('#imageInput').next().text('');
                    $('#save').attr("disabled", false);
                }
            });

            // Submit the form if all fields are valid and the username and email are not taken
            $('#edit-form').on('submit', function (e) {
                var name = $('#nameInput').val();
                var email = $('#emailInput').val();
                var username = $('#usernameInput').val();
                var passwd = $('#passwordInput').val();
                var cpasswd = $('#confirmpasswordInput').val();
                var phone = $('#phoneInput').val();
                var file = $('#imageInput').val();

                if (name === ''
                    // && username === ''
                    && phone === '' && house === '' && city === '' && zip === '' && file === '') {
                    e.preventDefault();
                    return false;
                }

                if ($('#nameInput').next().text() !== '' || $('#emailInput').next().text() !== '' || $('#usernameInput').next().text() !== '' || $('#passwordInput').next().text() !== '' || $('#confirmpasswordInput').next().text() !== '' || $('#phoneInput').next().text() !== '' || $('#imageInput').next().text() !== '') {
                    e.preventDefault();
                    return false;
                }

                return true;
            });
        });

    // Enable submit

    </script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="panel.php" style="cursor:pointer;" class="logo d-flex align-items-center">
                <img src="assets/images/TCS.png" alt="">
                The&nbsp;<em style="cursor:pointer;"> Corner
                    Store</em>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div> -->
        <!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
                <!-- End Search Icon-->

                <!-- <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a> -->
                <!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul>
                <!-- End Notification Dropdown Items -->

                <!-- </li> -->
                <!-- End Notification Nav -->

                <!-- <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span>
                    </a> -->
                <!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets2/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets2/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="assets2/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>David Muldon</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>

                </ul><!-- End Messages Dropdown Items -->

                </li><!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">
                    <?php
                    $user_id = $_SESSION['session'];
                    $_SESSION['session'] = $user_id;
                    $query1 = "SELECT * FROM register_tbl WHERE User_id='$user_id'";
                    $result1 = mysqli_query($con, $query1);
                    $row = mysqli_fetch_array($result1);
                    ?>

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="uploads/<?php echo $row['Image'] ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $row['Name'] ?>
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $row['Name'] ?>
                            </h6>
                            <span>Administrator</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="panel.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="managecustomer.php">
                    <i class="bi bi-people"></i>
                    <span>Manage Customers</span>
                </a>
            </li><!-- End manage customers Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-basket2"></i><span>Manage Products</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="viewproducts.php">
                            <i class="bi bi-circle"></i><span>View products</span>
                        </a>
                    </li>
                    <li>
                        <a href="addproduct.php">
                            <i class="bi bi-circle"></i><span>Add new product</span>
                        </a>
                    </li>
                    <li>
                        <a href="addcategory.php">
                            <i class="bi bi-circle"></i><span>Add category</span>
                        </a>
                    </li>
                    <li>
                        <a href="addweight.php">
                            <i class="bi bi-circle"></i><span>Add weight option</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Manage Products Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="ri-truck-line"></i><span>Delivery Person</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="viewdeliveryguy.php">
                            <i class="bi bi-circle"></i><span>View delivery persons</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="adddeliveryguy.php">
                            <i class="bi bi-circle"></i><span>Add delivery person</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Delivery Boy Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add Delivery Person</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
                    <li class="breadcrumb-item">Delivery Person</li>
                    <li class="breadcrumb-item active">Add delivery Person</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Delivery Person</h5>

                            <!-- General Form Elements -->
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="nameInput" class="form-control" name="name" required>
                                        <span id="nameError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="emailInput" class="form-control" name="email" required>
                                        <span id="emailError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="usernameInput" class="form-control" name="username"
                                            required>
                                        <span id="usernameError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="phoneInput" class="form-control" name="phone" required>
                                        <span id="phoneError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input id="imageInput" class="form-control" type="file" name="image"
                                            accept="image/png,image/gif,image/jpeg" required>
                                        <span id="imageError" class="text-danger"></span>
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-10 text-center">
                                        <input type="submit" id="submit" class="btn btn-primary" value="Submit"
                                            name="submit">
                                    </div>
                                </div>

                            </form><!-- End Form -->

                        </div>
                    </div>

                </div>

            </div>
        </section>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>The Corner Store</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets2/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets2/vendor/chart.js/chart.umd.js"></script>
    <script src="assets2/vendor/echarts/echarts.min.js"></script>
    <script src="assets2/vendor/quill/quill.min.js"></script>
    <script src="assets2/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets2/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets2/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets2/js/main.js"></script>

    <?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST["submit"])) {
        $userid = mysqli_insert_id($con);
        $id = $userid;
        $name = $_POST["name"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $bytes = random_bytes(8);
        $password = substr(base64_encode($bytes), 0, 8);
        $phone = $_POST["phone"];
        $image = $_FILES["image"]["name"];

        $query2 = "insert into register_tbl(User_id,Name,Email,Username,Password,Phone,Image,Status,Role) values('$userid','$name','$email','$username','$password','$phone','$image',1,2)";
        $result2 = mysqli_query($con, $query2);
        $query3 = "insert into login_tbl(Login_id,User_id,Username,Password,Role) values('$userid',LAST_INSERT_ID(),'$username','$password',2)";
        $result3 = mysqli_query($con, $query3);

        if ($result2 && $result3) {
            $targetdir = "uploads/";
            $targetfilepath = $targetdir . basename($image);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetfilepath);

            // Send activation email
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_OFF;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'arongeorgejain2025@mca.ajce.in';
                $mail->Password = 'A2r0o0n2';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('arongeorgejain2025@mca.ajce.in', 'The Corner Store Team');
                $mail->addAddress($email, $name);
                $mail->AddEmbeddedImage('assets/images/TCS.png', 'logo', 'logo.png'); // Attach the logo image
    
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Account Activation';
                $mail->Body = "
                <html>
            <head>
                <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    color: #333;
                    margin: 0;
                    padding: 0;
                }
                h1 {
                    font-size: 24px;
                    margin: 0 0 20px;
                    padding: 0;
                }
                h2 {
                    font-size: 20px;
                    margin: 0 0 20px;
                    padding: 0;
                }
                p {
                    margin: 0 0 20px;
                    padding: 0;
                    font-family: roboto,'helvetica neue',helvetica,arial,sans-serif;
                }
                a {
                    color: #1e7fc3;
                    text-decoration: none;
                }
                a:hover {
                    color: #0e4f7c;
                }
                .wrapper {
                    max-width: 600px;
                    margin: 0 auto;
                    padding: 20px;
                    background-color: #f6f6f6;
                    border: 1px solid #ddd;
                }
                .header {
                    background-color: #1e7fc3;
                    color: #fff;
                    padding: 10px;
                    text-align: center;
                }
                .content {
                    padding: 20px;
                    background-color: #fff;
                    border: 1px solid #ddd;
                }
                .footer {
                    background-color: #f6f6f6;
                    padding: 10px;
                    text-align: center;
                }
                .btn {
                    display: inline-block;
                    padding: 10px 20px;
                    background-color: #1e7fc3;
                    color: #fff;
                    border-radius: 4px;
                    text-decoration: none;
                }
                img{
                    width: 164px;
                    height: 140px;
                }
                </style>
            </head>
            <body>
                <img src='cid:logo' alt='Logo' class='mx-auto'>
                <hr>
                <p>Dear $name,</p>
                <p>We have added you as a delivery boy. Your account is now created and you can activate it by clicking the following link:</p>
                <p>Username: $username</p>
                <p>Password: $password</p>
                <p><a href='http://localhost/supermarket/login.php?code=$password'>Activate your account</a></p>
                <p>Please activate your account within 24 hours.</p>
                <p>Best regards,</p>
                <p>The Corner Store Team.</p>
            </body>
            </html>
                ";
                $mail->AltBody = "Dear $name,\n\nWe have added you as a delivery boy. Your account is now created and you can activate it by clicking the following link:\n\nhttp://localhost/supermarket/login.php?code=$password\n\nPlease activate your account within 24 hours.\n\nBest regards,\n\nThe Corner Store Team.";

                $mail->send();
                echo 'Activation email sent successfully.';
            } catch (Exception $e) {
                echo 'Failed to send activation email. Error message: ', $mail->ErrorInfo;
            }

            ?>
            <script>
                alert("Form successfully submitted");
                window.location.href = 'adddeliveryguy.php';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Enter the required details");
                $('#submit').attr("disabled", false);
            </script>
            <?php
        }
    }
    mysqli_close($con);
    ?>

</body>

</html>
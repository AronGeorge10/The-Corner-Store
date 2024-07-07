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
            let name_valid = false, category_valid = false, image_valid = false, desc_valid = false;

            // Client-side validation for product name input
            $('#pro_name').on('keyup', function () {
                const pro_name = $('#pro_name').val();
                if (!pro_name.match(/^[a-zA-Z][a-zA-Z\s]{2,}$/)) {
                    $('#pro_name').next().text('Enter a valid product name');
                }
                else {
                    // Check if the email already exists
                    $('#pro_name').next().text('');
                    $.ajax({

                        method: 'POST',
                        url: 'productvalidate.php',
                        data: {
                            pro_name: pro_name
                        },
                        success: function (data) {
                            if (data != '0') {
                                name_valid = false;
                                $('#pro_name').next().text('Product already exists');
                                $('#submit').attr("disabled", true);
                            } else {
                                name_valid = true;
                                $('#pro_name').next().text('');
                                $('#submit').attr("disabled", false);
                            }
                        }
                    });
                }
            });

            // Client-side validation for category input
            $('#pro_category').on('change', function () {
                if ($(this).val() == "--Select category--") {
                    category_valid = false;
                    $(this).next().text('Please select a category');
                } else {
                    category_valid = true;
                    $(this).next().text('');
                    $("#submit").attr("disabled", false);
                }

            });

            // Client-side validation for image input
            $('#pro_image').on('change', function (event) {
                const file = event.target.files[0];
                if (!file || !file.name.match(/\.(jpg|jpeg|png)$/i)) {
                    image_valid = false;
                    $(this).next().text('Only jpg, jpeg and png files are allowed');
                    $(this).val(''); // reset the value of the file input element
                } else {
                    image_valid = true;
                    $(this).next().text('');
                    $("#submit").attr("disabled", false);
                }

            });

            // Client-side validation for description input
            $('#pro_desc').on('keyup', function () {
                const pro_desc = $(this).val();
                if (!pro_desc.match(/^[a-zA-Z0-9][a-zA-Z0-9\s-_,'.()%]{1,}$/)) {
                    desc_valid = false;
                    $(this).next().text('Enter a valid product description');
                } else {
                    desc_valid = true;
                    $(this).next().text('');
                    $("#submit").attr("disabled", false);
                }

            });

            // Client-side validation for unit input
            $('#pro_unit').on('change', function () {
                const pro_unit = $(this).val();
                if (pro_unit == "--Select unit--") {
                    unit_valid = false;
                    $(this).next().text('Please select a unit');
                } else {
                    unit_valid = true;
                    $(this).next().text('');
                    $("#submit").attr("disabled", false);
                }

            });

            // Client-side validation for stock and reorder input
            $('#pro_stock, #pro_reorder').on('input', function () {
                // Get the current value of the input
                let value = $(this).val();

                // Replace any non-digit characters with an empty string
                value = value.replace(/[^\d]/g, '');

                // Set the new value of the input
                $(this).val(value);
            });

            // Client-side validation for price input
            $('#pro_price').on('input', function () {
                // Get the current value of the input
                let value = $(this).val();

                // Replace any non-digit or decimal point characters with an empty string
                value = value.replace(/[^\d.]/g, '');

                // Ensure there is only one decimal point
                if ((value.match(/\./g) || []).length > 1) {
                    value = value.replace(/\.$/g, '');
                }

                // Set the new value of the input
                $(this).val(value);
            });

            $('#submit').on('click', function () {
                if (name_valid == false || category_valid == false || image_valid == false || desc_valid == false) {
                    $("#submit").attr("disabled", true);
                }
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
                <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-basket2"></i><span>Manage Products</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="viewproducts.php">
                            <i class="bi bi-circle"></i><span>View products</span>
                        </a>
                    </li>
                    <li>
                        <a class="active " href="addproduct.php">
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
                <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                    <i class="ri-truck-line"></i><span>Delivery Person</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="viewdeliveryguy.php">
                            <i class="bi bi-circle"></i><span>View delivery persons</span>
                        </a>
                    </li>
                    <li>
                        <a href="adddeliveryguy.php">
                            <i class="bi bi-circle"></i><span>Add delivery person</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Delivery Boy Page Nav -->
        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
                    <li class="breadcrumb-item">Manage Products</li>
                    <li class="breadcrumb-item active">Add new product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">
                <div class="col-lg-9">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Enter Product Details</h5>

                            <!-- General Form Elements -->
                            <form action="#" method="POST" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="pro_name" class="form-control" name="pro_name" required>
                                        <span id="pronameError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Category</label>
                                    <div class="col-sm-10">
                                        <select id="pro_category" class="form-select"
                                            aria-label="Default select example" name="pro_category" required>
                                            <option selected>--Select category--</option>
                                            <?php
                                            $category_query = "SELECT Category_Name FROM category";
                                            $category_result = mysqli_query($con, $category_query);
                                            while ($category_row = mysqli_fetch_array($category_result)) {
                                                ?>
                                                <option value="<?php echo $category_row["Category_Name"]; ?>"><?php echo $category_row["Category_Name"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <span id="procategoryError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputImage" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input id="pro_image" class="form-control" type="file" name="pro_image"
                                            accept="image/png,image/gif,image/jpeg" required>
                                        <span id="proimageError" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea id="pro_desc" class="form-control" style="height: 100px"
                                            name="pro_desc"></textarea>
                                        <span id="prodescriptionError" class="text-danger"></span>
                                    </div>
                                </div>

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
    if (isset($_POST["submit"])) {
        $proid = mysqli_insert_id($con);
        $name = $_POST["pro_name"];
        $category = $_POST["pro_category"];
        $image = $_FILES["pro_image"]["name"];
        $desc = mysqli_real_escape_string($con, $_POST["pro_desc"]);
        $query2 = "select Category_id from category where Category_Name='$category'";
        $result2 = mysqli_query($con, $query2);
        $r = mysqli_fetch_array($result2);
        $category_id = $r['Category_id'];
        $query3 = "insert into product (Product_id,Product_Name,Category_id,Product_Image,Description,Status) values('$proid','$name','$category_id','$image','$desc',1)";
        $result3 = mysqli_query($con, $query3);
        if ($result3) {
            $targetdir = "product_uploads/";
            $targetfilepath = $targetdir . basename($image);
            move_uploaded_file($_FILES["pro_image"]["tmp_name"], $targetfilepath);
        }
    }
    mysqli_close($con);
    ?>

</body>

</html>
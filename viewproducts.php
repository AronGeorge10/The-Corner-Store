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

    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

            let catname_valid = false, catdesc_valid = false;
            // Client-side validation for name input
            $('#cat_name').on('keyup', function () {
                var cat_name = $('#cat_name').val();
                if (!cat_name.match(/^[a-zA-Z][a-zA-Z\s]{3,}$/)) {
                    catname_valid = false
                    $('#cat_name').next().text('Enter a valid category name');
                } else {
                    catname_valid = true;
                    $('#cat_name').next().text('');
                    $('#submit').attr("disabled", false);
                }
            });

            //Client-side validation for description input
            $('#cat_desc').on('keyup', function () {
                var cat_desc = $('#cat_desc').val();
                if (!cat_desc.match(/^[a-zA-Z][a-zA-Z,.\s]{3,}$/)) {
                    catdesc_valid = false
                    $('#cat_desc').next().text('Enter a valid category description');
                    $('#submit').attr("disabled", true);
                } else {
                    catdesc_valid = true;
                    $('#cat_desc').next().text('');
                    $('#submit').attr("disabled", false);
                }
            });

            $('#submit').on('click', function () {
                if (catname_valid == false || catdesc_valid == false) {
                    $("#submit").attr("disabled", true);
                    $('#submitError').text('Enter valid category details');
                }
            });
        });

    </script>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="panel.php" style="cursor:pointer;" class="logo d-flex align-items-center">
                <img class="logo-img" src="assets/images/TCS.png" alt="">
                The&nbsp;<em style="cursor:pointer;"> Corner
                    Store</em>
            </a>

        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown">

                    <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
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

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown">

                    <!-- <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
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
                        <a class="active" href="viewproducts.php">
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
                    <li class="breadcrumb-item active">Add new category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
        </section>
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="card-title">Manage Products</h5>
                            </div>
                            <div class="col-md-6 text-right mt-3 ml-auto">
                                <div class="form-group" style="margin-left: 50%;">
                                    <input class="form-control" style="width:200px;" type="search" placeholder="Search"
                                        aria-label="Search" id="searchInput">
                                </div>
                            </div>
                        </div>
                        <!-- Table with striped rows -->
                        <div class="table-responsive">
                            <table id="productTable" class="table table-striped" data-page="1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Weight Option</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Update</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $product_query = "SELECT 
                                    product.Product_id, 
                                    product.Product_Name, 
                                    product.Category_id,
                                    product.Product_Image, 
                                    product.Status, 
                                    MIN(weight_options.Weight) AS Weight, 
                                    MIN(weight_options.Unit) AS Unit, 
                                    MIN(weight_options.Price) AS Price, 
                                    MIN(weight_options.Stock) AS Stock,
                                    MIN(weight_options.Weight_id) AS DefaultWeightOptionId
                                FROM product
                                INNER JOIN weight_options ON product.Product_id = weight_options.Product_id
                                GROUP BY product.Product_id";
                                    $product_result = mysqli_query($con, $product_query);

                                    $category_query = "SELECT * FROM category";
                                    $category_result = mysqli_query($con, $category_query);
                                    $categories = array();

                                    // Build an array of category ID to name mappings
                                    while ($category_row = mysqli_fetch_array($category_result)) {
                                        $categories[$category_row['Category_id']] = $category_row['Category_Name'];
                                    }

                                    $i = 1;
                                    while ($product_row = mysqli_fetch_array($product_result)) {

                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $i; ?>
                                            </th>
                                            <td>
                                                <?php echo $product_row['Product_Name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $categories[$product_row['Category_id']]; ?>
                                            </td>
                                            <td>
                                                <select class="form-control weight-option"
                                                    data-product-id="<?php echo $product_row['Product_id']; ?>">
                                                    <?php
                                                    $weight_query = "SELECT * FROM weight_options WHERE Product_id = {$product_row['Product_id']}";
                                                    $weight_result = mysqli_query($con, $weight_query);

                                                    // Build an array of weight ID to weight option mappings
                                                    $weights = array();
                                                    while ($weight_row = mysqli_fetch_array($weight_result)) {
                                                        $weights[$weight_row['Weight_id']] = array('Weight' => $weight_row['Weight'], 'Unit' => $weight_row['Unit'], 'Price' => $weight_row['Price'], 'Stock' => $weight_row['Stock']);
                                                    }

                                                    foreach ($weights as $weight_id => $weight) {
                                                        ?>
                                                        <option value="<?php echo $weight_id; ?>"
                                                            data-unit="<?php echo $weight['Unit']; ?>"
                                                            data-price="<?php echo $weight['Price']; ?>"
                                                            data-stock="<?php echo $weight['Stock']; ?>" <?php echo ($weight_id == $product_row['DefaultWeightOptionId']) ? 'selected="selected"' : ''; ?>>
                                                            <?php echo $weight['Weight'] . " " . $weight['Unit']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                            <td class="price-td" id="price-<?php echo $product_row['Product_id']; ?>">
                                                <?php echo isset($weights[$product_row['DefaultWeightOptionId']]) ? $weights[$product_row['DefaultWeightOptionId']]['Price'] : ''; ?>
                                            </td>
                                            <td class="stock-td" id="stock-<?php echo $product_row['Product_id']; ?>">
                                                <?php echo isset($weights[$product_row['DefaultWeightOptionId']]) ? $weights[$product_row['DefaultWeightOptionId']]['Stock'] : ''; ?>
                                            </td>
                                            <td><button class="edit-btn btn btn-primary"
                                                    data-id="<?php echo $product_row['Product_id']; ?>" data-toggle="modal"
                                                    data-target="<?php echo "#editModal" . $product_row['Product_id']; ?>">Update</button>
                                            </td>
                                            <td>
                                                <button
                                                    class=" <?php echo ($product_row['Status'] == 1) ? 'disable-btn btn btn-danger' : 'disable-btn btn btn-success'; ?>"
                                                    data-id="<?php echo $product_row['Product_id']; ?>"
                                                    data-status="<?php echo $product_row['Status']; ?>">
                                                    <?php echo ($product_row['Status'] == 1) ? 'Disable' : 'Enable'; ?>
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="<?php echo "editModal" . $product_row['Product_id']; ?>"
                                            tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="userModalLabel">Product Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center mb-2">
                                                            <div class="align-items-center">
                                                                <img id="productImage" class="img-fluid rounded"
                                                                    src="<?php echo 'product_uploads/' . $product_row['Product_Image']; ?>"
                                                                    alt="Product Image">
                                                            </div>
                                                        </div>
                                                        <form action="" method="POST" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="productimageInput">Product Image</label>
                                                                <input type="file" class="form-control" name="product_image"
                                                                    id="productimageInput">
                                                            </div>
                                                            <input type="hidden" name="product_id"
                                                                value="<?php echo $product_row['Product_id']; ?>">
                                                            <div class="form-group">
                                                                <label for="productnameInput">Product Name</label>
                                                                <input type="text" class="form-control" name="product_name"
                                                                    id="productnameInput"
                                                                    value="<?php echo $product_row['Product_Name']; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="weightInput">Weight</label>
                                                                <div class="input-group">
                                                                    <select class="form-control weight-option"
                                                                        name="product_weight">
                                                                        <?php
                                                                        while ($weight_row = mysqli_fetch_array($weight_result)) {
                                                                            $weights[$weight_row['Weight_id']] = array('Weight' => $weight_row['Weight'], 'Unit' => $weight_row['Unit'], 'Price' => $weight_row['Price'], 'Stock' => $weight_row['Stock']);
                                                                        }

                                                                        foreach ($weights as $weight_id => $weight) {
                                                                            ?>
                                                                            <option value="<?php echo $weight['Weight']; ?>"
                                                                                data-unit="<?php echo $weight['Unit']; ?>"
                                                                                data-price="<?php echo $weight['Price']; ?>"
                                                                                data-stock="<?php echo $weight['Stock']; ?>"
                                                                                <?php echo ($weight_id == $product_row['DefaultWeightOptionId']) ? 'selected="selected"' : ''; ?>>
                                                                                <?php echo $weight['Weight'] . " " . $weight['Unit']; ?>
                                                                            </option>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i
                                                                                class="bi bi-chevron-down"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="priceInput">Price(₹)/pack</label>
                                                                <input type="text" class="form-control price-td"
                                                                    name="product_price" id="priceInput"
                                                                    value="<?php echo isset($weights[$product_row['DefaultWeightOptionId']]) ? $weights[$product_row['DefaultWeightOptionId']]['Price'] : ''; ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stockInput">Add new stock</label>
                                                                <input type="text" class="form-control" name="product_stock"
                                                                    value="0" id="stockInput">
                                                            </div>
                                                            <div class="form-group float-right">
                                                                <input type="submit" class="btn btn-primary" value="Save"
                                                                    name="save">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End modal -->
                                        <?php
                                        $i = $i + 1;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
        $catid = mysqli_insert_id($con);
        $name = $_POST["cat_name"];
        $desc = $_POST["cat_desc"];
        $query2 = "insert into category (Category_id,Category_Name,Description) values('$catid','$name','$desc')";
        $result2 = mysqli_query($con, $query2);
        if ($result2) {
            echo "alert('Form successfully submitted')";
        }
    }
    ?>

    <?php
    if (isset($_POST["save"])) {
        $product_id = $_POST["product_id"];
        $name = $_POST["product_name"];
        $weight = $_POST["product_weight"];
        $price = $_POST["product_price"];
        $stock = $_POST["product_stock"];
        $image = $_FILES["product_image"]["name"];
        $query3 = "SELECT Product_Image from product where Product_Id=$product_id";
        $result3 = mysqli_query($con, $query3);
        $row3 = mysqli_fetch_array($result3);
        if ($image == NULL) {
            $image = $row3['Product_Image'];
        }
        $query4 = "UPDATE product SET Product_Name='$name',Product_Image='$image' WHERE Product_id=$product_id";
        $result4 = mysqli_query($con, $query4);
        $query5 = "UPDATE weight_options SET Price='$price',Stock=Stock+$stock where Product_id=$product_id AND Weight=$weight";
        $result5 = mysqli_query($con, $query5);
        if ($result4) {
            $targetdir = "product_uploads/";
            $targetfilepath = $targetdir . basename($image);
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetfilepath);
        }
        ?>
        <script>
            location.href = 'viewproducts.php';
        </script>
        <?php
    }
    ?>
    <script>
        $(document).ready(function () {

            $('.disable-btn').on('click', function () {
                // get the user id and status from the data attributes
                var productId = $(this).data('id');
                var status = $(this).data('status');
                var action = (status == 1) ? 'disable' : 'enable';

                // ask the user to confirm the action
                var confirmationMessage = (status == 1) ? 'Are you sure you want to delete this product?' : 'Are you sure you want to enable this product?';
                if (confirm(confirmationMessage)) {
                    // send an ajax request to the server to perform the action
                    $.ajax({
                        type: 'POST',
                        url: 'delete_product.php',
                        data: { productId: productId, action: action },
                        success: function (response) {
                            // update the button text and data status attribute
                            if (status == 1) {
                                $('.disable-btn[data-id="' + productId + '"]').text('Enable');
                                $('.disable-btn[data-id="' + productId + '"]').data('status', 0);
                                $('.disable-btn[data-id="' + productId + '"]').removeClass('btn-danger').addClass('btn-success')
                            } else {
                                $('.disable-btn[data-id="' + productId + '"]').text('Disable');
                                $('.disable-btn[data-id="' + productId + '"]').data('status', 1);
                                $('.disable-btn[data-id="' + productId + '"]').removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    });
                }
            });

            // Listen for changes in the weight option dropdown
            $('.weight-option').on('change', function () {
                // Get the selected weight option ID
                var weightOptionId = $(this).val();

                // Find the corresponding unit, price, and stock values
                var unit = $('option[value="' + weightOptionId + '"]').data('unit');
                var price = $('option[value="' + weightOptionId + '"]').data('price');
                var stock = $('option[value="' + weightOptionId + '"]').data('stock');

                // Update the unit, price, and stock values in the table
                $(this).closest('tr').find('.unit-td').text(unit);
                $(this).closest('tr').find('.price-td').text(price);
                $(this).closest('.modal-body').find('#priceInput').val(price);
                $(this).closest('tr').find('.stock-td').text(stock);
            });

            //search bar
            $('#searchInput').keyup(function () {
                var searchText = $(this).val().toLowerCase();
                $('#productTable tbody tr').each(function () {
                    var rowText = $(this).text().toLowerCase();
                    var showRow = rowText.indexOf(searchText) > -1;
                    $(this).toggle(showRow);
                });
            });
        });

    </script>

</body>

</html>
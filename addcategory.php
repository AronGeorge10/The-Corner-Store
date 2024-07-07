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
    <!-- <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->

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

            //Client-side validation for category name input
            $('#cat_name').on('keyup', function () {
                var cat_name = $('#cat_name').val();
                if (!cat_name.match(/^[a-zA-Z][a-zA-Z\s]{2,}$/)) {
                    catname_valid = false
                    $('#cat_name').next().text('Enter a valid category name');
                }
                else {
                    // Check if the email already exists
                    $('#cat_name').next().text('');
                    $.ajax({

                        method: 'POST',
                        url: 'categoryvalidate.php',
                        data: {
                            cat_name: cat_name
                        },
                        success: function (data) {
                            if (data != '0') {
                                catname_valid = false
                                $('#cat_name').next().text('Category already exists');
                                $('#submit').attr("disabled", true);
                            } else {
                                catname_valid = true
                                $('#cat_name').next().text('');
                                $('#submit').attr("disabled", false);
                            }
                        }
                    });
                }
            });

            //Client-side validation for description input
            $('#cat_desc').on('keyup', function () {
                var cat_desc = $('#cat_desc').val();
                if (!cat_desc.match(/^[a-zA-Z0-9][a-zA-Z0-9\s-_,'.()%]{1,}$/)) {
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
                        <a href="addproduct.php">
                            <i class="bi bi-circle"></i><span>Add new product</span>
                        </a>
                    </li>
                    <li>
                        <a class="active" href="addcategory.php">
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
            <h1>Add Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
                    <li class="breadcrumb-item">Manage Products</li>
                    <li class="breadcrumb-item active">Add new category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="text-left">
                <button class="btn btn-primary mb-5" data-toggle="modal" data-target="#Modal">Add Category</button>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5 class="card-title">Category</h5>
                                </div>
                                <div class="col-md-6 text-right mt-3 ml-auto">
                                    <input class="form-control" style="width:200px;" type="search" placeholder="Search"
                                        aria-label="Search" id="searchInput">
                                </div>
                            </div>

                            <!-- Table with striped rows -->
                            <table id="categoryTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $category_query = "select * from category";
                                    $category_result = mysqli_query($con, $category_query);
                                    $i = 1;
                                    while ($category_row = mysqli_fetch_array($category_result)) {
                                        ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $i ?>
                                            </th>
                                            <td>
                                                <?php echo $category_row['Category_Name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $category_row['Description'] ?>
                                            </td>
                                            <td><button
                                                    class="<?php echo ($category_row['Status'] == 1) ? 'disable-btn btn btn-danger' : 'disable-btn btn btn-success'; ?>"
                                                    data-id="<?php echo $category_row['Category_id']; ?>"
                                                    data-status="<?php echo $category_row['Status']; ?>">
                                                    <?php echo ($category_row['Status'] == 1) ? 'Disable' : 'Enable'; ?>
                                                </button></td>
                                        </tr>
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
        </section>
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document" style="max-width: 600px; margin: 1.75rem auto;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- General Form Elements -->
                        <form action="#" method="POST">
                            <div class="row mb-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10">
                                    <input type="text" id="cat_name" class="form-control" name="cat_name" required>
                                    <span id="catnameError" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="cat_desc" class="form-control" style="height: 100px"
                                        name="cat_desc"></textarea>
                                    <span id="catdescriptionError" class="text-danger"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 text-center">
                                    <input type="submit" id="submit" class="btn btn-primary" value="Submit"
                                        name="submit" disabled><br>
                                    <span id="submitError" class="text-danger"></span>
                                </div>
                            </div>

                        </form><!-- End Form -->
                    </div>
                </div>
            </div>
        </div>


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
    <script>
        $(document).ready(function () {
            $('.disable-btn').on('click', function () {
                // get the user id and status from the data attributes
                var categoryId = $(this).data('id');
                var status = $(this).data('status');
                var action = (status == 1) ? 'disable' : 'enable';
                // ask the user to confirm the action
                var confirmationMessage = (status == 1) ? 'Are you sure you want to delete this category?\nDoing so will delete all products of this category as well.' : 'Are you sure you want to enable this category?';
                if (confirm(confirmationMessage)) {
                    // send an ajax request to the server to perform the action
                    $.ajax({
                        type: 'POST',
                        url: 'delete_category.php',
                        data: { categoryId: categoryId, action: action },
                        success: function (response) {
                            // update the button text and data status attribute
                            if (status == 1) {
                                $('.disable-btn[data-id="' + categoryId + '"]').text('Enable');
                                $('.disable-btn[data-id="' + categoryId + '"]').data('status', 0);
                                $('.disable-btn[data-id="' + categoryId + '"]').removeClass('btn-danger').addClass('btn-success')
                            } else {
                                $('.disable-btn[data-id="' + categoryId + '"]').text('Disable');
                                $('.disable-btn[data-id="' + categoryId + '"]').data('status', 1);
                                $('.disable-btn[data-id="' + categoryId + '"]').removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    });
                }
            });


            //search bar
            $('#searchInput').keyup(function () {
                var searchText = $('#searchInput').val().toLowerCase();
                $('#categoryTable tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
                });
            });
        });
    </script>

    <?php
    if (isset($_POST["submit"])) {
        $catid = mysqli_insert_id($con);
        $name = $_POST["cat_name"];
        $desc = $_POST["cat_desc"];
        $query2 = "insert into category (Category_id,Category_Name,Description,Status) values('$catid','$name','$desc',1)";
        $result2 = mysqli_query($con, $query2);
        if ($result2) {
            echo "<script> 
            window.location.href = 'addcategory.php';
          </script>";
        }
    }
    mysqli_close($con);
    ?>

</body>

</html>
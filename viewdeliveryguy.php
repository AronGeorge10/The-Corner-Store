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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Javascript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->



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


        .profile-pic img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="panel.php" style="cursor:pointer;" class="logo d-flex align-items-center">
                <img src="assets/images/TCS.png" alt="">
                The&nbsp;<em style="cursor:pointer;"> Corner
                    Store</em>
            </a>

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
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                    href="manageproduct.php">
                    <i class="bi bi-basket2"></i><span>Manage Products</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
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
                <a class="nav-link collapsed" data-bs-target="#components-nav2" data-bs-toggle="collapse" href="#">
                    <i class="ri-truck-line"></i><span>Delivery Person</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav2" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="active" href="viewdeliveryguy.php">
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
            <h1>View Delivery Persons</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
                    <li class="breadcrumb-item">Delivery Person</li>
                    <li class="breadcrumb-item active">View Delivery Persons</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <?php
        $query = "SELECT * FROM `register_tbl` where Role like 2";
        $result = mysqli_query($con, $query);
        ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <h5 class="card-title">Delivery Persons</h5>
                                </div>
                                <div class="col-md-6 text-right mt-3">
                                    <div class="form-group" style="margin-left: 50%;">
                                        <input class="form-control" style="width:200px;" type="search"
                                            placeholder="Search" aria-label="Search" id="searchInput">
                                    </div>
                                </div>
                            </div>
                            <!-- Table with striped rows -->
                            <div class="table-responsive">
                                <table id="deliveryguyTable" class="table table-lg table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">View</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $id = 1;
                                        while ($row = mysqli_fetch_array($result)) {
                                            $address_query = "SELECT * FROM `address` WHERE User_id = " . $row['User_id'];
                                            $address_result = mysqli_query($con, $address_query);
                                            echo "<tr><th scope='row'>" . $id . "</th>
                            <td>" . $row["Name"] . "</td>
                            <td>" . $row["Email"] . "</td>
                            <td>" . $row["Phone"] . "</td>";
                                            ?>
                                            <td><button class="view-btn btn btn-primary"
                                                    data-id="<?php echo $row['User_id']; ?>" data-toggle="modal"
                                                    data-target="#userModal">View</button></td>

                                            <td><button
                                                    class="<?php echo ($row['Status'] == 1) ? 'disable-btn btn btn-danger' : 'disable-btn btn btn-success'; ?>"
                                                    data-id="<?php echo $row['User_id']; ?>"
                                                    data-status="<?php echo $row['Status']; ?>"
                                                    data-target="<?php echo "#disableModal" . $row['User_id']; ?>"
                                                    data-toggle="modal">
                                                    <?php echo ($row['Status'] == 1) ? 'Disable' : 'Enable'; ?>
                                                </button></td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="<?php echo "disableModal" . $row['User_id']; ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="disableModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="disableModalLabel">Reason
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#">
                                                                <div class="form-group">
                                                                    <textarea class="reason form-control"
                                                                        id="<?php echo "reason-" . $row['User_id']; ?>"
                                                                        data-id="<?php echo $row['User_id']; ?>"
                                                                        style="height: 100px" name="reason"
                                                                        required></textarea>
                                                                </div>
                                                                <div class="form-group float-right">
                                                                    <input type="submit" class="disable btn btn-primary"
                                                                        data-id="<?php echo $row['User_id']; ?>"
                                                                        data-status="<?php echo $row['Status']; ?>"
                                                                        value="Confirm" name="confirm" data-dismiss="modal"
                                                                        disabled>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End modal -->
                                            <?php
                                            echo "</tr>";
                                            $id = $id + 1;

                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with striped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">User Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="profile-pic d-flex flex-column align-items-center">
                                <img id="userImage" src="" alt="User Image">
                            </div>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="nameInput">Name:</label>
                                <input type="text" class="form-control" id="nameInput" readonly>
                            </div>
                            <div class="form-group">
                                <label for="emailInput">Email:</label>
                                <input type="email" class="form-control" id="emailInput" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usernameInput">Username:</label>
                                <input type="text" class="form-control" id="usernameInput" readonly>
                            </div>
                            <div class="form-group">
                                <label for="phoneInput">Phone:</label>
                                <input type="tel" class="form-control" id="phoneInput" readonly>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal -->

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
            // handle click event for view button
            $('.view-btn').on('click', function () {
                // get the user id from the data attribute
                var userId = $(this).data('id');
                // send AJAX request to get user details
                $.ajax({
                    url: 'get_user_details.php',
                    type: 'POST',
                    data: { id: userId },
                    dataType: 'json',
                    success: function (response) {
                        // populate modal with user details
                        $('#nameInput').val(response.Name);
                        $('#emailInput').val(response.Email);
                        $('#usernameInput').val(response.Username);
                        $('#phoneInput').val(response.Phone);
                        $('#houseInput').val(response.House_Name);
                        $('#cityInput').val(response.City);
                        $('#zipInput').val(response.Zip_Code);

                        var imageUrl = 'uploads/' + response.Image;
                        $('#userImage').attr('src', imageUrl);
                    }
                });
            });

            $('.reason').on('input', function () {
                var userId = $(this).data('id');
                var reason = $(this).val().trim();

                // disable button if reason is empty
                if (reason === '') {
                    $('.disable[data-id="' + userId + '"]').prop('disabled', true);
                } else {
                    $('.disable[data-id="' + userId + '"]').prop('disabled', false);
                }
            });

            // handle click event for disable/enable button
            $('.disable').on('click', function () {
                // get the user id and status from the data attributes
                var userId = $(this).data('id');
                var status = $(this).data('status');
                var action = (status == 1) ? 'disable' : 'enable';
                var reason = $('#reason-' + userId).val();
                // send an ajax request to the server to perform the action
                $.ajax({
                    type: 'POST',
                    url: 'disable_customer.php',
                    data: { userId: userId, action: action, reason: reason },
                    success: function (response) {
                        // update the button text and data status attribute
                        if (status == 1) {
                            $('.disable-btn[data-id="' + userId + '"]').text('Enable');
                            $('.disable-btn[data-id="' + userId + '"]').data('status', 0);
                            $('.disable-btn[data-id="' + userId + '"]').removeClass('btn-danger').addClass('btn-success')
                        } else {
                            $('.disable-btn[data-id="' + userId + '"]').text('Disable');
                            $('.disable-btn[data-id="' + userId + '"]').data('status', 1);
                            $('.disable-btn[data-id="' + userId + '"]').removeClass('btn-success').addClass('btn-danger');
                        }
                    }
                });
            });

            //search bar
            $('#searchInput').keyup(function () {
                var searchText = $('#searchInput').val().toLowerCase();
                $('#deliveryguyTable tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1)
                });
            });

            $('form').on('submit', function (event) {
                event.preventDefault();
            });

            // listen for modal's hidden.bs.modal event
            $('.modal').on('hidden.bs.modal', function () {
                // get the reason field and set its value to an empty string
                var reasonField = $(this).find('.reason');
                reasonField.val('');
            });

        });
    </script>
</body>

</html>
<?php
session_start();
if ($_SESSION['logout'] == "") {
    header("location:login.php");
}
include 'db.php';
?>
<?php
$query = "SELECT * FROM `register_tbl`";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin Panel</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- JQuery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap Javascript -->
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

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


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
                    $result = mysqli_query($con, $query1);
                    $row = mysqli_fetch_array($result);
                    ?>

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="uploads/<?php echo $row['Image'] ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            <?php echo $row['Name'] ?>
                        </span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>
                                <?php echo $row['Name'] ?>
                            </h6>
                            <span>Delivery Person</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="deliveryprofile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
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
                <a class="nav-link " href="deliverypanel.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="deliveryprofile.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row justify-content-center">

                <!-- Left side columns -->
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Products</h5>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Landmark</th>
                                            <th scope="col">Amount(+DC)</th>
                                            <th scope="col">Payment</th>
                                            <th scope="col">Delivery</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query2 = "SELECT * FROM delivery where Delivery_boy_id='$user_id'";
                                        $result2 = mysqli_query($con, $query2);
                                        $i = 1;
                                        $address_cell = "";
                                        while ($row2 = mysqli_fetch_array($result2)) {
                                            $order_id = $row2['Order_id'];
                                            $query3 = "SELECT * FROM orders where Order_id='$order_id'";
                                            $result3 = mysqli_query($con, $query3);
                                            $row3 = mysqli_fetch_array($result3);
                                            $user_id = $row2['User_id'];
                                            $query4 = "SELECT * FROM register_tbl where User_id='$user_id'";
                                            $result4 = mysqli_query($con, $query4);
                                            $row4 = mysqli_fetch_array($result4);
                                            $address_cell .= "<td>" . $row2["House_Name"] . ", " . $row2["City"] . ", " . $row2["Pin_Code"] . "</td>";
                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $i; ?>
                                                </th>
                                                <td>
                                                    <?php echo $row4['Name']; ?>
                                                </td>

                                                <?php echo $address_cell; ?>
                                                
                                                <td>
                                                    <?php echo $row2['Landmark']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['Amount'] + 20; ?> INR
                                                </td>
                                                <td>Completed</td>

                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input" <?php echo ($row3['Status'] == 'Placed') ? '' : 'checked'; ?> id="status"
                                                        data-id="<?php echo $row2['Order_id']; ?>"
                                                        data-user="<?php echo $row4['User_id']; ?>"
                                                        data-status="<?php echo $row2['Status']; ?>" data-toggle="modal"
                                                        data-checked="<?php echo ($row2['Status'] == 'Delivered') ? 'checked' : ''; ?>">
                                                </td>
                                            </tr>


                                            <!-- Modal -->
                                            <div class="modal fade" id="<?php echo "disableModal" . $row2['User_id']; ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="disableModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="disableModalLabel">Enter OTP
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="#">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" name="otp"
                                                                        id="<?php echo "otp-" . $row2['User_id']; ?>"
                                                                        data-id="<?php echo $row2['User_id']; ?>"
                                                                        required><br>
                                                                    <center><span id="otpError" class="text-danger"></span>
                                                                    </center>
                                                                </div>
                                                                <div class="form-group float-right">
                                                                    <input type="submit" class="confirm btn btn-primary"
                                                                        data-id="<?php echo $row2['Order_id']; ?>"
                                                                        data-user="<?php echo $row4['User_id']; ?>"
                                                                        value="Confirm" name="confirm" data-dismiss="modal">
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
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div><!-- End Right side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>The Corner Store</span></strong>. All Rights Reserved
        </div>
        <div class="credits">

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
            $('.form-check-input').on('change', function () {
                $(this).prop('checked', false);
                // get the order id and status from the data attributes
                var orderId = $(this).data('id');
                var userId = $(this).data('user');
                var status = $(this).data('status');
                $(".modal").modal('show');
                // send an ajax request to the server to perform the action
                $.ajax({
                    type: 'POST',
                    url: 'generate_delivery_otp.php',
                    data: { orderId: orderId, userId: userId },
                    success: function (response) {
                        console.log(response)
                    }
                });

                $('.confirm').on('click', function (e) {
                    e.preventDefault();
                    var orderId = $(this).data('id');
                    var userId = $(this).data('user');
                    var otp = $('#otp-' + userId).val();
                    $.ajax({
                        type: 'POST',
                        url: 'confirm_delivery_otp.php',
                        data: { orderId: orderId, userId: userId, otp: otp },
                        success: function (response) {
                            // check if OTP is valid before updating the checkbox state
                            if (response == 'success') {
                                $('.form-check-input[data-id="' + orderId + '"]').prop('checked', true);
                                $('.form-check-input[data-id="' + orderId + '"]').data('status', 'Delivered');
                                $('#otpError').text('');
                                $('#disableModal' + userId).modal('hide');
                            } else {
                                $('#otpError').text('Invalid OTP');
                            }
                        }
                    });
                    $('.form-check-input').prop('disabled', true); // disable the checkbox
                });
            });

            $('.close').on('click', function () {
                $('.modal').modal('hide');
            });
        });
    </script>

</body>

</html>
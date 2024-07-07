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

  <!-- JQuery cdn -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

    $(document).ready(function () {

      // Client-side validation for name input
      $('#fullName').on('keyup', function () {
        var name = $('#fullName').val();
        if (!name.match(/^[a-zA-Z][a-zA-Z\s]{3,}$/)) {
          $('#fullName').next().text('Enter a valid name');
          $('#save').attr("disabled", true);
        } else {
          $('#fullName').next().text('');
          $('#save').attr("disabled", false);
        }
      });

      $('#Phone').on('keyup', function () {
        var phone = $('#Phone').val();
        if (!phone.match(/^\d{10}$/)) {
          $('#Phone').next().text('Enter a valid phone number');
          $('#save').attr("disabled", true);
        } else {
          $('#Phone').next().text('');
          $('#save').attr("disabled", false);
        }
      });

      $('#edit-profile').on('submit', function (e) {
        var name = $('#fullName').val();
        var phone = $('#Phone').val();
        if (name === '' && phone === '') {
          e.preventDefault();
          return false;
        }

        if ($('#fullName').next().text() !== '' || $('#Phone').next().text() !== '') {
          e.preventDefault();
          return false;
        }
        return true;
      });

      $('#currentPassword').on('keyup', function () {
        var currentPasswd = $('#currentPassword').val();
        if (currentPasswd === '') {
          $('#change').attr("disabled", true);
        } else {
          $('#change').attr("disabled", false);
        }
      });

      $('#newPassword').on('keyup', function () {
        var passwd = $('#newPassword').val();
        var currentpasswd = $('#currentPassword').val();

        if (passwd === currentpasswd) {
          $('#newPassword').next().text('New password cannot be same as old password');
          $('#change').attr("disabled", true);
        } else if (!passwd.match(/^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/)) {
          $('#newPassword').next().text('Enter a valid password');
          $('#change').attr("disabled", true);
        } else {
          $('#newPassword').next().text('');
          if ($('#currentPassword').val() === '') {
            $('#change').attr("disabled", true);
          } else {
            $('#change').attr("disabled", false);
          }
        }
      });

      $('#renewPassword').on('keyup', function () {
        var passwd = $('#newPassword').val();
        var cpasswd = $('#renewPassword').val();
        if (cpasswd !== passwd) {
          $('#renewPassword').next().text('Passwords do not match');
          $('#change').attr("disabled", true);
        } else {
          $('#renewPassword').next().text('');
          if ($('#newPassword').next().text() !== '') {
            $('#change').attr("disabled", true);
          } else {
            $('#change').attr("disabled", false);
          }
        }
      });

      // Submit the form if all fields are valid and the username and email are not taken
      $('#change-password').on('submit', function (e) {
        var passwd = $('#newPassword').val();
        var cpasswd = $('#renewPassword').val();
        if (passwd === '' && cpasswd === '') {
          e.preventDefault();
          return false;
        }

        if ($('#newPassword').next().text() !== '' || $('#renewPassword').next().text() !== '') {
          e.preventDefault();
          return false;
        }
        return true;
      });

      // file upload function
      // Get the file input element
      const fileInput = document.getElementById('image-upload');
      // Add an event listener to the file input element to listen for changes
      fileInput.addEventListener('change', function (event) {
        // Get the selected file
        const selectedFile = event.target.files[0];
        // Create a new FileReader object
        const reader = new FileReader();
        // Set the onload function for the reader
        reader.onload = function (event) {
          // Get the image element
          const imageElement = document.getElementById('profile-image');
          // Set the src attribute of the image element to the data URL of the selected file
          imageElement.setAttribute('src', event.target.result);
        }
        // Read the selected file as a data URL
        reader.readAsDataURL(selectedFile);
      });

    });

  </script>

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
          $result = mysqli_query($con, $query1);
          $row = mysqli_fetch_array($result);
          $target = $row['Image'];
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
              <a class="dropdown-item d-flex align-items-center" href="adminprofile.php">
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

      <li class="nav-item">
        <a class="nav-link" href="adminprofile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="panel.php">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $row['Image'] ?>" alt="Profile" class="rounded-circle">
              <h2>
                <?php echo $row['Name'] ?>
              </h2>
              <h3>Administrator</h3>
              <div class="social-links mt-2">
                <a href="https://twitter.com/AronGeo83931524" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="https://www.facebook.com/aron.ayikon" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/a.r_o.n___ser/" class="instagram"><i class="bi bi-instagram"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">I am the administrator of <font color="blue">The Corner Store</font>. I
                    believe that the grocery
                    shopping should be easy and enjoyable without having to wait for hours in the queue. So it was a
                    mission for me to start this online enterprise which brings grocery shopping to your fingertips.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Name</div>
                    <div class="col-lg-9 col-md-8">
                      <?php echo $row['Name'] ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Enterprise</div>
                    <div class="col-lg-9 col-md-8">The Corner Store</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8">Administrator</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">India</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">
                      <?php echo $row['Phone'] ?>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">
                      <?php echo $row['Email'] ?>
                    </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="#" method="POST" enctype="multipart/form-data" id="edit-profile">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['Image'] ?>" alt="Profile" id="profile-image">
                        <div class="pt-2">
                          <label for="image-upload" class="btn btn-primary">
                            <i class="bi bi-upload" style="color: #fff;"></i>
                          </label>
                          <input type="file" name="image" id="image-upload" style="display: none;">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="fullName"
                          value="<?php echo $row['Name'] ?>">
                        <span class="text-danger" id="name_error"></span>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone"
                          value="<?php echo $row['Phone'] ?>">
                        <span class="text-danger" id="phone_error"></span>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="submit" id="save">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="" method="POST" id="change-password">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                        <span class="text-danger" id="newpassword_error"></span>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        <span class="text-danger" id="renewpassword_error"></span>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="change" id="change">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

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
  <!-- Update profile -->
  <?php
  if (isset($_POST["submit"])) {
    $na = $_POST["name"];
    $ph = $_POST["phone"];
    $im = $_FILES["image"]["name"];
    $user_id = $_SESSION["session"];
    if ($im == NULL) {
      $im = $target;
    }
    $query2 = "update register_tbl set Name='$na',Phone='$ph',Image='$im' where User_id='$user_id'";
    $result2 = mysqli_query($con, $query2);
    if ($result2) {
      $targetdir = "uploads/";
      $targetfilepath = $targetdir . basename($im);
      move_uploaded_file($_FILES["image"]["tmp_name"], $targetfilepath);
      ?>
      <script>
        location.href = 'adminprofile.php';
      </script>
      <?php
    }
  }
  ?>

  <!-- Change Password -->
  <?php
  if (isset($_POST["change"])) {
    $ps = $_POST["password"];
    $newps = $_POST["newpassword"];
    $renewps = $_POST["renewpassword"];
    $user_id = $_SESSION["session"];
    $query3 = "select Password from register_tbl where User_id='$user_id'";
    $result3 = mysqli_query($con, $query3);
    $row4 = mysqli_fetch_array($result3);
    $oldps = $row4['Password'];
    if ($ps == $oldps) {
      $query4 = "update register_tbl set Password='$newps' where User_id='$user_id'";
      $result4 = mysqli_query($con, $query4);
      $query5 = "update login_tbl set Password='$newps' where Login_id='$user_id'";
      $result5 = mysqli_query($con, $query5);
    } else {
      echo "<script>alert('Current Password is wrong');</script>";
    }
  }
  ?>

</body>

</html>
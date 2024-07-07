<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">



    <title>Profile</title>
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->

    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <?php
    $user_id = $_SESSION['session'];
    if ($user_id) {
        $user_id = $_SESSION['session'];
        $query = "SELECT * FROM `register_tbl` WHERE `User_id` = '$user_id'";
        $query1 = "SELECT * FROM `address` WHERE `User_id` = '$user_id'";
        $result = mysqli_query($con, $query);
        $result1 = mysqli_query($con, $query1);
        $row = mysqli_fetch_array($result);
        $row1 = mysqli_fetch_array($result1);
        $target = $row["Image"];
        $name = $row["Name"];
        $email = $row["Email"];
        $uname = $row["Username"];
        $phone = $row["Phone"];
        $house = $row1["House_Name"];
        $city = $row1["City"];
        $zip = $row1["Zip_Code"];

        $query1 = "SELECT * FROM `login_tbl` 
                        WHERE `Login_id` = '$user_id'";
        $result1 = mysqli_query($con, $query1);
        $row1 = mysqli_fetch_array($result1);
        $user = $row1["Username"];
    } else {
        $target = "default.webp";
    }
    ?>
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
                    var uid = <?= $_SESSION['session']; ?>
                    // Check if the email already exists
                    $('#emailInput').next().text('');
                    $.ajax({

                        method: 'POST',
                        url: 'emailvalidate.php',
                        data: {
                            email: email,
                            uid: uid
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
                    var uid = <?= $_SESSION['session']; ?>
                    // Check if the username already exists
                    $('#usernameInput').next().text('');
                    $.ajax({
                        method: "POST",
                        url: 'usernamevalidate.php',
                        data: {
                            username: username,
                            uid: uid
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

            // Client-side validation for house input
            $('#houseInput').on('keyup', function () {
                var house = $('#houseInput').val();
                if (!house.match(/^[a-zA-Z0-9\s\-']{3,}$/)) {
                    $('#houseInput').next().text('Enter a valid house name');
                    $('#save').attr("disabled", true);
                } else {
                    $('#houseInput').next().text('');
                    $('#save').attr("disabled", false);
                }
            });

            // Client-side validation for city input
            $('#cityInput').on('keyup', function () {
                var city = $('#cityInput').val();
                if (!city.match(/^[a-zA-Z]{4,}(?:-[a-zA-Z]+)*$/)) {
                    $('#cityInput').next().text('Enter a valid city name');
                    $('#save').attr("disabled", true);
                } else {
                    $('#cityInput').next().text('');
                    $('#save').attr("disabled", false);
                }
            });
            // Client-side validation for zip input
            $('#zipInput').on('keyup', function () {
                var zip = $('#zipInput').val();
                if (!zip.match(/^\d{6}$/)) {
                    $('#zipInput').next().text('Enter a valid zip code');
                    $('#save').attr("disabled", true);
                } else {
                    $('#zipInput').next().text('');
                    $('#save').attr("disabled", false);
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
                var phone = $('#phoneInput').val();
                var house = $('#houseInput').val();
                var city = $('#cityInput').val();
                var zip = $('#zipInput').val();
                var file = $('#imageInput').val();

                if (name === ''
                    // && username === ''
                    && phone === '' && house === '' && city === '' && zip === '' && file === '') {
                    e.preventDefault();
                    return false;
                }

                if ($('#nameInput').next().text() !== '' || $('#emailInput').next().text() !== '' || $('#usernameInput').next().text() !== '' || $('#phoneInput').next().text() !== '' || $('#houseInput').next().text() !== '' || $('#cityInput').next().text() !== '' || $('#zipInput').next().text() !== '' || $('#imageInput').next().text() !== '') {
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
        });



    </script>

    <style>
        .card {
            margin-top: 11%;
        }

        .profile-pic {
            background: linear-gradient(to bottom right, #7f00ff, #00bfff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 421px;
            width: 330px;
            margin-left: -20px;
            margin-right: 39px;
            margin-top: -20px;
            margin-bottom: -269px;
            border-bottom-left-radius: 5px;
            border-top-left-radius: 3px;
        }

        .profile-pic img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-btn {
            position: relative;
            top: 328px;
            right: 291px;
        }

        .valid-message {
            color: #7f00ff;
        }
    </style>
</head>


<body>
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky mb-5" style="background:#212529;">
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
                            <li><a href="new.php">Home</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li class="#">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="true" aria-expanded="false">About</a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">About Us</a>
                                    <a class="dropdown-item" href="#">Blog</a>
                                    <a class="dropdown-item" href="#">Testimonials</a>
                                    <a class="dropdown-item" href="#">Terms</a>
                                </div>
                            </li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                </div>
            </div>
            </li>
            </ul>
            </nav>
        </div>
        </div>
        </div>
    </header>

    <div class="container mt-5 pt-4">
        <div class="card shadow">
            <div class="card-body">
                <div class="media">

                    <div class="text-center">
                        <div class="profile-pic d-flex flex-column align-items-center">
                            <img src="<?php
                            echo "uploads/" . $target; ?>" class="rounded-circle" alt="Profile Picture">
                        </div>
                    </div>

                    <div class="media-body">
                        <h3 class="mt-0">
                            <?php echo "$name"; ?>
                        </h3>
                        <p>
                            <a href="mailto:<?php echo "$email" ?>">
                                <?php echo "$email"; ?>
                            </a>
                        </p>

                        <table class="table table-bordered">
                    </div>
                    <tbody>
                        <tr>
                            <th>Username</th>
                            <td>
                                <?php echo "$uname"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Phone number</th>
                            <td>
                                <?php echo "$phone"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>House name</th>
                            <td>
                                <?php echo "$house"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>City name</th>
                            <td>
                                <?php echo "$city"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Zip code</th>
                            <td>
                                <?php echo "$zip"; ?>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <div class="text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#changepasswordModal">Change
                            Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#" enctype="multipart/form-data" id="edit-form">
                        <div class="form-group">
                            <label for="nameInput">Name:</label>
                            <input type="text" class="form-control" id="nameInput" name="name"
                                value="<?php echo "$name"; ?>">
                            <span id="nameError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="usernameInput">Username:</label>
                            <input type="text" class="form-control" id="usernameInput" name="username"
                                value="<?php echo "$uname"; ?>">
                            <span id="usernameInput" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="phoneInput">Phone</span></label>
                            <input type="tel" class="form-control" id="phoneInput" name="phone"
                                value="<?php echo "$phone"; ?>">
                            <span id="phoneError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="houseInput">House Name:</label>
                            <input type="text" class="form-control" id="houseInput" name="house"
                                value="<?php echo "$house"; ?>">
                            <span id="houseError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="cityInput">City Name:</label>
                            <input type="text" class="form-control" id="cityInput" name="city"
                                value="<?php echo "$city"; ?>">
                            <span id="cityError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="zipInput">Zip Code:</label>
                            <input type="text" class="form-control" id="zipInput" name="zip"
                                value="<?php echo "$zip"; ?>">
                            <span id="zipError" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="imageInput">Profile Image:</label>
                            <input type="file" class="form-control" id="imageInput" name="file" onchange="show(this)">
                            <span id="imageError" class="text-danger"></span>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-success" id="save" data-toggle="modal"
                                data-target="#  Modal" name="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="changepasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changepasswordModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="change-password">
                        <div class="form-group">
                            <label for="currentPassword">Current Password:</label>
                            <input type="password" class="form-control" id="currentPassword" name="password">
                            <span id="currentpassword_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password:</label>
                            <input type="password" class="form-control" id="newPassword" name="newpassword">
                            <span id="newpassword_error" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="renewPassword">Confirm New Password:</label>
                            <input type="password" class="form-control" id="renewPassword" name="renewpassword">
                            <span id="currentpassword_error" class="text-danger"></span>
                        </div>

                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" id="change" data-toggle="modal"
                                data-target="#  Modal" name="change" value="Change Password">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

<?php
if (isset($_POST["submit"])) {
    $user_id = $_SESSION['session'];
    // echo "<script>alert('$user_id');</script>";
    $na = $_POST["name"];
    $us = $_POST["username"];
    $ph = $_POST["phone"];
    $im = $_FILES["file"]["name"];
    $house = $_POST["house"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    if ($im == NULL) {
        $im = $target;
    }
    if ($us == NULL) {
        echo "<script>$('#btn').attr('disabled', true);</script>";
    }
    $que = "update register_tbl set Name='$na',Username='$us',Phone='$ph',Image='$im' WHERE User_id='$user_id'";
    $que1 = "UPDATE login_tbl SET Username='$us' WHERE Login_id='$user_id'";
    $que2 = "update address set House_Name='$house',City='$city',Zip_Code='$zip' WHERE Address_id='$user_id'";
    $res = mysqli_query($con, $que);
    $res1 = mysqli_query($con, $que1);
    $res2 = mysqli_query($con, $que2);
    if ($res) {
        $targetdir = "uploads/";
        $targetfilepath = $targetdir . basename($im);
        move_uploaded_file($_FILES["file"]["tmp_name"], $targetfilepath);
    }
    if ($res && $res1 && $res2) {
        ?>
        <script>
            location.href = 'viewprofile.php';
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
        ?>
        <script>
            location.href = 'viewprofile.php';
        </script>
        <?php
    } else {
        echo "<script>alert('Current Password is wrong');</script>";
    }
}
?>


</html>
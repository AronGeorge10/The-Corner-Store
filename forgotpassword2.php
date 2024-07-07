<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assets/icons/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor2/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <!--===============================================================================================-->


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap Javascript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /*//////////////////////////////////////////////////////////////////
[ FONT ]*/

        @font-face {
            font-family: Ubuntu-Regular;
            src: url('fonts/ubuntu/Ubuntu-Regular.ttf');
        }

        @font-face {
            font-family: Ubuntu-Bold;
            src: url('fonts/ubuntu/Ubuntu-Bold.ttf');
        }

        @font-face {
            font-family: JosefinSans-Bold;
            src: url('fonts/JosefinSans/JosefinSans-Bold.ttf');
        }



        /*//////////////////////////////////////////////////////////////////
[ RESTYLE TAG ]*/

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            font-family: Ubuntu-Regular, sans-serif;
        }

        /*---------------------------------------------*/
        a {
            font-family: Ubuntu-Regular;
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
            transition: all 0.4s;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
        }

        a:focus {
            outline: none !important;
        }

        a:hover {
            text-decoration: none;
            color: #1b3815;
        }

        /*---------------------------------------------*/
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin: 0px;
        }

        p {
            font-family: Ubuntu-Regular;
            font-size: 14px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
        }

        ul,
        li {
            margin: 0px;
            list-style-type: none;
        }


        /*---------------------------------------------*/
        input {
            outline: none;
            border: none;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            appearance: none;
            -webkit-appearance: none;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        textarea {
            outline: none;
            border: none;
        }

        textarea:focus,
        input:focus {
            border-color: transparent !important;
        }


        input::-webkit-input-placeholder {
            color: #1b3815;
        }

        input:-moz-placeholder {
            color: #1b3815;
        }

        input::-moz-placeholder {
            color: #1b3815;
        }

        input:-ms-input-placeholder {
            color: #1b3815;
        }

        textarea::-webkit-input-placeholder {
            color: #1b3815;
        }

        textarea:-moz-placeholder {
            color: #1b3815;
        }

        textarea::-moz-placeholder {
            color: #1b3815;
        }

        textarea:-ms-input-placeholder {
            color: #1b3815;
        }

        /*---------------------------------------------*/
        button {
            outline: none !important;
            border: none;
            background: transparent;
        }

        button:hover {
            cursor: pointer;
        }

        iframe {
            border: none !important;
        }

        /*//////////////////////////////////////////////////////////////////
[ Utility ]*/
        .txt1 {
            font-family: Ubuntu-Regular;
            font-size: 15px;
            color: #999999;
            line-height: 1.4;
        }

        .txt2 {
            font-family: Ubuntu-Regular;
            font-size: 15px;
            color: #57b846;
            line-height: 1.4;
        }

        .txt3 {
            font-family: Ubuntu-Bold;
            font-size: 15px;
            color: #57b846;
            line-height: 1.4;
            text-transform: uppercase;
        }


        /*//////////////////////////////////////////////////////////////////
[ login ]*/

        .limiter {
            width: 100%;
            margin: 0 auto;
        }

        .container-login100 {
            width: 100%;
            min-height: 100vh;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            padding: 15px;
            position: relative;
            background-color: #bfeeb7;
        }

        .wrap-login100 {
            width: 500px;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -webkit-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -o-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
            -ms-box-shadow: 0 3px 20px 0px rgba(0, 0, 0, 0.1);
        }


        /*==================================================================
[ Form ]*/

        .login100-form {
            width: 100%;
            position: relative;
        }

        .login100-form-title {
            font-family: JosefinSans-Bold;
            font-size: 30px;
            color: #fff;
            line-height: 1.2;
            text-align: center;
            display: block;
            position: absolute;
            width: 100%;
            top: 0;
            left: 0;
            background-color: #57b846;
            padding-top: 50px;
            padding-bottom: 39px;
        }

        /*------------------------------------------------------------------
[ Input ]*/

        .wrap-input100 {
            width: 100%;
            background-color: #fff;
            border-radius: 27px;
            position: relative;
            z-index: 1;
        }

        .input100 {
            font-family: JosefinSans-Bold;
            font-size: 15px;
            color: #1b3815;
            line-height: 1.2;

            position: relative;
            display: block;
            width: 100%;
            height: 55px;
            background: #ebebeb;
            border-radius: 27px;
            padding: 0 35px 0 35px;
        }


        /*------------------------------------------------------------------
[ Focus Input ]*/

        .focus-input100 {
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 50%;
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            -o-transform: translateX(-50%);
            transform: translateX(-50%);
            border-radius: 31px;
            background-color: #ebebeb;
            pointer-events: none;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .input100:focus+.focus-input100 {
            width: calc(100% + 20px);
        }

        /*------------------------------------------------------------------
[ Button ]*/
        .container-login100-form-btn {
            width: 100%;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .login100-form-btn {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            width: 100%;
            height: 50px;
            background-color: #57b846;
            border-radius: 25px;

            font-family: Ubuntu-Bold;
            font-size: 15px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;

            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            margin-top: 25px;
        }

        .login100-form-btn:hover {
            background-color: #1b3815;
        }


        /*------------------------------------------------------------------
[ Alert validate ]*/

        .validate-input {
            position: relative;
        }

        .alert-validate::before {
            content: attr(data-validate);
            position: absolute;
            z-index: 1000;
            max-width: 70%;
            background-color: #fff;
            border: 1px solid #c80000;
            border-radius: 14px;
            padding: 4px 25px 4px 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 10px;
            pointer-events: none;

            font-family: Ubuntu-Bold;
            color: #c80000;
            font-size: 13px;
            line-height: 1.4;
            text-align: left;

            visibility: hidden;
            opacity: 0;

            -webkit-transition: opacity 0.4s;
            -o-transition: opacity 0.4s;
            -moz-transition: opacity 0.4s;
            transition: opacity 0.4s;
        }

        .alert-validate::after {
            content: "\f06a";
            font-family: FontAwesome;
            display: block;
            position: absolute;
            z-index: 1100;
            color: #c80000;
            font-size: 16px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);
            right: 16px;
        }

        .alert-validate:hover:before {
            visibility: visible;
            opacity: 1;
        }

        @media (max-width: 992px) {
            .alert-validate::before {
                visibility: visible;
                opacity: 1;
            }
        }

        /*//////////////////////////////////////////////////////////////////
[ Responsive ]*/
        @media (max-width: 576px) {
            .login100-form {
                padding-left: 15px;
                padding-right: 15px;
            }
        }

        #uname_error {
            text-align: center;
            color: #e35c5c;
            font-family: 'Ubuntu', sans-serif;
            margin-top: -3%;
        }

        #login_error {
            text-align: center;
            color: #e35c5c;
            font-family: 'Ubuntu', sans-serif;
            /* margin-top: -16%; */
        }

        #customAlert {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        #customAlertBox {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form p-l-55 p-r-55 p-t-178 p-b-20" method="POST" action="">
                    <span class="login100-form-title">
                        Forgot Password?
                    </span>

                    <div class="wrap-input100 validate-input m-b-2" data-validate="Please enter email">
                        <input class="input100" type="text" name="email" placeholder="Enter your registered email">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input type="submit" class="login100-form-btn" name="submit" value="Reset">
                        <div class="text-right p-t-13 p-b-23">
                            <span class="txt1"><a href="login.php" class="txt2">
                                    Back
                                </a>
                            </span>


                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>


<?php
// Start session
session_start();
if (isset($_POST['submit'])) {



    // Include config file
    $con = mysqli_connect("localhost", "root", "", "supermarket");

    // Define variables and initialize with empty values
    $email = "";
    $email_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Check if email is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter your email.";
            echo "<script>alert('$email_err')</script>";
        } else {
            $email = trim($_POST["email"]);
        }

        // Validate email
        if (empty($email_err)) {
            // Prepare a select statement
            $sql = "SELECT User_id, Email FROM register_tbl WHERE Email = '$email'";

            if ($stmt = mysqli_prepare($con, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // Set parameters
                $param_email = $email;

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Store result
                    mysqli_stmt_store_result($stmt);

                    // Check if email exists, if yes then create a unique token and send email to user
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // Generate a unique token
                        // Generate random token
                        $token = bin2hex(random_bytes(32));

                        // Calculate expiration time (1 hour from now)
                        $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

                        // Bind parameters to update statement
                        $token_type = "password_reset";
                        $stmt->bind_param("ssss", $token, $expires_at, $email, $token_type);

                        // Execute the update statement
                        $stmt->execute();

                        // Check if update was successful
                        if ($stmt->affected_rows > 0) {
                            $reset_link = "newpassword.php";

                            // Send password reset email to the user
                            $to = $email;
                            $subject = 'Password reset request for your account';
                            $message = 'Hello,<br><br>You have requested to reset the password for your account. Please click on the following link to reset your password:<br><br>';
                            $message .= '<a href="' . $reset_link . '">' . $reset_link . '</a><br><br>';
                            $message .= 'If you did not request this reset, please ignore this email and your password will remain unchanged.<br><br>';
                            $message .= 'Thank you,<br>The Corner Store';
                            $headers = 'From: arongeorgejain2025@mca.ajce.in' . "\r\n";
                            $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

                            if (mail($to, $subject, $message, $headers)) {
                                echo "<script>alert('success')</script>";
                                // Redirect the user to the success page
                                header("Location: forgotpassword.php?status=success");
                                exit;
                            } else {
                                // Redirect the user to the error page
                                echo "<script>alert('failure')</script>";
                                header("Location: forgotpassword.php?status=error");
                                exit;
                            }
                        } else {
                            // Redirect the user to the error page
                            header("Location: forgotpassword.php?status=error");
                            exit;
                        }
                    }
                }
            }
        }
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    // Close
}
?>



</html>
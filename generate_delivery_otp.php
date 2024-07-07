<?php
require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'db.php';
if (isset($_POST['orderId'])) {
    $id = $_POST['orderId'];
    $user_id = $_POST['userId'];
    $query1 = "SELECT * FROM register_tbl WHERE User_id='$user_id'";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $name = $row1['Name'];
    $email = $row1['Email'];
    $bytes = random_bytes(4);
    $hex = bin2hex($bytes);
    $otp = rand(hexdec($hex), PHP_INT_MAX);
    $otp = substr($otp, 0, 6);
    // Update the customer's status
    $deliver_query = "UPDATE `delivery` SET `otp` = '$otp' WHERE `Order_id` = $id";
    mysqli_query($con, $deliver_query);

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
        $mail->Subject = 'OTP for delivery verification';
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
                <p>Please provide this otp to the delivery guy</p>
                <p>$otp</p>
                <p>Best regards,</p>
                <p>The Corner Store Team.</p>
            </body>
            </html>
                ";

        $mail->send();
        echo 'OTP sent successfully.';
    } catch (Exception $e) {
        echo 'Failed to send OTP. Error message: ', $mail->ErrorInfo;
    }
}
?>
<?php
session_start();
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mail/Exception.php';
require 'mail/PHPMailer.php';
require 'mail/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'arongeorgejain2025@mca.ajce.in'; //SMTP username
    $mail->Password = 'qfdvpjrjhaufxuxe'; //SMTP password
    $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('arongeorgejain2025@mca.ajce.in', 'The Corner Store');
    $email = $_SESSION["otp"];
    $mail->addAddress($email); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Reset password';
    $mail->Body = '<b>Dear User</b>
    <h3>We received a request to reset your password.</h3>
    <p>Kindly click the below link to reset your password</p>
    <a href="http://localhost/supermarket/newpassword.php">http://localhost/supermarket/newpassword.php</a>
    <br><br>
    <p>With regards,</p>
    <b>The Corner Store</b>';

    /*$mail->Body    = 'Please use this code to reset your password.<br> Here is your code: '.$code;*/
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    /*echo 'Message has been sent';*/
    $_SESSION["email"] = $email;
    $test=$_SESSION['email'];
    ?>
    <script>
        window.location.href = 'forgotpassword.php';
    </script>
<?php
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
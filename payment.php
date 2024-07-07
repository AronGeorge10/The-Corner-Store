<!DOCTYPE html>
<html lang="en">
<?php
$apikey = "rzp_test_Mw00rhtTxNAOPp";
$orderData = [
    'receipt' => 'rcptid_11',
    'amount' => 39900,
    // 39900 rupees in paise
    'currency' => 'INR'
];

$razorpayOrder = $api->order->create($orderData);
?>

<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: azure;
        }

        .container {
            width: 750px;
            height: 500px;
            border: 1px solid;
            background-color: white;
            display: flex;
            flex-direction: column;
            padding: 40px;
            justify-content: space-around;
        }

        .container h1 {
            text-align: center;
        }

        .first-row {
            display: flex;
        }

        .owner {
            width: 100%;
            margin-right: 40px;
        }

        .input-field {
            border: 1px solid #999;
        }

        .input-field input {
            width: 100%;
            border: none;
            outline: none;
            padding: 10px;
        }

        .selection {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .selection select {
            padding: 10px 20px;
        }

        button {
            background-color: blueviolet;
            color: white;
            text-align: center;
            text-transform: uppercase;
            text-decoration: none;
            padding: 10px;
            font-size: 18px;
            transition: 0.5s;
        }

        button:hover {
            background-color: dodgerblue;
        }

        .cards img {
            width: 100px;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <h1>Confirm Your Payment</h1>

            <div class="owner">
                <h3>Full Name</h3>
                <div class="input-field">
                    <input type="text">
                </div>
            </div>
            <div class="owner">
                <h3>Email</h3>
                <div class="input-field">
                    <input type="text">
                </div>
            </div>
            <div class="first-row">
                <div class="owner">
                    <h3>House Name</h3>
                    <div class="input-field">
                        <input type="text">
                    </div>
                </div>
                <div class="owner">
                    <h3>City</h3>
                    <div class="input-field">
                        <input type="text">
                    </div>
                </div>
                <div class="owner">
                    <h3>Pin Code</h3>
                    <div class="input-field">
                        <input type="text">
                    </div>
                </div>
            </div>
            <div class="second-row">
                <div class="card-number">
                    <h3>Mobile Number</h3>
                    <div class="input-field">
                        <input type="text">
                    </div>
                </div>
            </div>
            <button name="submit">Confirm</button>

        </div>
    </form>
</body>

</html>
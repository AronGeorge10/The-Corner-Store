<?php
session_start();
if ($_SESSION['logout'] == "") {
    header("location:login.php");
}
include 'db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .card-header {
            background-color: #4790f5;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#">Grocery Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Customers</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Sales</h4>
                    </div>
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <p>$20,000</p>
                        <h5>Number of Orders</h5>
                        <p>100</p>
                        <h5>Average Order Value</h5>
                        <p>$200</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Top Selling Products</h4>
                    </div>
                    <div class="card-body">
                        <ol>
                            <li>Apples (50 units)</li>
                            <li>Bananas (40 units)</li>
                            <li>Oranges (30 units)</li>
                            <li>Milk (20 units)</li>
                            <li>Bread (10 units)</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Management</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Date</th>
                                    <th>Order Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#001</td>
                                    <td>John Doe</td>
                                    <td>2023-02-15</td>
                                    <td>$150</td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>Jane Smith</td>
                                    <td>2023-02-16</td>
                                    <td>$200</td>
                                </tr>
                                <tr>
                                    <td>#003</td>
                                    <td>Bob Johnson</td>
                                    <td>2023-02-18</td>
                                    <td>$100</td>
                                </tr>
                                <tr>
                                    <td>#004</td>
                                    <td>Alice Brown</td>
                                    <td>2023-02-19</td>
                                    <td>$50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                $query = "SELECT * FROM `register_tbl` where User_id < 10";
                $result = mysqli_query($con, $query);
                ?>

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Customer Management</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    $address_query = "SELECT * FROM `address` WHERE Address_id = " . $row['User_id'];
                                    $address_result = mysqli_query($con, $address_query);

                                    echo "<tr><td>" . $row["User_id"] . "</td>
                                           <td>" . $row["Name"] . "</td>
                                           <td>" . $row["Email"] . "</td>
                                           <td>" . $row["Phone"] . "</td>";

                                    $address_cell = "";
                                    while ($row1 = mysqli_fetch_array($address_result)) {
                                        $address_cell .= "<td>" . $row1["House_Name"] . ", " . $row1["City"] . "</td>";
                                    }
                                    echo $address_cell;

                                    echo "</tr>";
                                }
                                ?>


                                <!-- <tr>
                                    <td>#001</td>
                                    <td>John Doe</td>
                                    <td>johndoe@example.com</td>
                                    <td>555-1234</td>
                                    <td>123 Main St, Anytown USA</td>
                                </tr>
                                <tr>
                                    <td>#002</td>
                                    <td>Jane Smith</td>
                                    <td>janesmith@example.com</td>
                                    <td>555-5678</td>
                                    <td>456 Oak St, Anytown USA</td>
                                </tr>
                                <tr>
                                    <td>#003</td>
                                    <td>Bob Johnson</td>
                                    <td>bjohnson@example.com</td>
                                    <td>555-9012</td>
                                    <td>789 Elm St, Anytown USA</td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
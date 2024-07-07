<?php
session_start();
$user_id = $_SESSION["session"];

$id = $_GET['id'];

include 'db.php';

$query1 = "SELECT * from register_tbl WHERE User_id='$user_id'";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_array($result1);
$query4 = "SELECT * from address WHERE User_id='$user_id'";
$result4 = mysqli_query($con, $query4);
$row4 = mysqli_fetch_array($result4);
$query2 = "SELECT * from orders WHERE Order_id='$id'";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2);
$query3 = "SELECT * from order_items WHERE Order_id='$id'";
$result3 = mysqli_query($con, $query3);

require('fpdf181/fpdf.php');


$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Order No
$pdf->Cell(30, 5, 'Order No', 0, 0);
$pdf->Cell(60, 5, ": $row2[Order_id]", 0, 0);

// Blank space
$pdf->Cell(20);

// The Corner Store
$pdf->Cell(30, 6, '');
$pdf->Cell(52, 6, 'THE CORNER STORE', 0, 1);

// Status
$pdf->Cell(30, 5, 'Status', 0, 0);
$pdf->Cell(60, 5, ": Complete", 0, 0);

// Blank space
$pdf->Cell(20);

// Date
$pdf->Cell(30, 6, '');
$pdf->Cell(15, 5, 'Date', 0, 0);
$pdf->Cell(60, 5, ": " . substr($row2['Updated_at'], 0, 10), 0, 1);

// Paid by
$pdf->Cell(30, 5, 'Paid by', 0, 0);
$pdf->Cell(60, 5, ": $row1[Name]", 0, 1);

// Phone
$pdf->Cell(30, 5, 'Phone', 0, 0);
$pdf->Cell(60, 5, ": $row1[Phone]", 0, 1);
$pdf->Line(10, 35, 200, 35);

$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(6, 6, '');
$pdf->Cell(30, 10, '#', 1, 0);
$pdf->Cell(50, 10, 'Product', 1, 0);
$pdf->Cell(50, 10, 'Quantity', 1, 0);
$pdf->Cell(50, 10, 'Price', 1, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(11); //Line break
$i = 1;
while ($row3 = mysqli_fetch_array($result3)) {
    $product_id = $row3['Product_id'];
    $weight_id = $row3['Weight_id'];
    $query5 = "SELECT Product_Name from product where Product_id='$product_id'";
    $result5 = mysqli_query($con, $query5);
    $row5 = mysqli_fetch_array($result5);
    $query6 = "SELECT Weight,Unit from weight_options where Weight_id='$weight_id'";
    $result6 = mysqli_query($con, $query6);
    $row6 = mysqli_fetch_array($result6);

    // Display product details
    $pdf->Cell(6, 6, '');
    $pdf->Cell(30, 10, $i, 1, 0);
    $pdf->Cell(50, 10, $row5['Product_Name'] . ' - ' . $row6['Weight'] . $row6['Unit'], 1, 0);
    $pdf->Cell(50, 10, $row3['Quantity'], 1, 0);
    $pdf->Cell(50, 10, $row3['Price'] . ' Rs', 1, 0);
    $pdf->Ln(11); //Line break
    $i = $i + 1;
}
$pdf->Ln(11); //Line break
$pdf->Cell(55, 15, 'Delivery Address: ', 0, 0);


$pdf->MultiCell(60, 5, "$row4[House_Name]\n$row4[City]\n$row4[Zip_Code]", 0, 1);

$pdf->Line(10, 110, 200, 110);

$pdf->SetY(120); // set the Y position to move upwards
$pdf->Cell(120, 10, '', 0, 0);
$pdf->Cell(50, 0, 'Subtotal', 0, 0);
$pdf->Cell(20, 0, ": $row2[Amount] Rs", 0, 1);
$pdf->Ln(11); //Line break

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(50, 5, 'Delivery Charge', 0, 0);
$pdf->Cell(20, 5, ': 20 Rs', 0, 1);

$pdf->Line(130, 140, 200, 140);

$pdf->Cell(120, 5, '', 0, 0);
$pdf->Cell(50, 20, 'Total', 0, 0);
$price = $row2['Amount'] + 20;
$pdf->Cell(20, 20, ": $price Rs", 0, 1);

$pdf->Output();

?>
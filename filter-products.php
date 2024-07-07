<?php
//Connect to database
include 'db.php';

// Retrieve the category from the query string
$category = $_GET['category'];
if ($category != "All") {
    $query1 = "SELECT Category_id from category where Category_Name='$category'";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_array($result1);
    $category_id = isset($row1['Category_id']) ? $row1['Category_id'] : null;
    error_log($category_id);
    $query2 = "SELECT * from product WHERE Category_id = '$category_id' AND Status not like 0";
} else {
    $query2 = "SELECT * FROM product WHERE Status not like 0";
}

// Execute the SQL query
$result2 = mysqli_query($con, $query2);

// Build the HTML code to display the filtered products
$html = '';
$html .= '<div id="products-list">';
$html .= '<div class="row">';
$html .= '<br><br>';
$query4 = "SELECT * FROM category where Status not like 0";
$result4 = mysqli_query($con, $query4);

$html .= '<div class="dropdown">';
$html .= '<button class="btn btn-primary dropdown-toggle" type="button" id="filter-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-filter"></i>Filter</button>';
$html .= '<div class="dropdown-menu" aria-labelledby="filter-dropdown">';
$html .= '<a class="dropdown-item" href="#" onclick="filterProducts(\'All\')">All</a>';
while ($row4 = mysqli_fetch_array($result4)) {
    $html .= '<a class="dropdown-item" href="#" onclick="filterProducts(\'' . $row4['Category_Name'] . '\')">' . $row4['Category_Name'] . '</a>';
}
$html .= '</div>';
$html .= '</div>';


while ($row2 = mysqli_fetch_array($result2)) {
    $query3 = "SELECT weight_options.Price
        FROM weight_options
        INNER JOIN (
            SELECT Product_id, MIN(Price) AS min_price
            FROM weight_options
            GROUP BY Product_id
        ) AS min_prices
        ON weight_options.Product_id = min_prices.Product_id AND weight_options.Price = min_prices.min_price
        WHERE weight_options.Product_id = {$row2['Product_id']}";
    $result3 = mysqli_query($con, $query3);

    $html .= '<div class="col-lg-4">';
    $html .= '<a href="product-details.php?Product_id=' . $row2['Product_id'] . '">';
    $html .= '<div class="trainer-item">';
    $html .= '<div class="image-thumb">';
    $html .= '<img src="product_uploads/' . $row2['Product_Image'] . '" alt="">';
    $html .= '</div>';
    $html .= '<div class="down-content">';
    while ($row3 = mysqli_fetch_array($result3)) {
        $html .= '<span><sup>₹</sup>' . $row3['Price'] . '</span>';
    }
    $html .= '<h4>' . $row2['Product_Name'] . '</h4>';
    $html .= '<p>' . $row2['Description'] . '</p>';
    $html .= '<ul class="social-icons">';
    $html .= '<li><a href="product-details.php?product_id=' . $row2['Product_id'] . '">+ Order</a></li>';
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</a>';
    $html .= '</div>';
}
$html .= '</div>';
$html .= '</div>';
// Return the HTML code to display the filtered products
echo $html;
?>
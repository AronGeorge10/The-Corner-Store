<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link
    href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">

  <title>The Corner Store</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">

  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    #addcart {
      display: inline-block;
      font-size: 15px;
      padding: 0px 20px;
      background-color: #ed563b;
      color: #fff;
      text-align: center;
      font-weight: 400;
      text-transform: uppercase;
      transition: all .3s;
    }

    button:disabled {
      cursor: default !important;
    }

    /* Review sytem */
    .star-rating {
      display: inline-block;
      font-size: 24px;
      color: #ddd;
    }

    .star-rating .star {
      cursor: pointer;
      display: inline-block;
      width: 20px;
      overflow: hidden;
    }

    .star-rating .star:hover,
    .star-rating .star.active {
      color: #ffcc00;
    }
  </style>
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="new.php" class="logo">The <em> Corner Store</em></a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="new.php">Home</a></li>
              <li><a href="products.php" class="active">Products</a></li>
              <li><a href="order_history.php">Order History</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                  aria-expanded="false">About</a>

                <div class="dropdown-menu">
                  <a class="dropdown-item" href="about.php">About Us</a>
                  <a class="dropdown-item" href="blog.php">Blog</a>
                  <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                  <a class="dropdown-item" href="terms.php">Terms</a>
                </div>
              </li>
              <li><a href="contact.php">Contact</a></li>
              <?php
              $user_id = $_SESSION['session'];
              $_SESSION['session'] = $user_id;
              $query1 = "SELECT * FROM register_tbl WHERE User_id='$user_id'";
              $result = mysqli_query($con, $query1);
              $row = mysqli_fetch_array($result);
              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="uploads/<?php echo $row['Image'] ?>" width="50" height="50" class="rounded-circle"
                    style="margin-top: -19px;">
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="d1 dropdown-item" style="color: #ed563b;" href="viewprofile.php">Edit
                    Profile</a>
                  <a class="d2 dropdown-item" style="color: #ed563b;" href="viewcart.php">My Cart</a>
                  <a class="d3 dropdown-item" style="color: #ed563b;" href="viewwishlist.php">My
                    Wishlist</a>
                  <a class="d3 dropdown-item" style="color: #ed563b;" href="logout.php">Log Out</a>
                </div>
              </li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Call to Action Start ***** -->
  <section class="section section-bg" id="call-to-action"
    style="background-image: url(assets/images/banner-image-1-1920x500.jpg)">
    <div class="container">
      <?php
      // Retrieve the product ID from the URL parameter
      $product_id = $_GET['Product_id'];
      // Retrieve the product information from the database based on the product ID
      $query1 = "SELECT * FROM product WHERE Product_id = $product_id";
      $result1 = mysqli_query($con, $query1);
      $row1 = mysqli_fetch_array($result1);
      $query2 = "SELECT * from weight_options where Product_id = $product_id";
      $result2 = mysqli_query($con, $query2);
      $row2 = mysqli_fetch_array($result2);
      ?>

      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="cta-content">
            <br>
            <br>
            <h2 style="color:#ed563b">
              <?php echo $row1['Product_Name']; ?>
            </h2>

          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- ***** Call to Action End ***** -->

  <!-- ***** Fleet Starts ***** -->
  <section class="section">
    <div class="container">
      <br>
      <br>
      <div class="row">
        <div class="col-md-8">
          <div class="">
            <img class="d-block w-100" src="<?php echo 'product_uploads/' . $row1['Product_Image']; ?>"
              alt="First slide">
          </div>
          <br>
        </div>

        <div class="col-md-4">
          <div class="contact-form">
            <form method="POST" id="contact">
              <div class="form-group">
                <p>
                  <?php echo $row1['Description']; ?>
                </p>
              </div>

              <label>Weight Option</label>
              <select id="weight_option" name="weight_option" onchange="updatePrice()">
                <?php
                $query2 = "SELECT * FROM weight_options WHERE Product_id = $product_id";
                $result2 = mysqli_query($con, $query2);
                while ($weight_row = mysqli_fetch_array($result2)) {
                  ?>
                  <option value="<?php echo $weight_row['Weight_id']; ?>"
                    data-price="<?php echo $weight_row['Price']; ?>">
                    <?php echo $weight_row['Weight']; ?>   <?php echo $weight_row['Unit']; ?>
                  </option>
                <?php }
                ?>
              </select>

              <div class="row">
                <div class="col-md-6">
                  <label>Price</label>
                  <p id="price">
                    ₹
                    <?php echo $row2['Price']; ?>
                  </p>
                </div>
                <img id="out-of-stock-img" src="assets/images/out-of-stock.jpg" alt="Out of Stock"
                  style="width: 80px; height: 80px; float: right;">
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Quantity</label>
                  <input type="number" name="quantity" id="quantity" placeholder="0">
                </div>
              </div>

              <div class="main-button">
                <div class="row">
                  <div class="col-md-6">
                    <input id="addcart" type="submit" name="submit" value="Add to Cart" disabled>
                  </div>
                  <div class="col-md-6">
                    <button id="wishlist-btn" class="wishlist-btn" name="wishlist"
                      style="margin-top:1px;background-color: #fff;color: #555; border: 1px solid #ccc;padding: 5px 10px;font-size: 16px;border-radius: 4px;  cursor: pointer;">
                      <i class="ri-heart-add-line"></i>
                    </button>
                  </div>
                  <div class="col-lg-8">
                    <span id="wishlistmessage" class="text-success"></span>
                  </div>
                </div>
              </div>
              <div class="back-button">
                <a href="products.php" class="btn-btn-primary">BACK</a>
              </div>
            </form>
          </div>
          <br>
        </div>
      </div><br><br>
      <h3>Rating and Reviews</h3><br><br>
      <div class="row">
        <div class="col-md-8">
          <div>
            <?php
            $review_query1 = "SELECT * FROM reviews WHERE User_id='$user_id' AND Product_id='$product_id'";
            $review_result1 = mysqli_query($con, $review_query1);
            $review_count1 = mysqli_num_rows($review_result1);
            if ($review_count1 > 0) {
              while ($review_row1 = mysqli_fetch_array($review_result1)) {
                $rating = $review_row1['Rating'];
                $comment = $review_row1['Comment'];
                $date = $review_row1['Date'];
                ?>
                <div class="d-inline-flex p-2">
                  <label class="form-control">Your Review</label>
                </div>
                <div class="review">
                  <div class="stars">
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $rating) {
                        ?>
                        <big><span style="color: #ffcc00;" class="star active">&#9733;</span></big>
                        <?php
                      } else {
                        ?>
                        <span style="color: #ddd;" class="star">&#9733;</span>
                        <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="comment">
                    <em>
                      <?php echo $comment; ?>
                    </em>
                  </div>
                  <div class="date">
                    <small>
                      <?php echo $date; ?>
                    </small>
                  </div>
                </div>
                <?php
              }
            } else {
              ?>
              <form id="review-form" method="POST" action="">
                <div class="form-group star-rating">
                  <label class="form-control">Rate this product</label>
                  <span class="star" data-value="1">&#9733;</span>
                  <span class="star" data-value="2">&#9733;</span>
                  <span class="star" data-value="3">&#9733;</span>
                  <span class="star" data-value="4">&#9733;</span>
                  <span class="star" data-value="5">&#9733;</span>
                  <input type="hidden" name="rating" id="rating" value="">
                </div>
                <div class="form-group">
                  <textarea id="review" class="review form-control" style="height: 100px" name="review"></textarea>
                </div>
                <span id="review-submitted" class="text-success"></span>
                <div class="form-group float-right">
                  <button type="submit" name="post" class="btn btn-primary">POST</button>
                </div>
              </form>
              <?php
            }
            ?>
          </div>
        </div>
        <div class="col-md-4">
          <!-- Display existing reviews here -->
          <?php
          $review_query2 = "SELECT * from reviews where Product_id='$product_id' AND User_id NOT LIKE '$user_id' LIMIT 2";
          $review_result2 = mysqli_query($con, $review_query2);
          $review_count2 = mysqli_num_rows($review_result2);
          if ($review_count2 > 0) {
            while ($review_row2 = mysqli_fetch_array($review_result2)) {
              $rating = $review_row2['Rating'];
              $comment = $review_row2['Comment'];
              $date = $review_row2['Date'];
              $user = $review_row2['User_id'];
              $query5 = "SELECT Name, Image from register_tbl WHERE User_id='$user'";
              $result5 = mysqli_query($con, $query5);
              $row5 = mysqli_fetch_array($result5);
              ?>
              <div class="date">
                <img class="rounded-circle" src="uploads/<?php echo $row5['Image']; ?>" width="30" height="30"> <?php echo $row5['Name']; ?>
              </div>
              <div class="review">
                <div class="stars">
                  <?php
                  for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                      ?>
                      <big><span style="color: #ffcc00;" class="star active">&#9733;</span></big>
                      <?php
                    } else {
                      ?>
                      <span style="color: #ddd;" class="star">&#9733;</span>
                      <?php
                    }
                  }
                  ?>
                </div>
                <div class="comment">
                  <em>
                    <?php echo $comment; ?>
                  </em>
                </div>
                <div class="date">
                  <small>
                    <?php echo $date; ?>
                  </small>
                </div>
              </div>
              <?php
            }
          } else {
            ?>
            <div class="d-flex justify-content-center align-items-center border border-success" style="height: 200px;">
              <span>No other reviews for this product !</span>
            </div>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- ***** Fleet Ends ***** -->

  <!-- ***** Footer Start ***** -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>
            Copyright © 2023 The Corner Store
          </p>
        </div>
      </div>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="assets/js/jquery-2.1.0.min.js"></script>

  <!-- Bootstrap -->
  <script src="assets/js/popper.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

  <!-- Plugins -->
  <script src="assets/js/scrollreveal.min.js"></script>
  <script src="assets/js/waypoints.min.js"></script>
  <script src="assets/js/jquery.counterup.min.js"></script>
  <script src="assets/js/imgfix.min.js"></script>
  <script src="assets/js/mixitup.js"></script>
  <script src="assets/js/accordions.js"></script>

  <!-- Global Init -->
  <script src="assets/js/custom.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script>
    // Get all stars
    const stars = document.querySelectorAll('.star-rating .star');
    const ratingInput = document.getElementById('rating');
    stars.forEach((star, index) => {
      star.addEventListener('click', () => {
        const rating = star.dataset.value;
        ratingInput.value = rating;
        stars.forEach((s, i) => {
          if (i <= index) {
            s.classList.add('active');
          } else {
            s.classList.remove('active');
          }
        });
      });
    });

    function updatePrice() {
      var select = document.getElementsByName("weight_option")[0];
      var price = select.options[select.selectedIndex].getAttribute("data-price");
      document.getElementById("price").innerHTML = "₹" + price;
    }

    $(document).ready(function () {
      $('#out-of-stock-img').hide();

      setTimeout(function () {
        $('#weight_option').trigger('change');
      }, 100);

      $('#review-form').submit(function (event) {

        const rating = $('#rating').val();
        const review = $('#review').val()

        // Send form data using AJAX
        $.ajax({
          type: 'POST',
          url: 'submit-review.php',
          data: {
            product_id: <?php echo $product_id ?>,
            rating: rating,
            review: review
          },
          success: function (response) {
            // handle success response here
            $('#review-submitted').text('Review has been submitted');
          },
          error: function (xhr, status, error) {
            // handle error response here
            console.log(xhr.responseText);
          }
        });
      });

      var button = document.querySelector('button');
      button.disabled = true;
      // Client-side validation for quantity input
      $('#quantity').on('input', function () {
        // Get the current value of the input
        let value = $(this).val();

        // Replace any non-digit characters or decimal points with an empty string
        value = value.replace(/[^\d]/g, '').replace(/\./g, '');

        // Check if the new value is less than 1
        if (value < 1) {
          // Set the value to 1
          $(this).val(1);
        } else {
          // Set the new value of the input
          $(this).val(value);
        }

        // Enable/disable the "addcart" button based on the validity of the input value
        if (/^\d+$/.test(value)) {
          $('#addcart').attr("disabled", false);
          $('#wishlist-btn').attr("disabled", false);
        } else {
          $('#addcart').attr("disabled", true);
          $('#wishlist-btn').attr("disabled", true);
        }
      });

      $('#weight_option').on('change', function () {
        var weight_id = $(this).val();
        $.ajax({
          type: "POST",
          url: "check_outofstock.php",
          data: {
            product_id: <?php echo $product_id; ?>,
            weight_id: weight_id
          },
          success: function (response) {
            console.log(response);
            if (response == 0) {
              $('#out-of-stock-img').show();
              $('#addcart').attr("disabled", true);
              $('#quantity').attr("disabled", true);
            } else {
              $('#out-of-stock-img').hide();
              $('#quantity').attr("disabled", false);
            }
          }
        });
      });

      $('#wishlist-btn').click(function (event) {
        event.preventDefault(); // Prevents the default action of the button click
        weight_id = $("#weight_option").val();
        quantity = $("#quantity").val();
        $.ajax({
          type: "POST",
          url: "addtowishlist.php", // Change the URL to the PHP file that handles the wishlist logic
          data: {
            product_id: <?php echo $product_id; ?>, // Pass the product ID to the wishlist.php file
            weight_id: weight_id, // Pass the weight ID to the wishlist.php file
            quantity: quantity
          },
          success: function (response) {
            // Handle the response from the wishlist.php file here
            alert(response); // Example response handling
            $('#wishlistmessage').text('Product added to wishlist');
          }
        });
      });

    });


  </script>

  <?php
  if (isset($_POST["submit"])) {
    $cartid = mysqli_insert_id($con);
    $userid = $_SESSION['session'];
    $weight_id = $_POST['weight_option'];
    $quantity = intval($_POST['quantity']);
    $query3 = "SELECT p.Product_Name, w.Weight, w.Unit, w.Price FROM product p JOIN weight_options w ON p.Product_id = w.Product_id WHERE w.Weight_id = $weight_id";
    $result3 = mysqli_query($con, $query3);
    $row3 = mysqli_fetch_array($result3);
    $price = floatval($quantity) * floatval($row3['Price']);
    $product = [
      'name' => $row3['Product_Name'],
      'weight' => $row3['Weight'],
      'unit' => $row3['Unit'],
      'price' => $row3['Price'],
      'quantity' => $quantity
    ];
    // If cart is empty, initialize it as an empty array
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
    // Add product to cart
    array_push($_SESSION['cart'], $product);
    $query4 = "INSERT INTO cart (Cart_id,User_id,Product_id,Weight_id,Quantity,Price,Created_at) VALUES ($cartid,$userid,$product_id,$weight_id,$quantity,$price,NOW())";
    $result4 = mysqli_query($con, $query4);
    if ($result4) {
      ?>
      <script> window.location.href = "products.php";</script>
      <?php
    }
  }
  mysqli_close($con)
    ?>

</body>

</html>
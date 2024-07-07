<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Colorlib Templates">
  <meta name="author" content="Colorlib">
  <meta name="keywords" content="Colorlib Templates">

  <!-- Title Page-->
  <title>Register yourself</title>

  <!-- Icons font CSS-->
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <!-- Font special for pages-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i"
    rel="stylesheet">

  <!-- Vendor CSS-->
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <!-- Main CSS-->
  <!-- <link href="assets/css/register.css" rel="stylesheet" media="all"> -->
  <!-- Jquery JS-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <!-- Vendor JS-->
  <script src="vendor/select2/select2.min.js"></script>
  <script src="vendor/datepicker/moment.min.js"></script>
  <script src="vendor/datepicker/daterangepicker.js"></script>

  <!-- Main JS-->
  <script src="js/global.js"></script>
  <script>

    function show(input) {
      debugger;
      var validExtensions = ['jpg', 'png', 'jpeg']; //array of valid extensions
      var fileName = input.files[0].name;
      var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
      const button = document.querySelector('button');
      if ($.inArray(fileNameExt, validExtensions) == -1) {
        input.type = ''
        input.type = 'file'
        $('#user_img').attr('src', "");
        // alert("Only these file types are accepted : "+validExtensions.join(', '));
        $("#image_error").text("Only jpg, jpeg and png files are allowed")
        // $('#btn').attr("disabled", true);
      }
      else {
        if (input.files && input.files[0]) {
          var filerdr = new FileReader();
          filerdr.onload = function (e) {
            $('#user_img').attr('src', e.target.result);
            $("#image_error").text("")
            // $('#btn').attr("disabled", false);
          }
          filerdr.readAsDataURL(input.files[0]);
        }
      }
    }
    $(document).ready(function () {

      let pass_test, uname_test, uname, email_test, name_valid, email_valid, uname_valid, passwd_valid, cpasswd_valid, phone_valid, house_valid, city_valid, zip_valid;
      $("#name").keyup(function () {
        name = document.getElementById("name").value
        var reg_name = /^[a-zA-Z][a-zA-Z\s]{3,}$/
        let name_test = reg_name.test(name)
        if (name_test == false) {
          name_valid = false
          $("#name_error").text("Enter valid name")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          name_valid = true
          $("#name_error").text("")
          $('#btn').attr("disabled", false);
          $("#login_error").text("")
        }
      })

      $('#email').on('keyup', function () {
        let email = $('#email').val();
        if (!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
          $("#email_error").text("Enter valid email")
        }
        else {
          // Check if the email already exists
          $('#email_error').text('');
          $.ajax({

            method: 'POST',
            url: 'emailvalidate2.php',
            data: {
              email: email
            },
            success: function (data) {
              if (data != '0') {
                let email_valid = false;
                $('#email_error').text('Email already exists');
                $('#btn').attr("disabled", true);
              } else {
                email_valid = true;
                $('#email_error').html('<span class="text-success">Email available</span>');
                $('#btn').attr("disabled", false);
              }
            }
          });
        }
      });

      $("#username").keyup(function () {
        uname = document.getElementById("username").value
        var reg_uname = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[a-zA-Z][a-zA-Z0-9]{5,9}$/
        let uname_test = reg_uname.test(uname)
        if (uname_test == false) {
          uname_valid = false
          $("#uname_error").text("Enter valid username")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          $.ajax({
            url: 'usernamevalidate2.php',
            method: "POST",
            data: { username: uname },
            success: function (data) {
              if (data != '0') {
                uname_valid = false
                $('#uname_error').html('<span class="text-danger">Username Already exist</span>');
                $('#btn').attr("disabled", true);
                $("#login_error").text("")
              }
              else {
                uname_valid = true
                $('#uname_error').html('<span class="text-success">Username valid</span>');
                $("#login_error").text("")
                $('#btn').attr("disabled", false);
              }
            }
          })
        }
      })

      $("#passwd").keyup(function () {
        passwd = document.getElementById("passwd").value
        var reg_pass = /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*])[\w!@#$%^&*]{8,}$/
        //var reg_pass=/^[a-zA-Z]+$/
        let pass_test = reg_pass.test(passwd)
        if (pass_test == false) {
          passwd_valid = false
          $("#passwd_error").text("Enter valid password")
          $("#login_error").text("")
          $('#btn').attr("disabled", true);
          check = 1;
        }
        else {
          check = 0;
          passwd_valid = true
          $("#passwd_error").text("")
          $("#login_error").text("")
          $('#btn').attr("disabled", false);
        }
      })

      $("#cpasswd").keyup(function () {
        let passwd = document.getElementById("passwd").value
        let cpasswd = document.getElementById("cpasswd").value
        if (cpasswd != passwd) {
          cpasswd_valid = false
          $("#cpasswd_error").text("Passwords Missmatch");
          $("#login_error").text("");
          $('#btn').attr("disabled", true);
        } else {
          if (check == 1) {
            cpasswd_valid = false
            $('#btn').attr("disabled", true);
          }
          else {
            cpasswd_valid = true
            $("#cpasswd_error").text("");
            $("#login_error").text("");
            $('#btn').attr("disabled", false);
          }
        }
      })

      $("#phone").keyup(function () {
        phone = document.getElementById("phone").value
        var reg_phone = /^\d{10}$/
        let phone_test = reg_phone.test(phone)
        if (phone_test == false) {
          phone_valid = false
          $("#phone_error").text("Enter valid phone number")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          phone_valid = true
          $("#phone_error").text("")
          $('#btn').attr("disabled", false);
          $("#login_error").text("")
        }
      })

      $("#house").keyup(function () {
        house = document.getElementById("house").value
        var reg_house = /^[a-zA-Z0-9\s\-']{3,}$/
        let house_test = reg_house.test(house)
        if (house_test == false) {
          house_valid = false
          $("#house_error").text("Enter valid house name")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          house_valid = true
          $("#house_error").text("")
          $('#btn').attr("disabled", false);
          $("#login_error").text("")
        }
      })

      $("#city").keyup(function () {
        city = document.getElementById("city").value
        var reg_city = /^[a-zA-Z]{4,}(?:-[a-zA-Z]+)*$/
        let city_test = reg_city.test(city)
        if (city_test == false) {
          city_valid = false
          $("#city_error").text("Enter valid city name")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          city_valid = true
          $("#city_error").text("")
          $('#btn').attr("disabled", false);
          $("#city_error").text("")
        }
      })

      $("#zip").keyup(function () {
        zip = document.getElementById("zip").value
        var reg_zip = /^\d{6}$/
        let zip_test = reg_zip.test(zip)
        if (zip_test == false) {
          zip_exist = false
          $("#zip_error").text("Enter valid zip code")
          $('#btn').attr("disabled", true);
          $("#login_error").text("")
        }
        else {
          zip_exist = true
          $("#zip_error").text("")
          $('#btn').attr("disabled", false);
          $("#login_error").text("")
        }
      })


      let global_value = 0;
      $(".btn").click(function () {
        var cpasswd = document.getElementById("cpasswd").value
        var passwd = document.getElementById("passwd").value
        if (email_valid == true || uname_valid == true) {
          $('#btn').attr("disabled", true);
        }
        if (name_valid == false || email_valid == false || uname_valid == false || passwd_valid == false || cpasswd_valid == false || phone_valid == false || house_valid == false || city_valid == false || zip_valid == false) {
          $('#btn').attr("disabled", true);
          $("#login_error").text("Enter valid details")
        }
        else {
          $('#btn').attr("disabled", false);
          $("#login_error").text("")
        }
      })
    })

  </script>
  <style>
    textarea {
      resize: none;
    }

    textarea:focus,
    input:focus,
    .uneditable-input:focus {
      border-color: #b6f0ac !important;
      box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075) inset, 0 0 8px #b6f0ac !important;
      outline: 0 none !important;
    }

    /* ==========================================================================
   #FONT
   ========================================================================== */
    .font-robo {
      font-family: "Roboto", "Arial", "Helvetica Neue", sans-serif;
    }

    /* ==========================================================================
   #GRID
   ========================================================================== */
    .row {
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
    }

    .row-space {
      -webkit-box-pack: justify;
      -webkit-justify-content: space-between;
      -moz-box-pack: justify;
      -ms-flex-pack: justify;
      justify-content: space-between;
    }

    .col-2 {
      width: -webkit-calc((100% - 60px) / 2);
      width: -moz-calc((100% - 60px) / 2);
      width: calc((100% - 60px) / 2);
    }

    @media (max-width: 767px) {
      .col-2 {
        width: 100%;
      }
    }

    /* ==========================================================================
   #BOX-SIZING
   ========================================================================== */
    /**
 * More sensible default box-sizing:
 * css-tricks.com/inheriting-box-sizing-probably-slightly-better-best-practice
 */
    html {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
    }

    * {
      padding: 0;
      margin: 0;
    }

    *,
    *:before,
    *:after {
      -webkit-box-sizing: inherit;
      -moz-box-sizing: inherit;
      box-sizing: inherit;
    }

    /* ==========================================================================
   #RESET
   ========================================================================== */
    /**
 * A very simple reset that sits on top of Normalize.css.
 */
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    blockquote,
    p,
    pre,
    dl,
    dd,
    ol,
    ul,
    figure,
    hr,
    fieldset,
    legend {
      margin: 0;
      padding: 0;
    }

    /**
 * Remove trailing margins from nested lists.
 */
    li>ol,
    li>ul {
      margin-bottom: 0;
    }

    /**
 * Remove default table spacing.
 */
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    /**
 * 1. Reset Chrome and Firefox behaviour which sets a `min-width: min-content;`
 *    on fieldsets.
 */
    fieldset {
      min-width: 0;
      /* [1] */
      border: 0;
    }

    button {
      outline: none;
      background: none;
      border: none;
    }

    /* ==========================================================================
   #PAGE WRAPPER
   ========================================================================== */
    .page-wrapper {
      min-height: 100vh;
    }

    body {
      font-family: "Roboto", "Arial", "Helvetica Neue", sans-serif;
      font-weight: 400;
      font-size: 14px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-weight: 400;
    }

    h1 {
      font-size: 36px;
    }

    h2 {
      font-size: 30px;
    }

    h3 {
      font-size: 24px;
    }

    h4 {
      font-size: 18px;
    }

    h5 {
      font-size: 15px;
    }

    h6 {
      font-size: 13px;
    }

    /* ==========================================================================
   #BACKGROUND
   ========================================================================== */
    .bg-blue {
      background: #2c6ed5;
    }

    .bg-red {
      background: #fa4251;
    }

    .bg-green {
      background: #bfeeb7;
    }

    /* ==========================================================================
   #SPACING
   ========================================================================== */
    .p-t-100 {
      padding-top: 100px;
    }

    .p-t-80 {
      padding-top: 80px;
    }

    .p-t-20 {
      padding-top: 20px;
    }

    .p-t-30 {
      padding-top: 30px;
    }

    .p-b-100 {
      padding-bottom: 100px;
    }

    /* ==========================================================================
   #WRAPPER
   ========================================================================== */
    .wrapper {
      margin: 0 auto;
    }

    .wrapper--w960 {
      max-width: 960px;
    }

    .wrapper--w680 {
      max-width: 680px;
    }

    /* ==========================================================================
   #BUTTON
   ========================================================================== */
    .btn {
      line-height: 40px;
      display: inline-block;
      padding: 0 25px;
      cursor: pointer;
      color: #fff;
      font-family: "Roboto", "Arial", "Helvetica Neue", sans-serif;
      -webkit-transition: all 0.4s ease;
      -o-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;
      font-size: 14px;
      font-weight: 700;
    }

    .btn--radius {
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
    }

    .btn--green {
      background: #57b846;
    }

    .btn--green:hover {
      background: #4dae3c;
    }

    /* ==========================================================================
   #DATE PICKER
   ========================================================================== */
    td.active {
      background-color: #2c6ed5;
    }

    input[type="date" i] {
      padding: 14px;
    }

    .table-condensed td,
    .table-condensed th {
      font-size: 14px;
      font-family: "Roboto", "Arial", "Helvetica Neue", sans-serif;
      font-weight: 400;
    }

    .daterangepicker td {
      width: 40px;
      height: 30px;
    }

    .daterangepicker {
      border: none;
      -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      display: none;
      border: 1px solid #e0e0e0;
      margin-top: 5px;
    }

    .daterangepicker::after,
    .daterangepicker::before {
      display: none;
    }

    .daterangepicker thead tr th {
      padding: 10px 0;
    }

    .daterangepicker .table-condensed th select {
      border: 1px solid #ccc;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      font-size: 14px;
      padding: 5px;
      outline: none;
    }

    /* ==========================================================================
   #FORM
   ========================================================================== */
    input {
      outline: none;
      margin: 0;
      border: none;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      width: 100%;
      font-size: 14px;
      font-family: inherit;
    }

    /* input group 1 */
    /* end input group 1 */
    .input-group {
      position: relative;
      margin-bottom: 32px;
      border-bottom: 1px solid #e5e5e5;
    }

    .input-icon {
      position: absolute;
      font-size: 18px;
      color: #ccc;
      right: 8px;
      top: 50%;
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%);
      cursor: pointer;
    }

    .input--style-2 {
      /* padding: 9px 0; */
      padding: 2px 0;
      color: #666;
      font-size: 16px;
      font-weight: 500;
    }

    .input--style-2::-webkit-input-placeholder {
      /* WebKit, Blink, Edge */
      color: #808080;
    }

    .input--style-2:-moz-placeholder {
      /* Mozilla Firefox 4 to 18 */
      color: #808080;
      opacity: 1;
    }

    .input--style-2::-moz-placeholder {
      /* Mozilla Firefox 19+ */
      color: #808080;
      opacity: 1;
    }

    .input--style-2:-ms-input-placeholder {
      /* Internet Explorer 10-11 */
      color: #808080;
    }

    .input--style-2:-ms-input-placeholder {
      /* Microsoft Edge */
      color: #808080;
    }

    .link {
      padding: 9px 0;
      color: #666;
      font-size: 16px;
      font-weight: 500;
    }

    .link:hover {
      color: #141212;
    }

    /* ==========================================================================
   #SELECT2
   ========================================================================== */
    .select--no-search .select2-search {
      display: none !important;
    }

    .rs-select2 .select2-container {
      width: 100% !important;
      outline: none;
    }

    .rs-select2 .select2-container .select2-selection--single {
      outline: none;
      border: none;
      height: 36px;
    }

    .rs-select2 .select2-container .select2-selection--single .select2-selection__rendered {
      line-height: 36px;
      padding-left: 0;
      color: #808080;
      font-size: 16px;
      font-family: inherit;
      font-weight: 500;
    }

    .rs-select2 .select2-container .select2-selection--single .select2-selection__arrow {
      height: 34px;
      right: 4px;
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -webkit-justify-content: center;
      -moz-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -webkit-align-items: center;
      -moz-box-align: center;
      -ms-flex-align: center;
      align-items: center;
    }

    .rs-select2 .select2-container .select2-selection--single .select2-selection__arrow b {
      display: none;
    }

    .rs-select2 .select2-container .select2-selection--single .select2-selection__arrow:after {
      font-family: "Material-Design-Iconic-Font";
      content: '\f2f9';
      font-size: 18px;
      color: #ccc;
      -webkit-transition: all 0.4s ease;
      -o-transition: all 0.4s ease;
      -moz-transition: all 0.4s ease;
      transition: all 0.4s ease;
    }

    .rs-select2 .select2-container.select2-container--open .select2-selection--single .select2-selection__arrow::after {
      -webkit-transform: rotate(-180deg);
      -moz-transform: rotate(-180deg);
      -ms-transform: rotate(-180deg);
      -o-transform: rotate(-180deg);
      transform: rotate(-180deg);
    }

    .select2-container--open .select2-dropdown--below {
      border: none;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      border: 1px solid #e0e0e0;
      margin-top: 5px;
      overflow: hidden;
    }

    /* ==========================================================================
   #TITLE
   ========================================================================== */

    .title {
      text-transform: uppercase;
      font-weight: 700;
      margin-bottom: 37px;
    }

    /* ==========================================================================
   #CARD
   ========================================================================== */
    .card {
      overflow: hidden;
      -webkit-border-radius: 3px;
      -moz-border-radius: 3px;
      border-radius: 3px;
      background: #fff;
    }

    .card-2 {
      -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      border-radius: 10px;
      width: 100%;
      display: table;
    }

    .card-2 .card-heading {
      background: url("assets/images/register-image.jpg") top left/cover no-repeat;
      width: 35.1%;
      display: table-cell;
      /* background-attachment: fixed; */
    }

    .card-2 .card-body {
      display: table-cell;
      /* padding: 80px 90px;
  padding-bottom: 88px; */
      padding: 50px 90px;
      padding-bottom: 40px;
    }

    @media (max-width: 767px) {
      .card-2 {
        display: block;
      }

      .card-2 .card-heading {
        width: 100%;
        display: block;
        padding-top: 300px;
        background-position: left center;
      }

      .card-2 .card-body {
        display: block;
        padding: 60px 50px;
      }
    }

    #name_error,
    #email_error,
    #uname_error,
    #passwd_error,
    #cpasswd_error,
    #phone_error,
    #house_error,
    #city_error,
    #zip_error {
      color: #e35c5c;
      font-family: 'Ubuntu', sans-serif;
      height: 15px;
      width: 200px;
      position: relative;
      top: -14px;
      /* margin-left: -74%;
    margin-top: -20px; */
    }

    #image_error {
      color: #e35c5c;
      font-family: 'Ubuntu', sans-serif;
      height: 15px;
      width: 245px;
      position: relative;
      top: 11px;
    }

    #login_error {
      color: #e35c5c;
      font-family: 'Ubuntu', sans-serif;
      height: 15px;
      width: 200px;
      position: relative;
      top: -74px;
    }

    .text-danger {
      margin-left: 0px;
    }

    .file::file-selector-button {
      background: #bfeeb7;
      border: 2px solid rgba(0, 0, 0, 0.02);
      border-radius: 20px;
      cursor: pointer;
    }

    .file::file-selector-button:hover {
      border: 2px solid #57b846;
    }
  </style>
</head>

<body>
  <div class="page-wrapper bg-green p-t-80 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
      <div class="card card-2">
        <div class="card-heading"></div>
        <div class="card-body">
          <h2 class="title">Sign Up</h2>
          <form class="form-inline" method="POST" action="" enctype="multipart/form-data">
            <div class="input-group">
              <input class="input--style-2" id="name" type="text" placeholder="Full Name" name="name" required>
            </div>
            <p id="name_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="email" type="email" placeholder="Email" spellcheck="false" name="email"
                required>
            </div>
            <p id="email_error"></p>
            <div class="input-group mb">
              <input class="input--style-2" id="username" type="text" placeholder="Username" spellcheck="false"
                name="username" required>
            </div>
            <p id="uname_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="passwd" type="password" placeholder="Password" name="password" required>
            </div>
            <p id="passwd_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="cpasswd" type="password" placeholder="Confirm Password" name="cpword"
                required>
            </div>
            <p id="cpasswd_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="phone" type="text" placeholder="Phone number" name="phone" required>
            </div>
            <p id="phone_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="house" type="text" placeholder="House Name" spellcheck="false"
                name="house" required>
            </div>
            <p id="house_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="city" type="text" placeholder="City Name" spellcheck="false" name="city"
                required>
            </div>
            <p id="city_error"></p>
            <div class="input-group">
              <input class="input--style-2" id="zip" type="text" placeholder="Zip Code" name="zip" required>
            </div>
            <p id="zip_error"></p>
            <div class="form-group">
              <p class="input--style-2">Profile Picture</p><input class="file" type="file" id="file" name="file"
                onchange="show(this)" accept="image/png,image/gif,image/jpeg" required />
            </div>
            <p id="image_error"></p>
            <div class="p-t-30">
              <!-- <button class="btn btn--radius btn--green" type="submit" name="submit" Onclick="index.php">Register</button> -->
              <input class="btn btn--radius btn--green" id="btn" type="submit" disabled name="submit" value="Register">
            </div>
            <p id="login_error"></p>
          </form>
          <a href="login.php" class="link" style="text-decoration:none;margin-left:150px;">Already registered?Sign
            in</a>
        </div>
      </div>
    </div>
  </div>

  <?php
  if (isset($_POST["submit"])) {
    $na = $_POST["name"];
    $em = $_POST["email"];
    $us = $_POST["username"];
    $ps = $_POST["password"];
    $ph = $_POST["phone"];
    $house = $_POST["house"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $cfile = $_FILES["file"]["name"];
    $status = $statusMsg = '';

    if ($us != null && $ps != null && $na != null && $em != null) {
      $conn = mysqli_connect("localhost", "root", "", "supermarket") or die("Connect failed: %s\n" . $conn->error);
      //Check if username already exists
      $sql = "select * from register_tbl where Username='$us'";
      $res = mysqli_query($conn, $sql);
      if (mysqli_num_rows($res) > 0) {
        ?>

        <script>
          // alert("User already exists");
          $('#btn').attr("disabled", true);
        </script>

        <?php
      } else {
        $conn = mysqli_connect("localhost", "root", "", "supermarket") or die("Connect failed: %s\n" . $conn->error);
        $userid = mysqli_insert_id($conn);
        $addressid = mysqli_insert_id($conn);
        $query = "insert into login_tbl(Login_id,User_id,Username,Password) values('$us','$ps')";
        $query1 = "insert into register_tbl(User_id,Name,Email,Username,Password,Phone,Image,Status) values('$userid','$na','$em','$us','$ps','$ph','$cfile',1)";
        $query2 = "insert into address(Address_id,User_id,House_Name,City,Zip_Code) values('$addressid','$userid','$house','$city','$zip')";
        $result = mysqli_query($conn, $query);
        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        if ($result && $result1 && $result2) {
          $targetdir = "uploads/";
          $targetfilepath = $targetdir . basename($cfile);
          move_uploaded_file($_FILES["file"]["tmp_name"], $targetfilepath);
          ?>

          <script>
            alert("Form successfully submitted");
            window.location.href = 'login.php';
          </script>

          <?php
        } else {
          ?>

          <script>
            alert("Enter the required details");
            $('#btn').attr("disabled", false);
          </script>

          <?php
        }

      }
    }
  }

  ?>

</body>

</html>
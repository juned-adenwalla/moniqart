<?php

session_start();
require('../includes/_functions.php');

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
  echo "<script>";
  echo "window.location.href = 'login'";
  echo "</script>";
} else {
  if ($_SESSION['userVerify'] != 'true') {
    echo "<script>";
    echo "window.location.href = 'verify'";
    echo "</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard | <?php echo _siteconfig('_sitetitle'); ?></title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<style>
    .wrapper {
    display: table;
    height: 100%;
    width: 100%;
    }

    .container-fostrap {
    display: table-cell;
    padding: 1em;
    text-align: center;
    vertical-align: middle;
    }
    .fostrap-logo {
    width: 100px;
    margin-bottom:15px
    }
    h1.heading {
    color: #fff;
    font-size: 1.15em;
    font-weight: 900;
    margin: 0 0 0.5em;
    color: #505050;
    }
    @media (min-width: 450px) {
    h1.heading {
        font-size: 3.55em;
    }
    }
    @media (min-width: 760px) {
    h1.heading {
        font-size: 3.05em;
    }
    }
    @media (min-width: 900px) {
    h1.heading {
        font-size: 3.25em;
        margin: 0 0 0.3em;
    }
    } 
    .card {
    display: block; 
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        /* border-radius: 2px; */
        /* box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);  */
        /* transition: box-shadow .25s;  */
    }
    .card:hover {
    /* box-shadow: 0 8px 17px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); */
    }
    .img-card {
    width: 100%;
    height:200px;
    border-top-left-radius:2px;
    border-top-right-radius:2px;
    display:block;
        overflow: hidden;
    }
    .img-card img{
    width: 100%;
    height: 200px;
    object-fit:cover; 
    transition: all .25s ease;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    } 
    .card-content {
    padding:15px;
    text-align:left;
    }
    .card-title {
    margin-top:0px;
    font-weight: 700;
    font-size: 1.65em;
    line-height: 1.1;
    }
    .card-title a {
    color: #000;
    text-decoration: none !important;
    }
    .card-read-more {
    border-top: 1px solid #D4D4D4;
    }
    .card-read-more a {
    text-decoration: none !important;
    padding:10px;
    font-weight:600;
    text-transform: uppercase
    }
</style>
<body>
  <div class="container-scroller">
    <?php include('templates/_header.php'); ?>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <?php include('templates/_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-12 grid-margin stretch-card">
                <?php _allcourses(); ?>
            </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include('templates/_footer.php'); ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <div class="container"></div>
</body>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>

</html>
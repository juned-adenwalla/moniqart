<?php 
session_start();

// if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] == true){
//   echo "<script>";
//   echo "window.location.href = 'index'";
//   echo "</script>";
// }

if(!isset($_SESSION['signup_success'])){
  $_SESSION['signup_success'] = false;
}

require('includes/_functions.php'); 
if(isset($_POST['submit'])){
    $userpassword = $_POST['password'];
    $useremail = $_POST['username'];

    _login($userpassword, $useremail);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/fonts/fonts/icomoon/style.css">

    <link rel="stylesheet" href="assets/css/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/css/style.css">

    <title>Login #2</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('assets/images/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <!-- <h3>Login to <strong>Colorlib</strong></h3> -->
            <h3><img style="width:120px;margin-bottom:20px;margin-left:-5px" src="uploads/images/<?php echo _siteconfig('_sitelogo'); ?>" alt=""></h3>
            <p class="mb-4">Hello there! Please log in with your credentials to access your account </p>
            <?php if($_SESSION['signup_success']){ ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Signup Success!</strong> kindly login to access dashboard.
            </div>
            <?php } ?>
            <form action="#" method="post" style="margin-bottom:20px">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="your-email@gmail.com" id="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Your Password" id="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="forget-password" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" name="submit" class="btn btn-block btn-primary">
            </form>
            <span>Don't have an account yet? <a style="text-decoration:none" href="signup">Create Account</a></span>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
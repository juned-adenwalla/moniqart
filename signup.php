<?php 

session_start();

// if(isset($_SESSION['isLoggedIn'])){
//   echo "<script>";
//   echo "window.location.href = 'index'";
//   echo "</script>";
// }

require('includes/_functions.php'); 
if(isset($_POST['submit'])){
    $username = $_POST['fullname'];
    $userphone = $_POST['phone'];
    $userpassword = $_POST['password'];
    $useremail = $_POST['email'];
    _signup($userpassword, $useremail, $username, $userphone);
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
    <link rel="stylesheet" href="assets/frontend/css/style.css?v=<?php echo time(); ?>">

    <title>Sign Up</title>
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
            <p class="mb-4">We're excited to have you join us. Please fill out the form below to create your account</p>
            <form action="#" method="post" style="margin-bottom:20px">
              <div class="form-group first">
                <label for="username">Full name</label>
                <input type="text" name="fullname" class="form-control" placeholder="Your Name" id="username" required>
              </div>
              <div class="form-group first">
                <label for="username">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Your Email" id="username" required>
              </div>
              <div class="form-group first">
                <label for="username">Phone no</label>
                <input type="text" name="phone" class="form-control" placeholder="Your Phone" id="username" required>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Your Password" id="password" required>
              </div>
              
              <!-- <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div> -->

              <input style="margin-top:30px" type="submit" value="Sign up" name="submit" class="btn btn-block btn-primary">
            </form>
            <span>Already have an account yet? <a style="text-decoration:none" href="signin">Sign In</a></span>
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
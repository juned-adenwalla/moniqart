<?php 

session_start();

// if(isset($_SESSION['isLoggedIn'])){
//   echo "<script>";
//   echo "window.location.href = 'index'";
//   echo "</script>";
// }

require('includes/_functions.php'); 
// require('includes/_alert.php'); 
if(isset($_POST['submit'])){
  $userotp = $_POST['otp'];
  _verifyotp($userotp);
}
// if(isset($_POST['otp'])){
//   if($_SESSION['otpsent'] > 3){
//     $alert = new PHPAlert();
//     $alert->warn("OTP resend limit exceeded");
//   }else{
//     _resendtop();
//     if(isset($_SESSION['otpsent'])){
//       $_SESSION['otpsent']++;
//     }else{
//       $_SESSION['otpsent'] = 1;
//     }
//   }
// }
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
            <p class="mb-4">Please enter the one-time password (OTP) sent to your registered phone number</p>
            <form action="#" method="post" style="margin-bottom:20px">
              <div class="form-group last mb-3">
                <label for="password">Verify Code (OTP)</label>
                <input type="password" name="otp" class="form-control" placeholder="One Time Password" id="password">
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <!-- <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label> -->
                <span>Code not Recieved?<button name="otp" style="cursor: pointer;float:right;margin-bottom: 20px; border: none; background-color:transparent" class="auth-link text-black">Resend OTP</button></span>
              </div>

              <input style="margin-top:30px" type="submit" value="Verify Code" name="submit" class="btn btn-block btn-primary">
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
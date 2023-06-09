<?php

session_start();

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

require('../includes/_functions.php');

$_id = $_GET['id'];


if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usertype = $_POST['usertype'];
    $userphone = $_POST['userphone'];

    if (isset($_POST['notify'])) {
        $notify = $_POST['notify'];
    } else {
        $notify = false;
    }
    if (isset($_POST['isactive'])) {
        $isactive = $_POST['isactive'];
    } else {
        $isactive = false;
    }
    if (isset($_POST['isverified'])) {
        $isverified = $_POST['isverified'];
    } else {
        $isverified = false;
    }

    _updateuser($username, $useremail, $usertype, $userphone, $isactive, $isverified, $_id);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit <?php echo _getsingleuser($_id, '_username'); ?> | <?php echo _siteconfig('_sitetitle'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit User Account</h4>
                                <p class="card-description">
                                    When you edit user account, you must assign access credentials, a user type, and a
                                    security password to the user. User type define what actions the user has permission
                                    to perform. Security password secures users permission to access. You can create
                                    multiple user accounts that include administrative right
                                </p>
                                <form method="POST" action="" class="needs-validation" novalidate>
                                    <div class="row g-3">
                                        <div class="col">
                                            <label for="username" class="form-label">User Name</label>
                                            <input type="text" value="<?php echo _getsingleuser($_id, '_username'); ?>"
                                                class="form-control" placeholder="User name" aria-label="user name"
                                                id="username" name="username" required>
                                            <div class="invalid-feedback">Please type correct username</div>
                                        </div>
                                        <div class="col">
                                            <label for="useremail" class="form-label">User Email</label>
                                            <input type="email"
                                                value="<?php echo _getsingleuser($_id, '_useremail'); ?>"
                                                class="form-control" placeholder="Email ID" aria-label="Email Id"
                                                name="useremail" required>
                                            <div class="invalid-feedback">Please type correct email</div>
                                        </div>
                                    </div>

                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col">
                                            <label for="usertype" class="form-label">Account Type</label>
                                            <select style="height: 46px;" name="usertype"
                                                class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                required>
                                                <?php
                                                $type = _getsingleuser($_id, '_usertype');
                                                echo $type;
                                                if ($type == 0) { ?><option value="0" selected>Student</option><?php }
                                                if ($type == 1) { ?><option value="1" selected>Teacher</option><?php }
                                                if ($type == 2) { ?><option value="2" selected>Site Admin</option><?php }
                                                if ($type != 0) { ?><option value="0">Student</option><?php }
                                                if ($type != 1) { ?><option value="1">Teacher</option><?php }
                                                if ($type != 2) { ?><option value="2">Site Admin</option><?php }
                                                                        ?>
                                            </select>
                                            <div class="invalid-feedback">Please select correct usertype</div>
                                        </div>
                                        <div class="col">
                                            <label for="userphone" class="form-label">User Phone</label>
                                            <input type="tel" value="<?php echo _getsingleuser($_id, '_userphone'); ?>"
                                                class="form-control" placeholder="Phone Number" aria-label="phone"
                                                name="userphone" pattern="[1-9]{1}[0-9]{9}" required>
                                            <div class="invalid-feedback">Please type correct Number</div>
                                        </div>
                                    </div>

                                    <div class="row g-3" style="margin-top: 20px;">


                                        <div class="col">
                                            <label for="userlocation" class="form-label">IP Location</label>
                                            <input type="text" class="form-control" placeholder="IP Location"
                                                aria-label="user location" id="userlocation" name="userlocation">
                                        </div>

                                        <!-- <div class="col">
                                            <label for="userwebsite" class="form-label"> User Website</label>
                                            <input type="text" value="<?php echo _getsingleuser($_id, '_usersite'); ?>" class="form-control" placeholder="User Website" aria-label="user website" name="userwebsite">
                                        </div> -->


                                    </div>



                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col" style="margin-top: 10px;">
                                            
                                            
                                            <div class="custom-control custom-switch">


                                                <?php

                                             $status = _getsingleuser($_id, '_userstatus');
                                             if($status==true){
                                                 ?>
                                                      <input type="checkbox" class="custom-control-input" name="isactive"
                                                        id="isactive" value="true" checked>
                                                    <label class="custom-control-label" style="margin-left: 20px;"
                                                        for="isactive">Is
                                                        Active</label>
                                                <?php
                                             }
                                             else{
                                                 ?>
                                                  <input type="checkbox" class="custom-control-input" name="isactive"
                                                        id="isactive" value="true">
                                                    <label class="custom-control-label" style="margin-left: 20px;"
                                                        for="isactive">Is
                                                        Active</label>
                                                <?php
                                             }
                                             ?>


                                            </div>
                                            
                                            
                                            <div class="custom-control custom-switch">


                                                <?php

                                             $status = _getsingleuser($_id, '_userverify');
                                             if($status==true){
                                                 ?>
                                                <input type="checkbox" class="custom-control-input" name="isverified"
                                                    id="isverified" checked>
                                                <label class="custom-control-label" style="margin-left: 20px;"
                                                    for="isverified">Is Verified</label>
                                                <?php
                                             }
                                             else{
                                                 ?>
                                                <input type="checkbox" class="custom-control-input" name="isverified"
                                                    id="isverified">
                                                <label class="custom-control-label" style="margin-left: 20px;"
                                                    for="isverified">Is Verified</label>
                                                <?php
                                             }
                                             ?>


                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-12" style="margin-top: 30px;">
                                        <button type="submit" name="submit" style="width: 150px;margin-left: -10px"
                                            class="btn btn-primary">Update Details</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        <script src="../includes/_validation.js"></script>

</body>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>
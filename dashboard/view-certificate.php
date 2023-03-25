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

$certificateId = $_GET['id'];


$courseId = _getSingleCertificate($certificateId, '_courseid');
$coursename = _getSingleCourse($courseId, '_coursename');

$userid = _getSingleCertificate($certificateId, '_userid');
$userName = _getsingleuser($userid, '_username');
$userEmail = _getsingleuser($userid, '_useremail');

$enrolledDate = _getParamFromMyCourse('_userid', $userid, 'CreationDate');

$markAsCompledted_date = _getSingleCertificate($certificateId, 'CreationDate');
$emailForCertificate = _getSingleCertificate($certificateId, '_emailid');




if (isset($_POST['statustype'])) {

    $status = $_POST['statustype'];
    _updateCertificateStatus($certificateId, $status);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>View Certificate </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <script src="../assets/plugins/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#mytextarea',
        statusbar: false,
        branding: false,
        promotion: false,
        height: 300,
    });
    </script>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<style>
.tox-tinymce {
    border: none;
    border-radius: 0px;
    box-shadow: none;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    overflow: hidden;
    position: relative;
    visibility: inherit !important;
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
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4 class="card-title">
                                            Certificate No : <?php echo $certificateId; ?>
                                        </h4>
                                    </div>
                                    <div class="col-lg-4">
                                        <form action="" method="post">
                                            <select style="height: 36px;" name="statustype"
                                                class="form-control form-control-lg" id="exampleFormControlSelect2"
                                                onchange="this.form.submit()" required>
                                                <?php

                                                // echo $certificateStatus;
                                                        $certificateStatus = _getSingleCertificate($certificateId, '_status');


                                                   


                                                if ($certificateStatus === 'onprogress')
                                                {
                                                    ?>
                                                <option value="onprogress" selected>On Progress</option>
                                                <option value="onhold">On Hold</option>
                                                <option value="credited">Credited</option>
                                                <?php
                                                }
                                                else if($certificateStatus === 'onhold'){
                                                    ?>
                                                <option value="onprogress">On Progress</option>
                                                <option value="onhold" selected>On Hold</option>
                                                <option value="credited">Credited</option>
                                                <?php
                                                }
                                                else if($certificateStatus === 'credited'){
                                                    ?>
                                                <option value="onprogress">On Progress</option>
                                                <option value="onhold">On Hold</option>
                                                <option value="credited" selected>Credited</option>
                                                <?php
                                                }
                                               
                                                

                                                ?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-user text-primary"></i>&nbsp;&nbsp;<span
                                            style="font-size: 14px">
                                            <?php echo $userName ?>
                                        </span>
                                    </div>

                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-envelope text-primary"></i>&nbsp;&nbsp;<span
                                            style="font-size: 14px"> <?php echo $userEmail ?></span>
                                    </div>


                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-graduation-cap text-primary"></i>&nbsp;&nbsp;<span
                                            style="font-size: 14px">
                                            <?php echo $coursename ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:20px;">


                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-calendar-days text-primary"></i>&nbsp;&nbsp;<span
                                            style="font-size: 14px"> Enrolled At :
                                            <?php echo date("M j, Y", strtotime($enrolledDate)) ?></span>
                                    </div>

                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-calendar-days text-primary"></i>&nbsp;&nbsp;
                                        <span style="font-size: 14px"> Completed At :
                                            <?php echo date("M j, Y", strtotime($markAsCompledted_date)) ?></span>
                                    </div>


                                    <div class="col-lg-4 d-flex flex-row align-items-center justify-content-start "
                                        style="margin-bottom: 5px;">
                                        <i style="font-size: 18px"
                                            class="fa-solid fa-envelope text-primary"></i>&nbsp;&nbsp;<span
                                            style="font-size: 14px"> Email Entered :
                                            <?php echo $emailForCertificate ?></span>
                                    </div>
                                </div>



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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
<script src="../assets/js/todolist.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>
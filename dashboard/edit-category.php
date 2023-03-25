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
    $categoryname = $_POST['categoryname'];
    $categoryDesc = $_POST['categoryDesc'];
    $_categorytype = $_POST['_categorytype'];




    if (isset($_POST['isactive'])) {
        $isactive = $_POST['isactive'];
    } else {
        $isactive = false;
    }
    _updateCategory($categoryname, $categoryDesc, $isactive, $_id, $_categorytype);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit <?php echo _getSingleCategory($_id, '_categoryname'); ?> | <?php echo _siteconfig('_sitetitle'); ?>
    </title>
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
                                <h4 class="card-title">Edit Parent (Edit Category)</h4>
                                <p class="card-description">
                                    Before you start writing about your new topic, it's important to do some research.
                                    This will help you to understand the topic better, This will make it easier for you
                                    to write about the topic, and it will also make it more likely that people will be
                                    interested in reading what you have to say.
                                </p>
                                <form method="POST" action="" class="needs-validation" novalidate>


                                    <div class="row g-3">
                                        <div class="col">
                                            <label for="categoryname" class="form-label">Category Name</label>
                                            <input type="text"
                                                value="<?php echo _getSingleCategory($_id, '_categoryname'); ?>"
                                                class="form-control" placeholder="Category name"
                                                aria-label="Category name" id="categoryname" name="categoryname"
                                                required>
                                            <div class="invalid-feedback">Please type correct category name</div>
                                        </div>

                                        <div class="col">
                                            <label for="categoryDesc" class="form-label">Category Description</label>
                                            <input type="text"
                                                value="<?php echo _getSingleCategory($_id, '_categoryDescription'); ?>"
                                                class="form-control" placeholder="Category Description"
                                                aria-label="Category Description" id="categoryDesc" name="categoryDesc"
                                                required>
                                            <div class="invalid-feedback">Please type correct category description</div>
                                        </div>
                                    </div>



                                    <div class="row g-3" style="margin-top: 15px;">

                                        <div class="col-lg-6" style="margin-bottom: 20px;">
                                            <label for="_categorytype" class="form-label">Select Type</label>
                                            <select style="height: 46px;" name="_categorytype"
                                                class="form-control form-control-lg" id="_categorytype" required>
                                                <option selected disabled value="">Type</option>

                                                <?php

                                                $categoryType = _getSingleCategory($_id, '_categorytype');

                                                if ($categoryType == 'blog') {
                                                    ?>

                                                    <option selected value="blog">Blog</option>
                                                    <option value="courses">Course</option>
                                                    <option value="product">Product</option>

                                                    <?php
                                                }
                                                else if($categoryType == 'courses'){
                                                    ?>

                                                    <option  value="blog">Blog</option>
                                                    <option selected value="courses">Course</option>
                                                    <option value="product">Product</option>

                                                    <?php
                                                }
                                                else{
                                                    ?>

                                                    <option  value="blog">Blog</option>
                                                    <option  value="courses">Course</option>
                                                    <option selected value="product">Product</option>

                                                    <?php
                                                }

                                                ?>




                                            </select>
                                            <div class="invalid-feedback">Please select categorytype</div>
                                        </div>

                                        <div class="col-6" style="margin-top: 40px;">

                                            <div class="custom-control custom-switch">


                                                <?php

                                                $status = _getSingleCategory($_id, '_status');
                                                if ($status == true) {
                                                    ?>
                                                    <input type="checkbox" class="custom-control-input" name="isactive"
                                                        id="isactive" value="true" checked>
                                                    <label class="custom-control-label" for="isactive">Is
                                                        Active</label>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <input type="checkbox" class="custom-control-input" name="isactive"
                                                        id="isactive" value="true" >
                                                    <label class="custom-control-label" style="margin-left: 20px;"
                                                        for="isactive"  >Is
                                                        Active</label>
                                                    <?php
                                                }
                                                ?>


                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-12" style="margin-top: 30px;">
                                        <button type="submit" name="submit" style="width: 180px;margin-left: -10px"
                                            class="btn btn-primary">Update Category</button>
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
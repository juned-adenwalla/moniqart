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

if (isset($_SESSION['forgot_success']) || !isset($_SESSION['forgot_success'])) {
    $_SESSION['forgot_success'] = false;
}

require('../includes/_functions.php');

if (isset($_POST['submit'])) {
    $subCategoryname = $_POST['subCategoryname'];
    $subCategoryDesc = $_POST['subCategoryDesc'];
    $categoryId = $_POST['categoryId'];




    if (isset($_POST['isactive'])) {
        $isactive = $_POST['isactive'];
    } else {
        $isactive = false;
    }

    _createSubCategory($subCategoryname, $categoryId, $subCategoryDesc, $isactive);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Sub-Category |
        <?php echo _siteconfig('_sitetitle'); ?>
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
                    <?php if ($_SESSION['forgot_success']) { ?>
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Sub-Category Created!</strong> New Sub-Category created successfully.
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Create Child (New Sub-Category)</h4>
                                <p class="card-description">
                                    Before you start writing about your new topic, it's important to do some research.
                                    This will help you to understand the topic better, This will make it easier for you
                                    to write about the topic, and it will also make it more likely that people will be
                                    interested in reading what you have to say.
                                </p>
                                <form method="POST" action="" class="needs-validation" novalidate>
                                    <div class="row g-3">
                                        <div class="col">
                                            <label for="subCategoryname" class="form-label">Sub Category Name</label>
                                            <input type="text" class="form-control" placeholder="Sub Category name"
                                                aria-label="SubCategory name" id="subCategoryname"
                                                name="subCategoryname" required>
                                            <div class="invalid-feedback">Please type correct sub-category name</div>
                                        </div>
                                        <div class="col">
                                            <label for="subCategoryDesc" class="form-label">Sub Category
                                                Description</label>
                                            <input type="text" class="form-control"
                                                placeholder="Sub Category Description"
                                                aria-label="SubCategory Description" id="subCategoryDesc"
                                                name="subCategoryDesc" required>
                                            <div class="invalid-feedback">Please type correct sub-category desc</div>
                                        </div>
                                    </div>

                                    <div class="row g-3" style="margin-top: 15px;">

                                        <div class="col">

                                            <?php _showCategoryOptions() ?>

                                            <!-- <label for="categoryId" class="form-label">Sub Category ID</label> -->
                                            <!-- <input type="text" class="form-control" placeholder="Sub Category ID" aria-label="SubCategoryID" id="categoryId" name="categoryId" required> -->
                                        </div>

                                        <div class="col" style="margin-top: 30px;">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="isactive"
                                                    id="isactive" value="true">
                                                <label class="custom-control-label" style="margin-left: 20px;"
                                                    for="isactive">Is
                                                    Active</label>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-12" style="margin-top: 30px;">
                                        <button type="submit" name="submit" style="width: 200px;margin-left: -10px"
                                            class="btn btn-primary">Create Sub-Category</button>
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

        <script>
            const getSubCategory = (val) => {
                $.ajax({
                    type: "POST",
                    url: "getSubCategory.php",
                    data: 'catid=' + val,
                    success: function (data) {
                        $(`#subcategoryId`).html(data);
                    }
                });
            }
        </script>
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
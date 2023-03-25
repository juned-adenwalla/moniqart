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
if (isset($_SESSION['product_success']) || !isset($_SESSION['product_success'])) {
    $_SESSION['product_success'] = false;
}
if (isset($_SESSION['product_error']) || !isset($_SESSION['product_error'])) {
    $_SESSION['product_error'] = false;
}


require('../includes/_functions.php');

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $discountprice = $_POST['discountprice'];
    $productDesc = $_POST['productDesc'];

    $categoryId = $_POST['categoryId'];
    $subcategoryId = $_POST['subcategoryId'];


    if (isset($_POST['isactive'])) {
        $isactive = $_POST['isactive'];
    } else {
        $isactive = false;
    }

    _createProduct($name, $sku, $price, $discountprice, $productDesc, $isactive,$categoryId,  $subcategoryId);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Product |
        <?php echo _siteconfig('_sitetitle'); ?>
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css htmlFor this page -->
    <script src="../assets/plugins/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            statusbar: false,
            branding: false,
            promotion: false,
        });
    </script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- End plugin css htmlFor this page -->
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

                            <?php

                            if ($_SESSION['product_success']) {
                                ?>
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Product Created!</strong> New Product created successfully.
                                    </div>
                                </div>
                                <?php
                            }

                            if ($_SESSION['product_error']) {
                                ?>
                                <div id="liveAlertPlaceholder">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Product Creatation Failed</strong>
                                    </div>
                                </div>
                                <?php
                            }

                            ?>

                            <div class="card-body">
                                <h4 class="card-title">Create Product</h4>
                                <p class="card-description">
                                    Before you start writing about your new topic, it's important to do some research.
                                    This will help you to understand the topic better, This will make it easier htmlFor
                                    you
                                    to write about the topic, and it will also make it more likely that people will be
                                    interested in reading what you have to say.
                                </p>
                                <form method="POST" action="" enctype="multipart/form-data" class="needs-validation"
                                    novalidate>

                                    <div class="row g-3">


                                        <div class="col-lg-6" style="margin-bottom: 20px;">
                                            <?php _showCategoryOptions("", "product") ?>

                                        </div>

                                        <div class="col-lg-6" style="margin-bottom: 20px;">
                                            <?php _showSubCategoryOptions() ?>
                                        </div>

                                    </div>


                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col-lg-6">
                                            <label htmlFor="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Product Name" required>
                                            <div class="invalid-feedback">Please type correct name</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label htmlFor="sku" class="form-label">SKU</label>
                                            <input type="number" class="form-control" name="sku" id="sku"
                                                placeholder="SKU" required>
                                            <div class="invalid-feedback">Please type correct sku</div>
                                        </div>
                                    </div>


                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col-lg-6">
                                            <label htmlFor="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price" id="price"
                                                placeholder="Price" required>
                                            <div class="invalid-feedback">Please type correct price</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label htmlFor="discountprice" class="form-label">Discount Price</label>
                                            <input type="number" class="form-control" name="discountprice"
                                                id="discountprice" placeholder="Discount Price" required>
                                            <div class="invalid-feedback">Please type correct discountprice</div>
                                        </div>
                                    </div>



                                    <div class="row g-3" style="margin-top: 10px;">

                                        <div class="col" style="margin-top: 40px;">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="isactive"
                                                    id="isactive" value="true" >
                                                <label class="custom-control-label" style="margin-left: 20px;"
                                                    for="isactive">Is
                                                    Active</label>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row" style="margin-top: 30px;">
                                        <div class="col">
                                            <label htmlFor="productDesc" class="form-label">Product Description</label>
                                            <textarea name="productDesc" id="mytextarea" style="width:100%"
                                                rows="10"></textarea>
                                            <div class="invalid-feedback">Please type correct product desc</div>
                                        </div>
                                    </div>

                                    <div class="col-12" style="margin-top: 30px;">
                                        <button type="submit" name="submit" style="width: 200px;margin-left: -10px"
                                            class="btn btn-primary">Create Product</button>

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
<!-- Plugin js htmlFor this page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
<!-- End plugin js htmlFor this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


</html>
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



$id = $_GET['id'];

require('../includes/_functions.php');
require('../includes/_config.php');

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

    _updateProduct($id, $name, $sku, $price, $discountprice, $productDesc, $isactive, $categoryId, $subcategoryId);
}

$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;



if (isset($_POST['addProductImage'])) {


    if ($_FILES["file"]["name"] != '') {
        $file = $_FILES["file"]["name"];
        $extension = substr($file, strlen($file) - 4, strlen($file));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $imgurl = md5($file) . $extension;
            move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/productimages/" . $imgurl);
        }
    }

    $itemcategory = 'product';

    _addImgInGallery($id, $itemcategory, $imgurl);

}


if (isset($_GET['del'])) {

    $itemid = $_GET['id'];
    $imgId = $_GET['imgId'];

    _deleteImgInGallery($imgId, $itemid);
}

if (isset($_POST['updateImgInGallery'])) {

    $imgId = $_POST['imgId'];

    if ($_FILES["file"]["name"] != '') {
        $file = $_FILES["file"]["name"];
        $extension = substr($file, strlen($file) - 4, strlen($file));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $imgurl = md5($file) . $extension;
            move_uploaded_file($_FILES["file"]["tmp_name"], "../uploads/productimages/" . $imgurl);
        }
    }


    _updateImgInGallery($imgId, $imgurl);

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
                                <h4 class="card-title">Update Product</h4>
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
                                            <?php
                                            $categoryId = _getSingleProduct($id, '_productcategory');
                                            _showCategoryOptions($categoryId, "product")
                                                ?>

                                        </div>

                                        <div class="col-lg-6" style="margin-bottom: 20px;">
                                            <?php
                                            $subcategoryId = _getSingleProduct($id, '_productsubcategory');
                                            _showSubCategoryOptions($subcategoryId)
                                                ?>
                                        </div>

                                    </div>


                                    <div class="row g-3">
                                        <div class="col-lg-6">
                                            <label htmlFor="name" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Product Name"
                                                value="<?php echo _getSingleProduct($id, '_name'); ?>" required>
                                            <div class="invalid-feedback">Please type correct name</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label htmlFor="sku" class="form-label">SKU</label>
                                            <input type="number" class="form-control" name="sku" id="sku"
                                                placeholder="SKU" value="<?php echo _getSingleProduct($id, '_sku'); ?>"
                                                required>
                                            <div class="invalid-feedback">Please type correct sku</div>
                                        </div>
                                    </div>


                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col-lg-6">
                                            <label htmlFor="price" class="form-label">Price</label>
                                            <input type="number" class="form-control" name="price" id="price"
                                                placeholder="Price"
                                                value="<?php echo _getSingleProduct($id, '_price'); ?>" required>
                                            <div class="invalid-feedback">Please type correct price</div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label htmlFor="discountprice" class="form-label">Discount Price</label>
                                            <input type="number" class="form-control" name="discountprice"
                                                id="discountprice" placeholder="Discount Price"
                                                value="<?php echo _getSingleProduct($id, '_discountprice'); ?>"
                                                required>
                                            <div class="invalid-feedback">Please type correct discountprice</div>
                                        </div>
                                    </div>



                                    <div class="col" style="margin-top: 40px;">
                                        <div class="custom-control custom-switch">


                                            <?php

                                            $status = _getSingleProduct($id, '_status');
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
                                                <label class="custom-control-label" for="isactive">Is
                                                    Active</label>
                                                <?php
                                            }
                                            ?>


                                        </div>
                                    </div>



                                    <div class="row" style="margin-top: 30px;">
                                        <div class="col">
                                            <label htmlFor="productDesc" class="form-label">Product Description</label>
                                            <textarea name="productDesc" id="mytextarea" style="width:100%"
                                                rows="10"><?php echo _getSingleProduct($id, '_desc'); ?></textarea>
                                            <div class="invalid-feedback">Please type correct product desc</div>
                                        </div>
                                    </div>

                                    <div class="col-12" style="margin-top: 30px;">
                                        <button type="submit" name="submit" style="width: 200px;margin-left: -10px"
                                            class="btn btn-primary">Update Product</button>

                                        <button type="button"
                                            class="btn btn-primary btn-sm font-weight-medium auth-form-btn"
                                            style="height:40px; float:right; " data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="white" style="width: 15px;"
                                                viewBox="0 0 448 512">
                                                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                                <path
                                                    d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                            </svg>&nbsp;&nbsp;Add Image
                                        </button>

                                    </div>

                                </form>
                            </div>

                            <div class="card-body" style="margin-top: 30px ;">
                                <h4 class="card-title">Manage Product Images </h4>
                                <p class="card-description">
                                    From here, you'll see a list of all the categories on your site. You can edit or
                                    delete them from here. You can also change the order of your categories by dragging
                                    and dropping them into the order you
                                </p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Item Id</th>
                                                        <th>Item Category</th>
                                                        <th>Img Url</th>
                                                        <th>Created at</th>
                                                        <th>Updated at</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: left;margin-left: 30px">
                                                    <?php
                                                    _getAllImgInGallery('product', $id, $start_from, $record_per_page);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="Page navigation example" style="margin-top: 10px;">
                                    <ul class="pagination">
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM `tblgallery` where `_itemcategory`='product' ");
                                        $total_records = mysqli_num_rows($query);
                                        $total_pages = ceil($total_records / $record_per_page);
                                        $start_loop = $page;
                                        $difference = $total_pages - $page;
                                        if ($difference <= 4) {
                                            $start_loop = $total_pages - 4;
                                        }
                                        $end_loop = $start_loop + 3;
                                        if ($page > 1) {
                                            echo "<li class='page-item'>
                        <a href='edit-product?id=$id&page=" . ($page - 1) . "' class='page-link'>Previous</a>
                      </li>";
                                        }
                                        if ($total_records > 5) {

                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                echo "
                      <li class='page-item'><a class='page-link' href='edit-product?id=$id&page=" . $i . "'>$i</a></li>";
                                            }
                                        }
                                        if ($page <= $end_loop) {
                                            echo "<li class='page-item'>
                        <a class='page-link' href='edit-product?id=$id&page=" . ($page + 1) . "'>Next</a>
                      </li>";
                                        } ?>
                                    </ul>
                                </nav>
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

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-content" style="padding: 10px;">
                        <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add Product Image</h4>
                            <button type="button" class="btn-close" style="border: none;;background-color:white"
                                data-bs-dismiss="modal" aria-label="Close"><svg style="width: 15px;"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                    <path
                                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
                                </svg></button>
                        </div>
                        <div class="modal-body" style="padding: 0px;">

                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="inputEmail4" class="form-label">Product Image</label>
                                    <input type="file" name="file" class="form-control">
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="addProductImage" class="btn btn-primary"><i
                                    class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editGalleryImg" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" id="editGalleryImgBody">

            </div>
        </div>


        <script src="../includes/_validation.js"></script>

        <script>

            const callUpdateImgInGallery = (imgid) => {

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

                $.ajax({
                    type: "POST",
                    url: `edit-galleryimg.php`,
                    data: {
                        "edit": true,
                        "imgId": imgid,
                    },
                    success: function (data) {
                        $(`#editGalleryImgBody`).html(data);
                        $(`#editGalleryImg`).modal("show");
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
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
require('../includes/_config.php');

if (isset($_GET['del'])) {
    $_id = $_GET['id'];
    _deleteShippingMarkup($_id);
}

$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;

if (isset($_POST['submit'])) {


    $countryId = $_POST['countryId'];
    $stateId = $_POST['stateId'];
    $feeType = $_POST['feeType'];
    $price = $_POST['price'];


    if (isset($_POST['status'])) {
        $status = 'true';
    } else {
        $status = false;
    }

    _addShippingMarkup($countryId, $stateId, $feeType, $price, $status);

}


if (isset($_POST['updateShipping'])) {


    $shippingId = $_POST['shippingId'];
    $countryId = $_POST['countryId'];
    $stateId = $_POST['stateId'];
    $feeType = $_POST['feeType'];
    $price = $_POST['price'];

    if (isset($_POST['isactive'])) {
        $status = 'true';
    } else {
        $status = false;
    }

    _updateShippingMarkup($shippingId,$countryId, $stateId, $feeType, $price, $status);

}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shipping Markup |
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
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Shipping Markup</h4>
                                <p class="card-description">
                                    Web Help Desk uses tickets to manage service requests. These tickets can be
                                    initiated through email,
                                    created in the application, and imported from another application. Techs, admins,
                                    and clients can also
                                    manage tickets through email or through the application in a web browser.
                                </p>
                                <form method="POST" action="">
                                    <div class="row">



                                        
                                        <div class="col-lg-2" style="margin-bottom: 20px;">
                                            <button type="button"
                                                class="btn btn-primary btn-sm font-weight-medium auth-form-btn"
                                                style="height:40px" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="white"
                                                    style="width: 15px;" viewBox="0 0 448 512">
                                                    <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                                    <path
                                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                                </svg>&nbsp;&nbsp;Add Markup
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="display table expandable-table"
                                                style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Country Name</th>
                                                        <th>State Name</th>
                                                        <th>Fee Type</th>
                                                        <th>Price</th>
                                                        <th>Status</th>
                                                        <th>Created at</th>
                                                        <th>Action</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: left;margin-left: 30px">
                                                    <?php
                                                    if (isset($_POST['search'])) {
                                                        if (isset($_POST['conversion'])) {
                                                            $conversion = $_POST['conversion'];
                                                        } else {
                                                            $conversion = null;
                                                        }
                                                        $status = $_POST['statustype'];
                                                        _getmarkup($conversion, $status);
                                                    }
                                                    if (!isset($_POST['search'])) {
                                                        _getAllShippingMarkup($start_from, $record_per_page);
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="Page navigation example" style="margin-top: 30px;">
                                    <ul class="pagination">
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM `tblshipping`");
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
                        <a href='manage-shipping?page=" . ($page - 1) . "' class='page-link'>Previous</a>
                      </li>";
                                        }
                                        if ($total_records > 5) {
                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                echo "
                      <li class='page-item'><a class='page-link' href='manage-shipping?page=" . $i . "'>$i</a></li>";
                                            }
                                        }
                                        if ($page <= $end_loop) {
                                            echo "<li class='page-item'>
                        <a class='page-link' href='manage-shipping?page=" . ($page + 1) . "'>Next</a>
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



        <!-- Modal -->

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-content" style="padding: 10px;">
                        <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Add Markup </h4>
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

                                <div class="col-lg-6">
                                    <label for="countryId" class="form-label">Select Country</label>
                                    <select style="height: 46px;" onchange="getStates(this.options[this.selectedIndex].value,'add')" name="countryId" class="form-control form-control-lg"
                                        id="countryId" required>
                                        <option selected disabled value="">Select</option>

                                        <?php

                                        $sql = "SELECT * FROM `tblcountry` where `_status`='true' ";

                                        $query = mysqli_query($conn, $sql);

                                        if ($query) {

                                            foreach ($query as $data) {
                                                ?>
                                        <option value="<?php echo $data['_id'] ?>">
                                            <?php echo $data['_countryname'] ?>
                                        </option>
                                        <?php
                                            }

                                        }


                                        ?>

                                    </select>
                                    <div class="invalid-feedback">Please select proper country</div>
                                </div>

                                <div class="col-lg-6">
                                    <label for="stateId" class="form-label">Select State</label>
                                    <select style="height: 46px;" name="stateId" class="form-control form-control-lg"
                                        id="stateIdAdd" required>

                                    </select>
                                    <div class="invalid-feedback">Please select proper country</div>
                                </div>


                            </div>

                            <div class="row" style="margin-top: 20px;">

                                <div class="col-lg-6">
                                    <label for="feeType" class="form-label">Fee Type</label>
                                    <select style="height: 46px;" name="feeType" class="form-control form-control-lg"
                                        id="feeType" required>
                                        <option value="percentage">Percentage (%) </option>
                                        <option value="fixed">Fixed</option>

                                    </select>
                                    <div class="invalid-feedback">Please select proper country</div>
                                </div>


                                <div class="col-lg-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" placeholder="Price">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-lg-6" style="margin-top:20px;">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="status" id="status">
                                        <label class="custom-control-label" for="status">Is
                                            Active</label>
                                    </div>
                                </div>

                            </div>



                        </div>
                        <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary"><i
                                    class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editShipping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" id="editShippingBody">

            </div>
        </div>

        <div class="container"></div>

        <script>
            
        const getStates = (id,action)=>{


            $.ajax({
                type: "POST",
                url: `getState.php`,
                data: {
                    "edit": true,
                    "countryId": id,
                },
                success: function(data) {


                    if(action=="add"){
                        $(`#stateIdAdd`).html(data);
                    }
                    else{
                        $(`#stateIdUpdate`).html(data);
                    }

                }
            });

        }


        const callEditShippingMarkup = (id) => {


            $.ajax({
                type: "POST",
                url: `edit-shippingmarkup.php`,
                data: {
                    "edit": true,
                    "shippingid": id,
                },
                success: function(data) {
                    $(`#editShippingBody`).html(data);
                    $(`#editShipping`).modal("show");
                }
            });

        }

        </script>
        <script src="../includes/_validation.js"></script>

</body>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>
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
  _deletetax($_id);
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
  $name = $_POST['name'];
  $type = $_POST['type'];
  $amount = $_POST['amount'];
  if (isset($_POST['status'])) {
    $status = 'true';
  } else {
    $status = false;
  }
  _createtaxmarkup($name, $type,  $amount, $status);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Tax Markup |
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
                <h4 class="card-title">Manage Fees (Fee Markup)</h4>
                <p class="card-description">
                  Web Help Desk uses tickets to manage service requests. These tickets can be initiated through email,
                  created in the application, and imported from another application. Techs, admins, and clients can also
                  manage tickets through email or through the application in a web browser.
                </p>
                <form method="POST" action="">
                  <div class="row">
                    <?php if ($_SESSION['userType'] == 2) { ?>
                      <div class="col-lg-3" style="margin-bottom: 20px;">
                        <input type="text" placeholder="Tax Name" name="name" class="form-control">
                      </div>
                    <?php } ?>
                    <div class="col-lg-3" style="margin-bottom: 20px;">
                      <select style="height: 40px;" name="statustype" class="form-control form-control-sm"
                        id="exampleFormControlSelect2">
                        <option>Status Type</option>
                        <option value="true">Active</option>
                        <option value=" ">Inactive</option>
                      </select>
                    </div>
                    <div class="col-lg-2" style="margin-bottom: 20px;">
                      <button name="search" class="btn btn-block btn-primary btn-sm font-weight-medium auth-form-btn"
                        style="height:40px" name="submit"><i class="mdi mdi-account-search"></i>&nbsp;SEARCH</button>
                    </div>
                    <div class="col-lg-2" style="margin-bottom: 20px;">
                      <button type="button" class="btn btn-primary btn-sm font-weight-medium auth-form-btn"
                        style="height:40px" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" style="width: 15px;" viewBox="0 0 448 512">
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
                      <table id="example" class="display table expandable-table" style="width:100%">
                        <thead>
                          <tr>
                            <th>Fee Name</th>
                            <th>Fee Type</th>
                            <th>Fee Amount</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody style="text-align: left;margin-left: 30px">
                          <?php
                          if (isset($_POST['search'])) {
                            if (isset($_POST['conversion'])) {
                              $name = $_POST['name'];
                            } else {
                              $name = null;
                            }
                            $status = $_POST['statustype'];
                            _gettaxmarkup($name, $status);
                          }
                          if (!isset($_POST['search'])) {
                            _gettaxmarkup('', '', $record_per_page, $start_from);
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
                    $query = mysqli_query($conn, "SELECT * FROM `tbltaxes`");
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
                        <a href='manage-tax?page=" . ($page - 1) . "' class='page-link'>Previous</a>
                      </li>";
                    }
                    if ($total_records > 5) {
                      for ($i = 1; $i <= $total_pages; $i++) {
                        echo "
                      <li class='page-item'><a class='page-link' href='manage-tax?page=" . $i . "'>$i</a></li>";
                      }
                    }
                    if ($page <= $end_loop) {
                      echo "<li class='page-item'>
                        <a class='page-link' href='manage-tax?page=" . ($page + 1) . "'>Next</a>
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
</body>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="" method="post">
      <div class="modal-content" style="padding: 10px;">
        <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
          <h4 class="modal-title fs-5" id="exampleModalLabel">Add Markup (Custom Fee)</h4>
          <button type="button" class="btn-close" style="border: none;;background-color:white" data-bs-dismiss="modal"
            aria-label="Close"><svg style="width: 15px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
              <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
              <path
                d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
            </svg></button>
        </div>
        <div class="modal-body" style="padding: 0px;">
          <div class="row">

            <div class="col-lg-6">
              <label for="inputEmail4" class="form-label">Fee Name</label>
              <input type="text" name="name" class="form-control" placeholder="Tax Name">
            </div>

            <div class="col-lg-6">
              <label for="inputEmail4" class="form-label">Fee Type</label>
              <select name="type" class="form-control">
                <option value="Variable">Percentage</option>
                <option value="Fixed">Fixed</option>
              </select>
            </div>

          </div>
          <div class="row" style="margin-top: 20px;">
            <div class="col-lg-6">
              <label for="inputEmail4" class="form-label">Fee Amount</label>
              <input type="text" class="form-control" name="amount" placeholder="Tax Amount">
            </div>
            <div class="col-lg-6" style="margin-top:30px;">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="status" id="status">
                <label class="custom-control-label" style="margin-left: 20px;" for="status">Is
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
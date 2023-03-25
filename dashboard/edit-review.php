<?php

require("../includes/_config.php");
require('../includes/_functions.php');


if (isset($_POST['edit'])) {

    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE `tblreviews` SET `_status`='$status'  where `_id`='$id'  ";

    $query = mysqli_query($conn,$sql);

}





?>
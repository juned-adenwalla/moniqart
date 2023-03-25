<?php

require("../includes/_config.php");
require('../includes/_functions.php');


if (isset($_POST['edit'])) {

    $id = $_POST['countryId'];

    $query = mysqli_query($conn, "SELECT * FROM `tblstates` WHERE `_countryid`='$id' ");
    ?>
    <option value="">Select State</option>
    <?php
    while ($row = mysqli_fetch_array($query)) {
        ?>
        <option value="<?php echo $row['_id']; ?>">
            <?php echo $row['_statename']; ?>
        </option>
    <?php
    }



}





?>
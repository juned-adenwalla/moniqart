<?php

require("../includes/_config.php");
require('../includes/_clientfunctions.php');


if (isset($_POST['edit'])) {

    $lessonid = $_POST['lessonid'];
    $courseid = $_POST['courseid'];
    
    $sql = "SELECT * FROM `tbllessons` WHERE `_id`='$lessonid' and `_courseid`=$courseid ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {

            echo $data['_lessontype'];
            echo "--";
            echo $data['_lessonurl'];
            echo "--";
            $lessonDate = $data['_lessondate'];
            echo date('D d-M-Y', strtotime($lessonDate));
            echo "--";
            $lessonTime = $data['_lessontime'];
            echo date('h:i a', strtotime($lessonTime));
            echo "--";
            echo $data['_recordedfilename'];
            echo "--";
            echo strip_tags($data['_lessondescription']);
            echo "--";
            echo $data['_lessonname'];
        }
    }

    $sql2 = "SELECT * FROM `tblattachements` WHERE `_lessonid`='$lessonid' ";
    $query2 = mysqli_query($conn, $sql2);

    if ($query2) {

        $count = mysqli_num_rows($query2);

        if ($count >= 1) {
            while ($data = mysqli_fetch_array($query2)) {
                echo "--";
                echo $data['_attachementurl'];
            }
        } else {
            echo "--";
            echo "No Attachment";
        }


    }


}





?>
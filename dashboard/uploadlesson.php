<?php


require('../includes/_functions.php');

if (isset($_POST['submit'])) {

    $_lessonname = $_POST['lessonname'];
    $_courseid = $_POST['courseid'];
    $_lessondescription = $_POST['lessonDescription'];
    $_availablity = $_POST['availablity'];

    $lessontype = $_POST['lessontype'];




    if (isset($_POST['isactive'])) {
        $isactive = $_POST['isactive'];
    } else {
        $isactive = false;
    }

    if ($_FILES["lessonfile"]["name"] != '') {
        $lessonfile = $_FILES["lessonfile"]["name"];
        $extension = substr($lessonfile, strlen($lessonfile) - 4, strlen($lessonfile));
        $allowed_extensions = array(".mp4", ".mkv", ".webm", ".avi");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only mp4 / mkv/ webm /avi format allowed');</script>";
        } else {
            $lessonurl = '';
            $lessondate = '';
            $lessontime = '';
            $recorderfile = md5($lessonfile) . $extension;
            move_uploaded_file($_FILES["lessonfile"]["tmp_name"], "../uploads/recordedlesson/" . $recorderfile);
        }
    } else {
        $recorderfile = '';
        $lessonurl = $_POST['lessonurl'];
        $lessondate = $_POST['lessondate'];
        $lessontime = $_POST['lessontime'];
    }



    _createLesson($_courseid, $_lessonname, $lessontype, $lessonurl, $lessondate, $lessontime, $recorderfile, $_lessondescription, $isactive, $_availablity);
}

?>
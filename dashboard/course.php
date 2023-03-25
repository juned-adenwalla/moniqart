<?php

session_start();
require('../includes/_functions.php');

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
if (!isset($_GET['course']) && $_GET['course'] == '') {
    header('location:index.php');
}

$course = $_GET['lesson'];

$courseId = _getSingleCourseByPermalink($course, '_id');

if (!isset($_GET['lesson'])) {
    echo "<script>";
    echo "window.location.href = 'dashboard'";
    echo "</script>";
}

if(isset($_POST['submitEmail'])){

    $userid = $_SESSION['userId'];
    $emailId = $_POST['certificateEmail'];

    _addToCertificates($userid , $courseId , $emailId);

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard | <?php echo _siteconfig('_sitetitle'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/feather/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/ti-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Animation Library -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>



    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vertical-layout-light/style.css'); ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>


    <style>
    .line-clamp {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp#lessonAccordionName {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .accordion {
        --bs-accordion-active-bg: none;
        --bs-accordion-color: none;
        --bs-accordion-border-color: none;
        --bs-accordion-btn-focus-border-color: none;
        --bs-accordion-btn-focus-box-shadow: none;
    }

    .accordion-button::after {
        /* color: black; */
    }
    </style>

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

                        <div class="container">

                            <div class="row">

                                <div class="col-lg-8">

                                    <div class="card" id="lessonIsRecorded" style=" display: none;">
                                        <video id="lessonVideo" controls></video>

                                        <div class="card-body">
                                            <h5 class="card-title" id="lessonTitle1">Video title</h5>
                                            <div class="card-text" id="lessonDesc1">Video Description</div>
                                        </div>
                                        <div class="card-footer">

                                        </div>

                                        <ul class="list-group" id="attachmentsListVideo">

                                        </ul>

                                    </div>

                                    <div class="card" id="lessonIsLive" style=" display: none;">

                                        <div class="card-body">
                                            <a href="#" class="btn btn-primary mt-2" id="lessonliveUrl"> Link </a>
                                            <lottie-player
                                                src="https://assets1.lottiefiles.com/private_files/lf30_aw8vk8lt.json"
                                                background="transparent" speed="1" style="height: 200px;"
                                                loop  autoplay></lottie-player>
                                            <h5 class="card-title text-center">Class Starts at</h5>
                                            <p class="card-text text-center" id="lessonLiveDate">Time and Date</p>
                                        </div>

                                        <div class="card-body">
                                            <h5 class="card-title" id="lessonTitle2">Video title</h5>
                                            <div class="card-text" id="lessonDesc2">Video Description</div>
                                        </div>
                                        <div class="card-footer">

                                        </div>
                                        <ul class="list-group" id="attachmentsListUrl">

                                        </ul>

                                    </div>


                                </div>

                                <div class="col-lg-4 d-flex flex-column justify-content-between">

                                    <div class="card ">

                                        <div class="card-header bg-primary">
                                            <span class="text-light text-center" style="font-weight:900;"> <i
                                                    class="fa-regular fa-square-caret-down"></i>&nbsp;&nbsp;Course
                                                Playlist </span>
                                        </div>

                                        <div class="accordion accordion-flush" id="accordionExample">
                                            <?php
                                            _getLessonForAccordion($courseId);
                                            ?>
                                        </div>

                                    </div>

                                    <div class="card">
                                        <button class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#marksAsCompletedModal">
                                            <i class="fa-solid fa-check" style="margin-right:5px;font-size:13px;"></i>
                                            Mark as Completed
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    </form>
                    <?php include('templates/_footer.php'); ?>
                </div>
                <!-- main-panel ends -->
            </div>

            <!-- page-body-wrapper ends -->
        </div>


        <div class="container"></div>

        <div class="modal fade" id="marksAsCompletedModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="modal-content" style="padding: 10px;">
                        <div class="modal-header" style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
                            <h4 class="modal-title fs-5" id="exampleModalLabel">Mark as Completed</h4>
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
                                    <input type="text" class="form-control" name="certificateEmail" placeholder="Email"
                                        required>
                                </div>
                                <div class="col-lg-12" style="margin-top:10px; margin-left:5px; ">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" required>
                                            I agree that my certificate will be sent to this email id
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submitEmail" class="btn btn-primary"><i
                                    class="fa-solid fa-check"></i>&nbsp;&nbsp;Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <script>
        const allLesson = document.querySelectorAll(".lessonAccordion");


        const lessonLiveDate = document.getElementById('lessonLiveDate');

        const lessonliveUrl = document.getElementById('lessonliveUrl');

        const lessonIsRecorded = document.getElementById('lessonIsRecorded');
        const lessonIsLive = document.getElementById('lessonIsLive');


        const lessonVideo = document.getElementById('lessonVideo');

        const lessonTitle1 = document.getElementById('lessonTitle1');
        const lessonDesc1 = document.getElementById('lessonDesc1');

        const lessonTitle2 = document.getElementById('lessonTitle2');
        const lessonDesc2 = document.getElementById('lessonDesc2');




        const callSetLessonUrl = (date, url, name, desc, lessonid) => {

            lessonIsRecorded.style.display = 'none';
            lessonIsLive.style.display = 'flex';

            lessonLiveDate.innerText = date;
            lessonliveUrl.href = url;

            lessonTitle2.innerText = name;
            lessonDesc2.innerText = desc.replace("<p>", '').replace("</p>", '');

            getAttachmentsUrl(lessonid);

        }

        const callSetLessonVideo = (videoUrl, name, desc, lessonid) => {

            lessonIsRecorded.style.display = 'flex';
            lessonIsLive.style.display = 'none';

            let dirUrl = '../../uploads/recordedlesson'

            lessonVideo.src = `${dirUrl}/${videoUrl}`

            lessonTitle1.innerText = name;
            lessonDesc1.innerText = desc.replace("<p>", '').replace("</p>", '');

            getAttachmentsVideo(lessonid);

        }



        const getAttachmentsUrl = (lessonid) => {

            $.ajax({
                type: "POST",
                url: `../getAttachmentsForLesson.php`,
                data: {
                    "get": true,
                    "lessonid": lessonid,
                },
                success: function(data) {
                    $(`#attachmentsListUrl`).html(data);
                }
            });


        }

        const getAttachmentsVideo = (lessonid) => {

            $.ajax({
                type: "POST",
                url: `../getAttachmentsForLesson.php`,
                data: {
                    "get": true,
                    "lessonid": lessonid,
                },
                success: function(data) {
                    $(`#attachmentsListVideo`).html(data);
                }
            });


        }


        const lessonAccordion1 = document.getElementById('lessonAccordion1');

        const lessonAccordion1Type = lessonAccordion1.querySelector('#lessonAccordionType');


        if (lessonAccordion1Type.textContent.trim() == 'Live') {


            const lessonAccordion1Date = lessonAccordion1.querySelector("#lessonAccordionDate");
            const lessonAccordion1Url = lessonAccordion1.querySelector("#lessonAccordionUrl");
            const lessonAccordion1Id = lessonAccordion1.querySelector("#lessonAccordionId");

            const lessonAccordion1Name = lessonAccordion1.querySelector("#lessonAccordionNameComplete");
            const lessonAccordion1Desc = lessonAccordion1.querySelector("#lessonAccordionDesc");

            lessonIsRecorded.style.display = 'none';
            lessonIsLive.style.display = 'flex';

            lessonLiveDate.textContent = lessonAccordion1Date.textContent;
            lessonliveUrl.href = lessonAccordion1Url.textContent.trim();

            lessonTitle2.innerText = lessonAccordion1Name.textContent.trim();
            lessonDesc2.innerText = lessonAccordion1Desc.textContent.trim().replace("<p>", '').replace("</p>", '');

            getAttachmentsUrl(lessonAccordion1Id.textContent.trim());


        } else {

            const lessonAccordion1Video = lessonAccordion1.querySelector("#lessonAccordionVideo");
            const lessonAccordion1Id = lessonAccordion1.querySelector("#lessonAccordionId");
            const lessonAccordion1Name = lessonAccordion1.querySelector("#lessonAccordionNameComplete");
            const lessonAccordion1Desc = lessonAccordion1.querySelector("#lessonAccordionDesc");

            lessonIsRecorded.style.display = 'flex';
            lessonIsLive.style.display = 'none';

            let dirUrl = '../../uploads/recordedlesson'

            lessonVideo.src = `${dirUrl}/${lessonAccordion1Video.textContent.trim()}`


            lessonTitle1.innerText = lessonAccordion1Name.textContent.trim();
            lessonDesc1.innerText = lessonAccordion1Desc.textContent.trim().replace("<p>", '').replace("</p>", '');


            getAttachmentsVideo(lessonAccordion1Id.textContent.trim());
        }
        </script>

</body>
<script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js'); ?>"></script>

<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?php echo base_url('assets/js/off-canvas.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/hoverable-collapse.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/template.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/settings.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/todolist.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>

</html>
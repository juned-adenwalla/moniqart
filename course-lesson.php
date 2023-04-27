<?php include('templates/_header.php'); ?>

<?php

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    echo "<script>";
    echo "window.location.href = 'signin'";
    echo "</script>";
} else {
}

// $course = 'the-complete-2023-web-development-bootcamp';

// $courseId = _getSingleCourseByPermalink($course, '_id');


$courseId = $_GET['id'];

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&family=Balsamiq+Sans&fa
        mily=Comfortaa&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/frontend/css/style.css?v=<?php echo time(); ?>">

    <!-- Video Js -->
    <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />

    <!-- Jquery -->

    <!-- Animation Libray -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>



    <title>Lessons Page</title>



</head>

<body>



    <section class="container my-5">

        <div class="row p-0 my-5">
            <div class="col-lg-8  col-12 px-lg-5  px-3 m-lg-0 mt-3">



                <div id="lesssonTimeAndDate" style="display: none;">
                    <p class="text-dark fs-4">Lesson will start at : <span id="lessondate"></span> </p>
                    <p class="text-dark fs-4">and at this time <span id="lessontime"></span> </p>
                    <a class="btn btn-success" target="_blank" style="display: none;" id="joinBtn">Join Now</a>
                </div>


                <video id="lessonVideo" style="display: none;" src="" width="100%" controls>

                </video>



            </div>

            <div class="col-lg-4 col-12  px-lg-5  px-3 m-lg-0 mt-5 "
                style="max-height: 500px; overflow-y: scroll;scrollbar-width: thin;">


                <div class="lessonPlansPc">
                    <?php
                    _getLessonPlansForCourse($courseId);
                    ?>
                </div>

                <div class="d-lg-none d-block  accordion px-lg-5 px-2" id="accordionExample">
                    <div class="accordion rounded my-3 border -item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Lesson Plans
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body p-0">
                                <?php
                                _getLessonPlansForCourse($courseId);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="row p-0 m-0 mt-3">
            <div class="bg-white shadow rounded-lg d-flex flex-column ">
                <div class="profile-tab-nav border-right">
                    <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="tab_1-tab" data-toggle="pill" href="#tab_1" role="tab"
                            aria-controls="tab_1" aria-selected="true">
                            <i class="fa-solid fa-circle-info"></i>
                            Overview
                        </a>
                        <a class="nav-link" id="tab_2-tab" data-toggle="pill" href="#tab_2" role="tab"
                            aria-controls="tab_2" aria-selected="false">
                            <i class="fa-solid fa-download"></i>
                            Downloads
                        </a>
                    </div>
                </div>
                <div class="tab-content py-4 px-0 " id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1-tab">
                        <h3 class="mb-4" id="lessonName"></h3>
                        <p class="fs-6 text-dark " id="lessonDescription">
                        </p>

                    </div>

                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2-tab">
                        <h3 class="mb-4">Attachments</h3>



                    </div>

                </div>
            </div>

        </div>


    </section>




    <?php include('templates/_footer.php'); ?>

    <!-- Jquery -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


    <script>


        const callGetLesson = (lessonid) => {


            $.ajax({
                type: "POST",
                url: `./xtra/getLesson.php`,
                data: {
                    "edit": true,
                    "lessonid": lessonid,
                    "courseid": <?php echo $courseId ?>,
                },
                success: function (data) {
                    // $(`#editAttachmentBody`).html(data);

                    let videoEle = document.getElementById("lessonVideo");
                    let lessonNameEle = document.getElementById("lessonName");
                    let lessonDescEle = document.getElementById("lessonDescription");

                    let attachEle = document.getElementById("tab_2");

                    let lesssonTimeAndDateEle = document.getElementById("lesssonTimeAndDate");
                    let lessondateEle = document.getElementById("lessondate");
                    let lessontimeEle = document.getElementById("lessontime");
                    let joinBtnEle = document.getElementById("joinBtn");

                    let splitData = data.split("--")

                    let lessonType = splitData[0];
                    let url = splitData[1];
                    let date = splitData[2];
                    let time = splitData[3];
                    let dateAndTime = `${date} ${time}`;
                    let videoFile = splitData[4];
                    let description = splitData[5];
                    let name = splitData[6];

                    if (lessonType == 'Recorded') {
                        lesssonTimeAndDateEle.style.display = "none"
                        videoEle.style.display = "block"
                        videoEle.src = `uploads/recordedlesson/${videoFile}`
                    }
                    else if (lessonType == 'Live') {
                        videoEle.style.display = "none"
                        lesssonTimeAndDateEle.style.display = "block"
                        lessondateEle.innerText = date
                        lessontimeEle.innerText = time

                        let d1 = new Date(dateAndTime);
                        const d2 = new Date();
                        var dat = d2.getFullYear() + '-' + (d2.getMonth() + 1) + '-' + d2.getDate();
                        let t = d2.getHours() + ":" + d2.getMinutes();

                        // console.log(d1 - d2);



                        if ((d1 - d2) < 1800000) {
                            joinBtnEle.style.display = "inline"
                            joinBtnEle.href = url
                        }
                        else {
                            joinBtnEle.style.display = "none"
                            joinBtnEle.href = "none"
                        }

                    }

                    lessonNameEle.innerHTML = name;
                    lessonDescEle.innerHTML = description;

                    if (splitData[7] == 'No Attachment') {

                        attachEle.innerHTML = ""

                        let ele = document.createElement("p");

                        ele.innerHTML = "No Attachment found"

                        attachEle.append(ele)


                    }
                    else {
                        attachEle.innerHTML = ""

                        let index = 1;


                        for (let i = 7; i < splitData.length; i++) {


                            // let count = 0;

                            let ele = document.createElement("p");


                            ele.innerHTML = `
    Attachment ${index}
        <a href="${splitData[7]}" target="_black" download class="fs-5 ms-2 "><i class="fa-solid fa-download"></i></a>`

                            attachEle.append(ele)

                            index++;




                        }
                    }



                }
            });

        }

        let allLessons = document.querySelectorAll(".lessonCard");

        allLessons.forEach((ele) => {
            ele.addEventListener("click", () => {

                let eldId = ele.id;

                let id = eldId.split("-")


                // console.log(id);

                callGetLesson(id[1])






            })
        })

        callGetLesson(00000000000000000001);

    </script>


</body>

</html>
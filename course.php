<?php



$id = $_GET['id'];

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

    <title>Course Page</title>



</head>

<body>

    <?php include('templates/_header.php'); ?>

    <section style="--img:url(<?php $img = _getSingleCourse($id, '_banner');
    echo base_url("uploads/coursebanner/$img")
        ?>);" class="hero_container">

        <div class="container w-100 h-100 d-flex flex-column align-items-center justify-content-end">

            <h2 class="text-white display-4 text-center">
                <?php
                echo strip_tags(_getSingleCourse($id, '_coursename'));
                ?>
            </h2>

            <p style="--i:3;" class="line-clamp fst-italic mt-3 fs-6 text-center w-75 text-white">
                <?php
                $text = strip_tags(_getSingleCourse($id, '_coursedescription'));
                echo substr($text, 0, 200);
                ?>
            </p>

            <div class="row w-100" style="background: rgba(0, 0, 0, 0.2);">
                <div
                    class="col-lg-4 col-md-4 col-6   py-lg-5 py-md-3 py-3      d-flex align-items-center justify-content-center ">
                    <a href="checkout?id=<?php echo $id ?>"
                        class="text-white fs-3 text-decoration-none lightHoverEffect ">Apply Now <span>(<?php  
                                                                                                    $price = _getSingleCourse($id,'_pricing');
                                                                                                    $currency = $_SESSION['baseCurrency'];
                                                                                                    $convertedPrice = _conversion($price,$currency);
                                                                                                    $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
                                                                                                    $updateCurrency = $fmt->formatCurrency($convertedPrice, $currency);
                                                                                                    echo $updateCurrency;
                                                                                                     ?>)</span> </a>
                </div>
                <div
                    class="col-lg-4 col-md-4 col-6   py-lg-5 py-md-3 py-3      d-flex align-items-center justify-content-center ">
                    <a href="#lessonplans" class="text-white fs-3 text-decoration-none lightHoverEffect ">View
                        Syllabus</a>
                </div>

                <div
                    class="col-lg-4 col-md-4 col-12  py-lg-5 py-md-3 py-3      d-flex align-items-center justify-content-center ">

                    <i class="fa-solid fa-play text-white fs-1 lightHoverEffect" style="cursor: pointer;"
                        data-bs-toggle="modal" data-bs-target="#exampleModal"></i>

                </div>
            </div>

        </div>

    </section>

    <section class="key_container container my-5">
        <h2 class="my-3 circleAndLine">KEY HIGHLIGHTS</h2>

        <div class="row px-lg-0 px-3 d-flex mt-5 flex-row align-items-center justify-content-between">
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Available in both
                    <?php echo _getSingleCourse($id, '_coursechannel') ?> Formats
                </p>
            </div>
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Duration :
                    <?php

                    $start = _getSingleCourse($id, '_startdate');
                    $end = _getSingleCourse($id, '_enddate');

                    $diff = abs(strtotime($start) - strtotime($end));

                    $years = floor($diff / (365 * 60 * 60 * 24));
                    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                    echo $days;

                    ?> days
                </p>
            </div>
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Age Criteria :
                    <?php echo _getSingleCourse($id, '_agelimit') ?>+
                </p>
            </div>
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Seats Available :
                    <?php echo _getSingleCourse($id, '_capacity') ?>
                </p>
            </div>
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Starts at :
                    <?php echo date("M j, Y", strtotime(_getSingleCourse($id, '_startdate'))) ?>
                </p>
            </div>
            <div class="col-lg-3 p-0  mx-lg-3 m-0 my-2 key_div">
                <p class="fw-bold px-2 py-2 m-0">
                    Ends at :
                    <?php echo date("M j, Y", strtotime(_getSingleCourse($id, '_enddate'))) ?>
                </p>
            </div>
        </div>

    </section>

    <section class="key_container container my-5 py-5">
        <h2 class="my-3 circleAndLine">ABOUT THE PROGRAM</h2>
        <div class="key_container_div fst-italic mt-5  fs-6 text-center text-dark" id="descDiv"
            style="box-sizing: content-box; max-height: 100px; overflow: hidden;">
            <?php
            echo _getSingleCourse($id, '_coursedescription');
            ?>
        </div>
        <div class="fs-6 fw-bold text-dark d-flex align-items-center justify-content-end" id="readMoreBtn"
            style="cursor: pointer;">
            Read More
        </div>

    </section>




    <section>
        <h2 class="my-5 circleAndLine">PROGRAM OVERVIEW</h2>

        <div class="overview_container w-100 container d-flex align-items-center justify-content-center">

            <div class="row w-75 my-3 d-flex flex-row align-items-center justify-content-between">

                <div class="col-lg-6 col-12 d-flex flex-column align-items-start justify-content-center">
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-people-arrows"></i> One on One Personalized Session
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-user-shield"></i> Training from certified trainers
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-palette"></i> 2 Capstone projects on completion
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-bug"></i> Doubt resolution and support available
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-file-pen"></i> 8+ of the live content
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-film"></i> 16+ hours of recorded content
                    </p>
                </div>

                <div class="col-lg-6 col-12 d-flex flex-column align-items-start justify-content-center">
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-people-arrows"></i> One on One Personalized Session
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-user-shield"></i> Training from certified trainers
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-palette"></i> 2 Capstone projects on completion
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-bug"></i> Doubt resolution and support available
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-file-pen"></i> 8+ of the live content
                    </p>
                    <p
                        class="text-dark fst-italic fs-6 fw-bold my-3 d-flex flex-row align-items-center justify-content-center">
                        <i class="fa-solid fs-2 me-3 fa-film"></i> 16+ hours of recorded content
                    </p>
                </div>
            </div>

        </div>

    </section>

    <section class="download_container" id="lessonplans">

        <div class="container  py-5">
            <p class="text-white fs-4 fst-italic  text-center">Lesson Plans</p>
            <!-- <a href="#" class="bg-white text-uppercase fw-bold text-decoration-none py-2 rounded px-4 fs-6">Download
                Syllabus</a> -->

            <div class="accordion px-lg-5 px-2 row " id="accordionExample">

                <?php _getLessonPlans($id); ?>

            </div>

        </div>

    </section>

    <section class="key_container container my-5 py-5">
        <h2 class="my-3 circleAndLine">what will you learn</h2>
        <div class="key_container_div fst-italic my-4 fs-6 text-center w-100  text-dark">
            <?php
            echo _getSingleCourse($id, '_whatlearn');
            ?>

        </div>
    </section>

    <section class="certification_container  py-3">


        <div class="container">

            <h2 class="my-3 circleAndLine">CERTIFICATION</h2>

            <div class="row py-5">

                <div
                    class="col-lg-6 col-12 p-lg-0 px-3 text-white d-flex flex-column align-items-lg-start align-items-center justify-content-center">

                    <h4 class="display-5 text-uppercase">Title</h4>

                    <p class="fs-6 fst-italic fw-normal mt-3 text-white text-lg-start text-center ">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam fugit debitis repudiandae nulla
                        et culpa voluptate dicta consequuntu
                    </p>

                    <p class="fs-6 fst-italic fw-normal mb-5 text-white text-lg-start text-center ">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quos, cumque necessitatibus eos,
                        assumenda soluta nam magnam provident accusamus rem alias doloribus cum neque ducimus debitis
                        dolor! Fugit vitae esse exercitationem!
                    </p>

                    <a href="#" class="text-white text-decoration-none fs-6 border py-2 px-3 fst-italic">
                        Read More
                    </a>
                </div>

                <div class="col-lg-6 col-12 p-lg-0 px-3 py-lg-0 py-5 d-flex align-items-center justify-content-center">
                    <img src="./assets/images/banner/certificate-svgrepo-com.svg " class="w-75" alt="">
                </div>

            </div>

        </div>

    </section>


    <section class="explore_container  my-5 py-3">


        <div class="container">

            <div class="row py-5">

                <div
                    class="col-lg-6 col-12 p-lg-0 px-3  d-flex flex-column align-items-lg-start align-items-center  justify-content-center">

                    <h4 class="display-6 text-uppercase">Title</h4>

                    <p class="fs-6 fst-italic fw-bold mt-3  text-lg-start text-center ">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam fugit debitis repudiandae nulla
                        et culpa voluptate dicta consequuntu
                    </p>

                    <a href="#"
                        class="text-white text-decoration-none fs-6 border py-2 px-5 rounded fw-bold shadow-lg ">
                        Explore
                    </a>
                </div>

                <div class="col-lg-6 col-12 p-lg-0 px-3 py-lg-0 py-5 d-flex align-items-center justify-content-center">
                    <img src="./assets/images/banner/laptop.svg" class="w-75" alt="">
                </div>

            </div>

        </div>

    </section>


    <section class="requirement_container container my-5 px-4 p-0">
        <h2 class="my-5 circleAndLine">Requirements</h2>
        <div class="courses__cards m-0   row w-100 justify-content-start">
            <?php
            _getCourseProducts($id);
            ?>
        </div>
    </section>

    <section class="faqs_container container my-5">

        <h3 class="px-lg-5 px-2 display-6">FAQ'S</h3>


        <div class="accordion px-lg-5 px-2" id="accordionExample">

            <div class="accordion rounded my-3 border -item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Accordion Item #1
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the first item's accordion body.</strong> It is shown by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item rounded my-3 border ">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Accordion Item #2
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
            <div class="accordion-item rounded my-3 border ">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Accordion Item #3
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the
                        collapse plugin adds the appropriate classes that we use to style each element. These classes
                        control the overall appearance, as well as the showing and hiding via CSS transitions. You can
                        modify any of this with custom CSS or overriding our default variables. It's also worth noting
                        that just about any HTML can go within the <code>.accordion-body</code>, though the transition
                        does limit overflow.
                    </div>
                </div>
            </div>
        </div>


    </section>

    <?php include('templates/_footer.php'); ?>

    <script>
        const descDiv = document.getElementById("descDiv");
        const readMoreBtn = document.getElementById("readMoreBtn");

        readMoreBtn.addEventListener("click", () => {
            if (descDiv.style.maxHeight == "100px") {
                descDiv.style.maxHeight = 'max-content';
                readMoreBtn.innerText = 'Read Less'
            } else {
                descDiv.style.maxHeight = "100px";
                readMoreBtn.innerText = 'Read More'
            }
        })
    </script>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- toggle -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


</body>

</html>


<!-- modal -->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa-solid fa-xmark" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <video id="my-video" class="video-js w-100 h-100" data-setup="{}" controls preload="auto"
                    data-setup="{}">
                    <source src="<?php echo _getSingleCourse($id, '_previewurl'); ?>" type="video/mp4" />
                </video>
            </div>
        </div>
    </div>
</div>
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

    <title>About Page</title>

</head>

<body>

    <?php include('templates/_header.php'); ?>

    <section class="pencil__container container mt-5 pt-5 px-lg-0 px-5">

        <div class="row">


            <div class="col-lg-4 col-12">
                <img class="w-100" style="border-radius:12px"
                    src="assets/images/About-us-Image.webp" alt="About us Image">
            </div>

            <div class="col-lg-8 col-12">
                <h4 class="fs-3 fw-bold text-dark">FREE YOUR CREATIVE SIDE</h4>
                <p class=" text-lg-start text-center fw-lighter fs-6" style="color:rgba(0,0,0,0.5)">
                        <?php _getPagesDescription('_aboutuspage'); ?>
                </p>
            </div>

        </div>

    </section>

    <section class="about_page__container container my-5   ">
        <div class="row  p-lg-0 px-3 g-lg-2 g-0 ">


            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Skill Development
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        We offer art workshops and classes that provide structured learning environments where participants can enhance their artistic skills.
                    </p>
                </div>
            </article>



            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Creative Exploration
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        Our studio fosters an environment that encourages creative exploration and free expression of ideas.
                    </p>
                </div>
            </article>



            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Art Therapy and Emotional Well-being
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        Art therapy can help manage stress, improve self-esteem, enhance emotional well-being, and provide a healthy outlet for processing emotions.
                    </p>
                </div>
            </article>



            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Exhibition and Showcase Opportunities
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        We hold events that offer opportunities to share your artwork with a wider audience, receive feedback, and gain exposure.
                    </p>
                </div>
            </article>



            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Exam Preparation
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        Art exam preparation sessions provide valuable guidance and support for individuals aiming to excel in art-related exams.
                    </p>
                </div>
            </article>



            <article class="col-lg-4 col-md-6 col-6 m-lg-0 mt-3 p-lg-0 pe-2  d-flex flex-lg-row flex-column ">
                <div class="about_item_left d-lg-block d-flex align-items-center justify-content-center ">
                    <i class="fa-solid fa-trophy p-3 fs-4 rounded-pill" style="background: #b92929;color:#fff;"></i>
                </div>
                <div class="about_item_right ms-lg-3 m-0">
                    <h3 class=" text-lg-start text-center fs-5 py-lg-3 py-1 " style="color:rgba(0,0,0,0.8)">
                        Access to Resources and Materials
                    </h3>
                    <p class="text-lg-start text-center fs-6" style="color:rgba(0,0,0,0.5)">
                        Get access to a variety of art materials, tools, and resources and gain hands-on experience using professional-grade materials.
                    </p>
                </div>
            </article>



        </div>
    </section>


    <section class="our_team__container my-5 py-5" style="display:none">

        <h3 class="circleAndLine">Our Team</h3>

        <p class="my-4 text-center fst-italic">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
        </p>

        <div class="container px-lg-0 px-5">

            <div class="row">

                <div class="col-lg-4 col-12 m-lg-0 mt-4  ">
                    <div class="card">
                        <img src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/team-1-about-1-a.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between ">
                            <h5 class="card-title fs-5 fw-bold">JERRY FREEMAN</h5>
                            <p class="card-text fst-italic">Developer</p>
                            <ul
                                class="team_socials d-flex flex-row align-items-center justify-content-center list-unstyled m-0 border-top pt-3 w-100">
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 m-lg-0 mt-4  ">
                    <div class="card">
                        <img src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/team-1-about-1-a.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between ">
                            <h5 class="card-title fs-5 fw-bold">JERRY FREEMAN</h5>
                            <p class="card-text fst-italic">Developer</p>
                            <ul
                                class="team_socials d-flex flex-row align-items-center justify-content-center list-unstyled m-0 border-top pt-3 w-100">
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-12 m-lg-0 mt-4  ">
                    <div class="card">
                        <img src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/team-1-about-1-a.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between ">
                            <h5 class="card-title fs-5 fw-bold">JERRY FREEMAN</h5>
                            <p class="card-text fst-italic">Developer</p>
                            <ul
                                class="team_socials d-flex flex-row align-items-center justify-content-center list-unstyled m-0 border-top pt-3 w-100">
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fs-4 mx-3 text-dark fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <section class="pencil__container container mt-5 pt-5 px-lg-0 px-5" style="display:none">

        <div class="row">

            <div class="col-lg-8 col-12">
                <h4 class="fs-3 fw-bold text-dark">FREE YOUR CREATIVE SIDE</h4>
                <p class="text-lg-start text-center  fw-lighter fs-6" style="color:rgba(0,0,0,0.5)">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                    ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure
                    dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                    facilisis at vero eros et accumsan et.
                </p>
            </div>

            <div class="col-lg-4 col-12">
                <img class="w-100"
                    src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/about-1-img-1.jpg" alt="">
            </div>

        </div>

    </section>

    <section class="makeAnAppinmentSection py-5">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <p class="fs-6">
                We believe that art has the ability to heal. Our therapy sessions are led by trained and certified art therapist Mona Joy who guides patients in the creative process, encourages them to express themselves through art, and provides support and guidance throughout the process.
            </p>

            <a class="fs-5" href="#">Make an appoinment</a>

        </div>
    </section>

    <section class="faqs_container container my-5">
        <h3 class="fs-3 fw-bold text-dark">Our FAQ'S</h3>


        <div class="accordion" id="accordionExample">

            <?php _getFaqsForAboutPage(); ?>
        
        </div>
    </section>

    <?php include('templates/_footer.php'); ?>

    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

</body>

</html>
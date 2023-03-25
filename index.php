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


    <title>Home Page</title>


 
</head>

<body>

    <?php include('templates/_header.php'); ?>

    <!-- Banner Image  -->
    <div class="banner-image w-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-uppercase text-white fw-bold display-2">
                Transform your imagination <br />
                into reality
            </h1>
        </div>
    </div>



    <!-- Creative Section -->
    <section class="container  px-lg-0 px-sm-2  px-xs-2  my-5 creative_section">
        <div class="row py-5">
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-start justify-content-evenly ">
                <h3 class="fw-bold  w-100 text-lg-start text-sm-center"> Get Inspired</h3>
                <p class="lead fst-italic fs-6 text-lg-start text-sm-center ">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex in labore deserunt voluptatum earum
                    natus illum! Officia doloremque ducimus
                </p>

            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between border border-0 border-end  border-dark ">
                <img src="assets/images/icons/i1.svg" width="100px" alt="">
                <h5 class="fw-bold py-2 ">Classes</h5>
                <p class="lead fst-italic fs-6 text-center">For artists and art enthusiasts to come together
                    and learn new skills, techniques, and ideas. </p>
            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between  border border-0 border-end  border-dark   ">
                <img src="assets/images/icons/i2.svg" width="100px" alt="">

                <h5 class="fw-bold py-2 ">Courses</h5>
                <p class="lead fst-italic fs-6 text-center">Explore your creative potential and develop in-depth skills
                    through structured art sessions. </p>
            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between ">
                <img src="assets/images/icons/i3.svg" width="100px" alt="">

                <h5 class="fw-bold py-2 ">Art Therapy</h5>
                <p class="lead fst-italic fs-6 text-center">Enhance personal well-being, improve emotional and mental
                    health through art.</p>
            </div>
        </div>
    </section>

    <!-- Courses -->
    <section class="coursesContainer ">

        <div class="container  px-lg-0 px-2 py-5">
            <h2 class="circleAndLine">
                Courses
            </h2>

            <p class="my-4 text-center fst-italic">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
            </p>

            <div class="courses__cards m-0   row w-100 justify-content-between">

                <div class="courses__card p-0 col-lg-4 col-md-12 mb-md-3 mb-sm-3 mb-3  col-12 ">

                    <div class="imgDiv">
                        <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                    </div>

                    <div class="content">
                        <div class="headingDiv">
                            <span>Jesus Offering Bread</span>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="paragraphDiv">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, natus. Autem similiqu
                            </p>
                        </div>


                    </div>
                </div>

                <div class="courses__card p-0 col-lg-4 col-md-12 mb-md-3 mb-sm-3 mb-3  col-12 ">

                    <div class="imgDiv">
                        <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                    </div>

                    <div class="content">
                        <div class="headingDiv">
                            <span>Jesus Offering Bread</span>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="paragraphDiv">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, natus. Autem similiqu
                            </p>
                        </div>


                    </div>
                </div>

                <div class="courses__card p-0 col-lg-4 col-md-12 mb-md-3 mb-sm-3 mb-3  col-12 ">

                    <div class="imgDiv">
                        <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                    </div>

                    <div class="content">
                        <div class="headingDiv">
                            <span>Jesus Offering Bread</span>
                            <button><i class="fa-regular fa-heart"></i></button>
                            <button><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="paragraphDiv">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, natus. Autem similiqu
                            </p>
                        </div>


                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ubiquity in art -->

    <section class="ubiquityContainer">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h2 class="circleAndLine">ubiquity in art</h2>
            <p class="my-4 text-center fst-italic">Lorem ipsum dolor sit amet consectetur adipisicing elit. A mollitia
                nam
                adipisci? Nam, harum libero!</p>
            <img src="./assets/images/banner/laptop.svg" alt="">
        </div>
    </section>


    <!-- Studio background -->
    <section class="studio_background container d-none">
        <div class="row w-100 p-0 m-0 flex-row justify-content-between">

            <div class="studioBackgroundContainer__content p-0 col-lg-5 col-mg-12 ">
                <h4>STUDIO BACKGROUND</h4>
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere doloribus alias minus distinctio
                    nobis.
                    Ipsam hic asperiores est laudantium? Explicabo cupiditate assumenda accusantium, soluta
                </p>
            </div>

            <div class="p-0 col-lg-3 col-md-5 mt-md-2 mt-sm-3 "
                style="background: url(assets/images/banner/be2a4a_98f940a060f442cda5f96828caeb5401_mv2.svg);">
                <span>Text on hover</span>
            </div>

            <div class="p-0 col-lg-3 col-md-5 mt-md-2  mt-sm-3 ">
                <span>Text on hover</span>
            </div>
        </div>

    </section>

    <!-- Subscription -->

    <section class="subscriptionContainer  container">


        <h2 class="circleAndLine">
            Subscription
        </h2>

        <p class="my-4 text-center fst-italic">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
        </p>


        <div class="row  w-100 mt-5 justify-content-between ">

            <div class="col-lg-3 col-md-6 col-xs-12 px-lg-2 px-0 my-lg-0 my-5  subscriptionCard">
                <div class="imgDiv">

                </div>
                <div class="circle">

                </div>
                <button>
                    Purchase
                </button>
            </div>

            <div class="col-lg-3 col-md-6 col-xs-12 px-lg-2 px-0 my-lg-0 my-5  subscriptionCard">
                <div class="imgDiv">

                </div>
                <div class="circle">

                </div>
                <button>
                    Purchase
                </button>
            </div>

            <div class="col-lg-3 col-md-6 col-xs-12 px-lg-2 px-0 my-lg-0 my-5  subscriptionCard">
                <div class="imgDiv">

                </div>
                <div class="circle">

                </div>
                <button>
                    Purchase
                </button>
            </div>

            <div class="col-lg-3 col-md-6 col-xs-12 px-lg-2 px-0 my-lg-0 my-5  subscriptionCard">
                <div class="imgDiv">

                </div>
                <div class="circle">

                </div>
                <button>
                    Purchase
                </button>
            </div>

        </div>


    </section>


    <!-- Counts -->

    <section class="countContainer">

        <div class="container w-100 h-100">
            <div class="row w-100 py-lg-5 py-4 h-100 m-0 ">

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">99</h3>
                    <span>Students</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">99</h3>
                    <span>Teachers</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">99</h3>
                    <span>Students</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">99</h3>
                    <span>Teachers</span>
                </div>

            </div>
        </div>

    </section>



    <!-- Blogs -->
    <section class="blogsContainer container">

        <h2 class="circleAndLine">
            Blogs
        </h2>

        <p class="my-4 text-center fst-italic">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
        </p>


        <div class="blogs__cards row w-100 justify-content-between ">

            <div class="blog__card col-lg-3 col-md-12 my-2 p-0">
                <div class="imgDiv">
                    <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                </div>

                <div class="content">
                    <h4>Always in Motion</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur sapiente iusto maxime. Itaque,
                        corrupti iste. </p>
                </div>

                <div class="date">
                    <span>
                        <i class="fa-regular fa-calendar-days"></i>
                        Oct 13, 2013
                    </span>
                    <button><i class="fa-regular fa-heart"></i>5</button>
                    <button><i class="fa-sharp fa-solid fa-share-nodes"></i></button>
                </div>
            </div>

            <div class="blog__card col-lg-3 col-md-12 my-2 p-0">
                <div class="imgDiv">
                    <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                </div>

                <div class="content">
                    <h4>Always in Motion</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur sapiente iusto maxime. Itaque,
                        corrupti iste. </p>
                </div>

                <div class="date">
                    <span>
                        <i class="fa-regular fa-calendar-days"></i>
                        Oct 13, 2013
                    </span>
                    <button><i class="fa-regular fa-heart"></i>5</button>
                    <button><i class="fa-sharp fa-solid fa-share-nodes"></i></button>
                </div>
            </div>

            <div class="blog__card col-lg-3 col-md-12 my-2 p-0">
                <div class="imgDiv">
                    <img src="./assets/images/banner/jesus_christ_bg.svg" alt="">
                </div>

                <div class="content">
                    <h4>Always in Motion</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur sapiente iusto maxime. Itaque,
                        corrupti iste. </p>
                </div>

                <div class="date">
                    <span>
                        <i class="fa-regular fa-calendar-days"></i>
                        Oct 13, 2013
                    </span>
                    <button><i class="fa-regular fa-heart"></i>5</button>
                    <button><i class="fa-sharp fa-solid fa-share-nodes"></i></button>
                </div>
            </div>

        </div>


    </section>



    <!-- Amazing Container -->
    <!-- <section class="amazingFeatureContainer">
        <div class="container">
            <img src="assets/images/banner/amazing features.svg" alt="">
        </div>
    </section> -->

    <?php include('templates/_footer.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>
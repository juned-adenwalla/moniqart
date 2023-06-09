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
    <!-- font awesome icons -->
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
    <div style="--img:url(<?php     $img =  _getHomePageDetails('_bannerimg');
                                    echo base_url("uploads/homepagebanner/$img") 
                                    ?>);"
        class="banner-image w-100 d-flex justify-content-center align-items-center">
        <div class="content text-center">
            <h1 class="text-uppercase text-white fw-bold display-2">

                <?php echo _getHomePageDetails('_bannertitle'); ?>

            </h1>
        </div>
    </div>



    <!-- Creative Section -->
    <section class="container  px-lg-0 px-sm-2  px-xs-2  my-5 creative_section">
        <div class="row py-5">
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-start justify-content-evenly ">
                <h3 class="fw-bold  w-100 text-lg-start text-sm-center">GET INSPIRED</h3>
                <p class="lead fst-italic fs-6 text-lg-start text-sm-center ">
                    At MONIQART, we cover a full-range of courses across all levels of creativity and education.
                </p>

            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between border border-0 border-end  border-dark ">
                <img src="assets/images/icons/i1.svg" width="100px" alt="">
                <h5 class="fw-bold py-2 ">WORKSHOPS</h5>
                <p class="lead fst-italic fs-6 text-center">For artists and art enthusiasts to come together and learn new skills, techniques, and ideas.</p>
            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between  border border-0 border-end  border-dark   ">
                <img src="assets/images/icons/i2.svg" width="100px" alt="">

                <h5 class="fw-bold py-2 ">COURSES</h5>
                <p class="lead fst-italic fs-6 text-center">Explore your creative potential and develop in-depth skills through structured art sessions.</p>
            </div>
            <div
                class="creative_col col-lg-3 col-md-6 col-12 d-flex flex-column align-items-center justify-content-between ">
                <img src="assets/images/icons/i3.svg" width="100px" alt="">

                <h5 class="fw-bold py-2 ">ART THERAPY</h5>
                <p class="lead fst-italic fs-6 text-center">Enhance personal well-being, improve emotional and mental health through art.</p>
            </div>
        </div>
    </section>

    <!-- Courses -->
    <section class="coursesContainer ">

        <div class="container px-lg-0 px-4 py-5">
            <h2 class="circleAndLine">
                Courses
            </h2>

            <p class="my-4 text-center fst-italic">
                Learn from a class of professional artists. Get unique insights and perspectives combined with access to effective resources.
            </p>

            <div class="courses__cards m-0   row w-100 justify-content-between">

                <?php _showLatestCourses(4) ?>

            </div>

        </div>

    </section>

    <!-- ubiquity in art -->

    <section class="ubiquityContainer">
        <div class="container d-flex flex-column justify-content-center align-items-center">
            <h2 class="circleAndLine">ONLINE ART COURSES</h2>
            <p class="my-4 text-center fst-italic">Art is for everyone. Learn from anywhere in the world.</p>
            <img src="./assets/images/banner/laptop.svg" alt="">
        </div>
    </section>


    <!-- Studio background -->
    <section class="studio_background container px-lg-0 px-2 ">
        <div class="row w-100 p-0 m-0 flex-row justify-content-between">

            <div class="studioBackgroundContainer__content p-0 py-4 col-lg-5 col-12 ">
                <h4 class="fw-bold display-6 text-lg-start text-center ">STUDIO BACKGROUND</h4>
                <p class="fs-6 text-lg-start text-center ">
                Moniqart strives to foster imagination and creativity in our studio by helping students create beautiful art. Whether you’re coming in to spend the day or to truly exploit your talent, you’ll find a blank canvas awaiting you where the world is your oyster. We opened our doors in 2006 and have been creating art and forming artists since.
                </p>
            </div>

            <div class="studio_background_div p-0 col-lg-3  col-12  mt-3 "
                style="background: url(assets/images/banner/be2a4a_3ee8482c3b694b91a71d593dba8e411c_mv2.svg); background-size: cover; background-repeat:no-repeat; background-position: center;">
                <span>Founder's Portfolio</span>
            </div>

            <div class="studio_background_div p-0 col-lg-3   col-12  mt-3 "
                style="background: url(assets/images/banner/be2a4a_98f940a060f442cda5f96828caeb5401_mv2.svg); background-size: cover; background-repeat:no-repeat; background-position: center;">
                <span>About Moniqart</span>
            </div>

        </div>

    </section>

    <!-- make an appoinment section -->

    <section class="makeAnAppinmentSection py-5">

        <div class="container d-flex flex-column justify-content-center align-items-center">
            <p class="fs-6">
                We believe that art has the ability to heal. Our therapy sessions are led by trained and certified art therapist Mona Joy who guides patients in the creative process, encourages them to express themselves through art, and provides support and guidance throughout the process.
            </p>

            <a class="fs-5" href="#">Make an appoinment</a>

        </div>

    </section>


    <!-- Store Container -->
    <section class="storeContainer">

        <div class="container  px-lg-0 px-4 py-5">


            <h2 class="circleAndLine">
                Store
            </h2>

            <p class="my-4 text-center fst-italic">
                Equip Yourself for Artistic Brilliance
            </p>

            <div class="courses__cards m-0   row w-100 justify-content-between">

                <?php
                _showLatestProducts(4);
                ?>

            </div>
        </div>

    </section>


    <!-- Subscription -->

    <section class="subscriptionContainer">

        <div class="container  px-lg-0 px-4 py-5">

            <h2 class="circleAndLine">
                MEMBERSHIPS
            </h2>

            <p class="my-4 text-center fst-italic">
                Become a member today and avail extra benefits!
            </p>


            <div class="courses__cards m-0  my-lg-5  row w-100 justify-content-between">

                <?php _showLatestMemberships(4) ?>

            </div>
        </div>


    </section>


    <!-- Counts -->

    <section class="countContainer">

        <div class="container w-100 h-100">
            <div class="row w-100 py-lg-5 py-4 h-100 m-0 ">

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">15+</h3>
                    <span>Years of Experience</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">3000+</h3>
                    <span>No. Of Artist Members</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">5000+</h3>
                    <span>No. Of students enrolled</span>
                </div>

                <div class="col-3 h-100 p-0 d-flex flex-column align-items-center justify-content-center ">
                    <h3 class="display-2">6000+</h3>
                    <span>No. Of classes conducted</span>
                </div>

            </div>
        </div>

    </section>



    <!-- Blogs -->
    <section class="blogsContainer">

        <div class="container px-lg-0 px-4 py-5">


            <h2 class="circleAndLine">
                Blogs
            </h2>

            <p class="my-4 text-center fst-italic">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolor, culpa.
            </p>


            <div class="courses__cards m-0   row w-100 justify-content-between">

                <?php _showLatestBlogs(4) ?>


            </div>

        </div>

    </section>



    <!-- Amazing Container -->
    <section class="amazingFeatureContainer my-5">
        <div class="container">
            <img class="w-100" src="assets/images/banner/amazing features.svg" alt="">
        </div>
    </section>

    <?php include('templates/_footer.php'); ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>
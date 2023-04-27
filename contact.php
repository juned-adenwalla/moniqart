<?php include('templates/_header.php'); ?>

<?php

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usermessage = $_POST['usermessage'];
    _addContactToDb($username, $useremail, $usermessage);


}
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

    <title>Contact Page</title>



</head>

<body>

 

    <section class="contact__container container pt-5 my-5">

        <div class="row p-0 g-lg-5 g-0">
            <div class="col-lg-8  col-12  ">

                <h4 class="fs-2">GET IN <span style="color:#b92929;">TOUCH!</span> </h4>
                <p class="fs-6 text-start" style="color:rgba(0,0,0,0.4)">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut
                    laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam.
                </p>

                <form action="#" method="post" class="d-flex flex-column justify-content-start align-items-start">
                    <input type="text" style="border:1px solid rgba(0,0,0,0.1); " class="w-100 py-3 px-4 my-3  "
                        name="username" placeholder="Name*">
                    <input type="text" style="border:1px solid rgba(0,0,0,0.1); " class="w-100 py-3 px-4 my-3  "
                        name="useremail" placeholder="Email Address*">
                    <textarea style="border:1px solid rgba(0,0,0,0.1); " class="w-100 py-3 px-4 my-3  " id="" rows="5"
                        name="usermessage" placeholder="Comment*"></textarea>
                    <button type="submit" name="submit" class="btn px-5 py-3">
                        Submit
                    </button>
                </form>

            </div>

            <div class="col-lg-4 col-12  border py-4 px-lg-5  px-3 m-lg-0 mt-3 ">
                <ul class="list-unstyled m-0 my-2">
                    <h4 class=" fs-3" style="color:#b92929;">Main Office</h4>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-location-dot me-3 fs-4 "></i>
                        Rokin 94, 1012 Amsterdam
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-phone me-3 fs-4 "></i>
                        Phone: +88 (0) 101 0000 000
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-fax me-3 fs-4 "></i>
                        Fax: +88 (0) 202 0000 001
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-envelope me-4 fs-4 "></i>
                        Email: youremail@yourdomain.com
                    </li>
                </ul>
                <ul class="list-unstyled m-0 my-2">
                    <h4 class=" fs-3" style="color:#b92929;">Second Office</h4>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-location-dot me-3 fs-4 "></i>
                        Rokin 94, 1012 Amsterdam
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-phone me-3 fs-4 "></i>
                        Phone: +88 (0) 101 0000 000
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-fax me-3 fs-4 "></i>
                        Fax: +88 (0) 202 0000 001
                    </li>
                    <li class="fs-6 py-3 d-flex flex-row justify-content-start align-items-center"
                        style="color:rgba(0,0,0,0.4)">
                        <i class="fa-solid fa-envelope me-3 fs-4 "></i>
                        Email: youremail@yourdomain.com
                    </li>
                </ul>
            </div>

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
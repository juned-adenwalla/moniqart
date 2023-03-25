<?php


session_start();


require('./includes/_clientfunctions.php');

$userLoggedIn = false;

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    // $memebershipAva
} else {
    $userLoggedIn = true;
}


$currency = 'INR';


$_id = $_GET['id'];

$courseName = _getSingleCourse($_id, '_coursename');
$courseDesc = strip_tags(_getSingleCourse($_id, '_coursedescription'));
$courseImg = _getSingleCourse($_id, '_banner');

$teacherId = _getSingleCourse($_id, '_teacheremailid');
$coursePrice = _getSingleCourse($_id, '_pricing');
$discountPrice = _getSingleCourse($_id, '_discountprice');

$teacherUser = _getsingleuser($teacherId, '_username');

$total = _gettotal('0', 'INR', '0') + $coursePrice;

$couponAppliedSuccess = '0';


if ($userLoggedIn) {
    $userId = $_SESSION['userId'];
    $currency = _getsingleuser($userId, '_usercurrency');
    $memebershipId = _getsingleuser($userId, '_usermembership');
    $membershipDiscount = checkmembership($coursePrice, $currency);

    $total = (_gettotal('0', 'INR', '0') + $coursePrice) - $membershipDiscount;
} else {
    $membershipDiscount = '0';
}


if (isset($_POST['couponcode'])) {

    $couponCode = $_POST['couponcode'];

    $couponPrice = _validatecoupon($coursePrice, $couponCode, 'INR', 'ecommerce');

    if ($couponPrice) {

        $couponAppliedSuccess = true;
        $total = (_gettotal('0', 'INR', '0') + $coursePrice) - $couponPrice;
    } else {
        $couponAppliedSuccess = false;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2&family=Balsamiq+Sans&fa
mily=Comfortaa&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="./assets/frontend/css/style.css">

    <!--=============== BOXICONS ===============-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F6F8FD
        }

        .bg {
            background-color: #F6F8FD
        }

        .green {
            color: rgb(15, 207, 143);
            font-weight: 680
        }

        @media(max-width:567px) {
            .mobile {
                padding-top: 40px
            }
        }
    </style>

</head>

<body>

    <?php include('templates/_header.php'); ?>

    <div class="container rounded bg-white mt-2">
        <div class="bg  row d-flex justify-content-center pb-5">

            <div class="col-sm-4 s col-md-6 ml-1">
                <div class="py-4 pl-6 d-flex flex-row">
                </div>

                <div class=" p-4 d-flex flex-column" style="border-radius:14px">

                    <h5 class="mb-2" style="font-size: 31px;font-weight: 700;">
                        Order Details
                    </h5>

                    <div class="d-flex align-items-center mt-4 mb-4 ">
                        <img class="img-fluid" src="./uploads/coursebanner/<?php echo $courseImg ?>"
                            style="border-radius:5px; width: 200px;" />


                        <div class="d-flex flex-column align-items-start">
                            <h5 class="mt-2 ml-3" style="font-size: 21px;font-weight: 700;">
                                <?php echo $courseName ?>
                            </h5>
                            <p class="ml-3">
                                <span class="green d-block">₹ <?php echo $coursePrice ?></span>
                                <s style="color:red;font-size: 20px;font-weight: 700;"> ₹<?php echo $discountPrice ?></s>
                            </p>
                        </div>

                    </div>





                    <p>
                        <?php echo $courseDesc ?>
                    </p>




                </div>
            </div>

            <div class="col-sm-5 col-md-5 mobile">
                <div class="py-4 d-flex justify-content-end">
                    <!-- <h6><a href="#">Cancel and return to website</a></h6> -->
                </div>
                <div class="p-3 d-flex flex-column" style="border-radius:14px">

                    <div class="pt-2">
                        <h5 style="font-size: 25px;font-weight: 700;">Summary</h5>
                    </div>


                    <div class="d-flex">
                        <div class="col-8">Course Price :</div>
                        <div class="ml-auto price" style="color: #1c1d1f;font-weight: 400;">
                            ₹<?php echo $coursePrice ?>
                        </div>
                    </div>

                    <?php _getAllMarkupsForCheckout(); ?>



                    <?php


                    if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
                        ?>

                        <form action="#" method="POST" class="d-flex border-top mt-2 pt-2 align-items-center ">
                            <div class="col-8">Coupon Code</div>
                            <input type="text" class="form-control" placeholder="Coupon Code" name="couponcode"
                                onchange="this.form.submit()">
                        </form>

                        <div class="d-flex flex-column align-items-end mt-2">

                            <?php

                            if ($couponAppliedSuccess === true) {
                                ?>
                                <h5 class="green" style="font-size: 15px;">Coupon Code Applied !!</h5>
                                <?php
                            } else if ($couponAppliedSuccess === false) {
                                ?>
                                    <h5 style="font-size: 15px; color: red; font-weight: 600; ">Invalid Coupon Code</h5>
                                    <a href="" style="float:right">Reset Coupon</a>
                                <?php
                            }

                            ?>

                        </div>

                        <?php

                    } else {
                        ?>

                        <div class="d-flex flex-column align-items-end mt-3">

                            <h5 class="green" style="font-size: 15px; font-weight: 200;">Membership Discount : <span
                                    style="font-weight: 600;">
                                    <?php echo $membershipDiscount; ?>
                                </span> </h5>

                        </div>

                        <?php

                    }


                    ?>


                    <div class="pt-2 mt-3 border-top d-flex">
                        <p class="col-12" style="font-size: 14px; font-weight: 200;">By completing your purchase you
                            agree to these Terms of Service.</p>
                    </div>

                    <div class="pt-2 mt-3 border-top d-flex">
                        <h5 class="col-8" style="font-size: 21px; font-weight: 600;">Total Amount</h5>
                        <div class="ml-auto  price">
                            <span style="font-size: 17px; font-weight: 600;">₹<?php echo $total; ?></span>
                        </div>
                    </div>

                    <input type="button" value="Complete Checkout" class=" btn mt-4 btn-primary btn-block"
                        style=" background-color:#1ab8a6; border: none; " id="purchaseBtn">
                    <div class="text-center p-3"> <a class="text-link " target="_blank" style="color: black;"
                            href="#">Cancel</a> </div>
                </div>



            </div>
        </div>
    </div>

    <footer class=" footer" id="footer">

        <div class="footer__container container">

            <div class="footer__top row">

                <div class="footer__column_1">

                    <a href="index.html" class="footer__logo">
                        <img src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/logo-footer.png"
                            alt="">
                    </a>

                    <p class="footer__logo__description">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore.
                    </p>

                    <div class="footer__logo__info">
                        <div class="footer__logo__item">
                            <i class="bx bx-envelope-open"></i>
                            <span>info@gmail.com</span>
                        </div>
                        <div class="footer__logo__item">
                            <i class="bx bx-phone-incoming"></i>
                            <span>1-444-123-4559</span>
                        </div>
                        <div class="footer__logo__item">
                            <i class="bx bx-home"></i>
                            <span>Rokin 90-94, 1012 Amsterdam</span>
                        </div>
                    </div>

                </div>

                <div class="footer__column_2">

                    <h1 class="footer__heading">Recent Posts</h1>

                    <p class="footer__post__item">
                        <a href="#">
                            Always In Motion November 6, 2015
                        </a>
                    </p>

                    <p class="footer__post__item">
                        <a href="#">
                            Cloud Descending November 6, 2015
                        </a>
                    </p>

                    <p class="footer__post__item">
                        <a href="#">
                            Front Page Story November 6, 2015
                        </a>
                    </p>

                    <p class="footer__post__item">
                        <a href="#">
                            Contagious Ideas November 6, 2015
                        </a>
                    </p>


                </div>

                <div class="footer__column_3">

                    <h1 class="footer__heading">Instagram</h1>


                </div>

                <div class="footer__column_4">

                    <h1 class="footer__heading">Contact Us</h1>

                    <form action="#" class="footer__contact__form">
                        <input type="text" placeholder="Your Name">
                        <input type="text" placeholder="Your Email">
                        <textarea name="" id="" cols="30" rows="3">Comment</textarea>
                        <button>
                            submit
                        </button>
                    </form>


                </div>

            </div>

            <div class="footer__bottom">

                <div class="footer__copyright">
                    <p>© 2015 Qode Interactive, All Rights Reserved</p>
                </div>

                <ul class="footer__social-menu">


                    <li class="social-menu-list">
                        <a href="#">
                            <i class="bx bxl-facebook"></i>
                        </a>
                    </li>

                    <li class="social-menu-list">
                        <a href="#">
                            <i class="bx bxl-instagram"></i>
                        </a>
                    </li>

                    <li class="social-menu-list">
                        <a href="#">
                            <i class="bx bxl-twitter"></i>
                        </a>
                    </li>

                    <li class="social-menu-list">
                        <a href="#">
                            <i class="bx bxl-linkedin"></i>
                        </a>
                    </li>

                </ul>


            </div>

        </div>

    </footer>


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
        var options = {
            "key": "<?php echo _paymentconfig('_apikey'); ?>", // Enter the Key ID generated from the Dashboard
            "amount": "<?php echo ceil($total * 100); ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            "currency": "<?php echo $currency; ?>",
            "name": "<?php echo _paymentconfig('_companyname'); ?>",
            "description": "Payment for your Purchase",
            "image": "http://localhost/Adenwalla-Infotech/moniqart-development/uploads/images/logo.png",
            // "order_id": "OD<?php echo rand(111111, 999999) ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            "handler": function (response) {
                console.log('response', response);
                document.getElementById('transpay').click();
            },
            "notes": {
                "address": "Razorpay Corporate Office"
            },
            "theme": {
                "color": "#4B49AC"
            }
        };
        var rzp1 = new Razorpay(options);

        rzp1.on('payment.failed', function (response) {
            window.location.href = "failed";
        });
        document.getElementById('purchaseBtn').onclick = function (e) {
            rzp1.open();
            // e.preventDefault();
        }
    </script>



</body>

</html>
<?php include('templates/_header.php'); ?>

<?php


if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    echo "<script>";
    echo "window.location.href = 'signin'";
    echo "</script>";
} else {
}


$currency = $_SESSION['baseCurrency'];







$_id = $_GET['id'];

$courseName = _getSingleCourse($_id, '_coursename');
$courseDesc = _getSingleCourse($_id, '_coursedescription');
$courseImg = _getSingleCourse($_id, '_banner');

$teacherId = _getSingleCourse($_id, '_teacheremailid');
$coursePrice = _getSingleCourse($_id, '_pricing');
$discountPrice = _getSingleCourse($_id, '_discountprice');

$teacherUser = _getsingleuser($teacherId, '_username');




$convertedCoursePrice = _conversion($coursePrice, $currency);
$fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
$updateCoursePrice = $fmt->formatCurrency($convertedCoursePrice, $currency);

$convertedDiscountPrice = _conversion($discountPrice, $currency);
$updateDiscountPrice = $fmt->formatCurrency($convertedDiscountPrice, $currency);



$total = _gettotal($convertedCoursePrice, $currency, '0');
$updateTotalPrice = $fmt->formatCurrency($total, $currency);



$membership = false;

$userId = $_SESSION['userId'];
$memebershipId = _getsingleuser($userId, '_usermembership');
$membershipDiscount = checkmembership($coursePrice, $currency);

if ($membershipDiscount != false) {
    $membership = true;

    $total = _gettotal($convertedCoursePrice, $currency, $membershipDiscount);
    $updateTotalPrice = $fmt->formatCurrency($total, $currency);
} else {
    $membership = false;
}


$couponAppliedSuccess = null;

if (isset($_POST['couponcode'])) {

    $couponCode = $_POST['couponcode'];
    $_SESSION['coupon'] = $couponCode;


    $couponPrice = _validatecoupon($coursePrice, $couponCode, $currency, 'ecommerce');

    if ($couponPrice) {

        $couponAppliedSuccess = true;

        $total = _gettotal($convertedCoursePrice, $currency, $couponPrice);
        $updateTotalPrice = $fmt->formatCurrency($total, $currency);
    } else {
        $couponAppliedSuccess = false;
    }
} else {
    $_SESSION['coupon'] = null;
}

$_SESSION['amount'] = $total;
$_SESSION['currency'] = $currency;
$_SESSION['prod'] = 'ecommerce';
$_SESSION['prodid'] = $_id;


// razorpay configuration


require('razorpay-php/Razorpay.php');

$keyId = 'rzp_test_J52EK80lRu54qe';
$keySecret = 'm6hb2ug6l6uffeWieSnSKCC6';
//Razorpay//
use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

$userId = $_SESSION['userId'];

$username = _getsingleuser($userId,'_username');
$useremail = $_SESSION['userEmailId'] ;
$userphone = $_SESSION['userPhoneNo'];

$address = "address";

$webtitle =  _siteconfig('_sitetitle');;


$pricToPay = $total;

$orderData = [
    'receipt' => 3456,
    'amount' => $pricToPay * 100,
    'currency' => $currency,
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;


$displayAmount = $amount = $orderData['amount'];


$data = [
    "key" => $keyId,
    "amount" => $amount,
    "currency" => $currency,
    "name" => $webtitle,
    // "image" => $imageurl,
    "prefill" => [
        "name" => $username,
        "email" => $useremail,
        "contact" => $userphone,
    ],
    "notes" => [
        "address" => $address,
        "merchant_order_id" => "12312321",
    ],
    "theme" => "#F37254",
    "order_id" => $razorpayOrderId,
];

$json = json_encode($data);





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


    <title>Checkout Page</title>

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
    </style>

</head>

<body>


    <div class="container rounded bg-white mt-2">
        <div class="bg  row d-flex justify-content-center pb-5">

            <div class="col-lg-6 col-12">
                <div class="py-4 pl-6 d-flex flex-row">
                </div>

                <div class=" p-4 d-flex flex-column" style="border-radius:14px">

                    <h5 class="mb-2" style="font-size: 31px;font-weight: 700;">
                        Order Details
                    </h5>

                    <div class="d-flex align-items-center mt-4 mb-4 ">
                        <img class="img-fluid " src="./uploads/coursebanner/<?php echo $courseImg ?>"
                            style="border-radius:5px; width: 200px;" />


                        <div class="d-flex flex-column align-items-start ms-3 ">
                            <h5 class="mt-2 ml-3" style="font-size: 21px;font-weight: 700;">
                                <?php echo $courseName ?>
                            </h5>
                            <p class="ml-3">
                                <span class="green d-block">
                                    <?php echo $updateCoursePrice ?>
                                </span>
                                <s style="color:red;font-size: 20px;font-weight: 700;">
                                    <?php echo $updateDiscountPrice ?>
                                </s>
                            </p>
                        </div>

                    </div>

                    <div class="fst-italic mt-5  fs-6 text-center text-dark py-4 ">
                        <?php
                        $desc = strip_tags($courseDesc);
                        echo strlen($desc) > 30 ? substr($desc, 0, 150) . "..." : $desc
                            ?>

                    </div>





                </div>
            </div>

            <div class="col-lg-6 col-12  mobile">
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
                            <?php echo $updateCoursePrice ?>
                        </div>
                    </div>

                    <?php _getAllMarkupsForCheckout(); ?>



                    <?php


                    if ($membership == false) {
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
                                <h6 class="green" style="font-size: 15px;">
                                    <?php echo $updateCoursePrice ?> -
                                    <?php echo $fmt->formatCurrency($couponPrice, $currency) ?>
                                </h6>
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



                            <?php
                            if ($membershipDiscount != '') {
                                ?>
                                <h5 class="green" style="font-size: 15px; font-weight: 200;">Membership Discount :
                                    <span style="font-weight: 600;">
                                        <?php echo $membershipDiscount; ?>
                                    </span>
                                </h5>
                                <?php
                            } else {
                                ?>
                                <h5 class="green" style="font-size: 15px; font-weight: 200;">No Membership Discount
                                </h5>
                                <?php
                            }
                            ?>

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
                            <span style="font-size: 17px; font-weight: 600;">
                                <?php echo $updateTotalPrice; ?>
                            </span>
                        </div>
                    </div>



                    <form action="check.php" method="POST">
                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>"
                            data-amount="<?php echo $data['amount'] ?>" data-currency="<?php echo $data['currency'] ?>"
                            data-name="<?php echo $data['name'] ?>"
                            data-prefill.name="<?php echo $data['prefill']['name'] ?>"
                            data-prefill.email="<?php echo $data['prefill']['email'] ?>"
                            data-prefill.contact="<?php echo $data['prefill']['contact'] ?>"
                            data-order_id="<?php echo $data['order_id'] ?>">

                            </script>
                    </form>

                    <div class="text-center p-3"> <a class="text-link " style="color: black;" href="index">Cancel</a>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <?php include('templates/_footer.php'); ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

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


</body>

</html>
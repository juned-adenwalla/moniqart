<?php include('templates/_header.php'); ?>

<!DOCTYPE html>
<html>

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


    <title>Payment Verification</title>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: white
        }

        .bg {
            background-color: white
        }

        .green {
            color: rgb(15, 207, 143);
            font-weight: 680
        }


        .payment {
            border: 1px solid #f2f2f2;
            height: 280px;
            border-radius: 20px;
            background: #fff;
        }

        .payment_header {
            padding: 20px;
            border-radius: 20px 20px 0px 0px;

        }

        .check {
            margin: 0px auto;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            background: #fff;
            text-align: center;
        }

        .check i {
            vertical-align: middle;
            line-height: 50px;
            font-size: 30px;
        }

        .content {
            text-align: center;
        }

        .content h1 {
            font-size: 25px;
            padding-top: 25px;
        }

        .content a {
            width: 200px;
            height: 35px;
            color: #fff;
            border-radius: 30px;
            padding: 5px 20px;
            transition: all ease-in-out 0.3s;
        }

        .content a:hover {
            text-decoration: none;
            background: #000;
        }
    </style>

</head>

<body>

    <div class="container my-5">

        <?php

        require('razorpay-php/Razorpay.php');
        use Razorpay\Api\Api;
        use Razorpay\Api\Errors\SignatureVerificationError;

        $keyId = 'rzp_test_J52EK80lRu54qe';
        $keySecret = 'm6hb2ug6l6uffeWieSnSKCC6';

        $success = true;
        $error = "Payment Failed";
        $transcationId = "noid";


        if (empty($_POST['razorpay_payment_id']) === false) {
            $api = new Api($keyId, $keySecret);

            $transcationId = $_POST['razorpay_payment_id'];

            try {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );


                $api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
        if ($success === true) {

            $amount = $_SESSION['amount'];
            $currency = $_SESSION['currency'];
            $coupon = $_SESSION['coupon'];
            $prod = $_SESSION['prod'];
            $prodid = $_SESSION['prodid'];
            $status = "success";

            _payment($amount,$transcationId, $currency, $coupon, $status, $prod, $prodid);
            ?>
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="payment shadow-lg">
                        <div class="payment_header bg-success">
                            <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
                        </div>
                        <div class="content px-2">
                            <h1>Payment Success !</h1>
                            <p> Transcation Id : <span>
                                    <?php echo $transcationId ?>
                            </p></span>
                            <a href="index" class="text-decoration-none bg-success">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {

            $amount = $_SESSION['amount'];
            $currency = $_SESSION['currency'];
            $coupon = $_SESSION['coupon'];
            $prod = $_SESSION['prod'];
            $prodid = $_SESSION['prodid'];
            $status = "failed";

            _payment($amount, $currency, $coupon, $status, $prod, $prodid);
            ?>
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="payment">
                        <div class="payment_header bg-danger ">
                            <div class="check"><i class="fa-solid fa-triangle-exclamation"></i></div>
                        </div>
                        <div class="content px-2">
                            <h1>Payment Failed</h1>
                            <p>Sorry Your Payment Failed !!!!</p>
                            <a href="index" class="text-decoration-none bg-danger">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>


    <?php include('templates/_footer.php'); ?>


</body>

</html>
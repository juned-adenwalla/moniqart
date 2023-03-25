<?php

//Navbar

function _allcurrency(){
    require('_config.php');
    $sql = "SELECT * FROM `tblcurrency` WHERE `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {?>
            <option value="<?php echo $data['_conversioncurrency']; ?>"><?php echo $data['_conversioncurrency']; ?></option>
        <?php }
    }
}

function _siteconfig($param)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblsiteconfig`";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}

function base_url($url)
{
    require('_config.php');
    return "$base_url" . $url;
}


// All Courses Page
function _allCoursesForAllCoursesPage()
{
    require('_config.php');

    $sql = "SELECT * FROM `tblcourse` ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            
            $courseName = strip_tags($data['_coursename']);
            $description = strip_tags($data['_coursedescription']);

            ?>

            <div class="card">

                <div class="card__image">
                    <img src="https://virtuoso.qodeinteractive.com/wp-content/uploads/2015/10/p-print-web-800x600.jpg" alt="">
                </div>

                <div class="card__content">

                    <div class="card__top">
                        <div class="card__title">
                            <span>
                                <?php
                                if (strlen($courseName) > 10) {
                                    echo substr($courseName, 0, 15) . "...";
                                } else {
                                    echo $courseName;
                                }

                                ?>
                            </span>
                        </div>

                        <div class="cards__marks">
                            <button class="card__button">
                                <i class="bx bx-heart"></i>
                            </button>
                            <a href="checkout?id=<?php echo $data['_id'] ?>"
                                style="display: flex; justify-content: center; align-items: center; " class="card__button">
                                <i class="bx bx-cart-add"></i>
                            </a>
                        </div>
                    </div>

                    <div class="card__description">
                        <p>
                            <?php
                            if (strlen($description) > 100) {
                                echo substr($description, 0, 100) . "...";
                            } else {
                                echo $description;
                            }

                            ?>
                        </p>
                    </div>

                </div>
            </div>


        <?php }
    }
}


function _getAllMarkupsForCheckout()
{
    require('_config.php');

    $sql = "SELECT * FROM `tbltaxes` WHERE  `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            ?>
            <div class="d-flex">
                <div class="col-8">
                    <?php echo $data['_taxname'] ?> :
                </div>
                <div class="ml-auto price " style="color: #1c1d1f;font-weight: 400;"  >
                    + ₹<?php echo $data['_taxamount'] ?>
                </div>
            </div>
        <?php }
    }
}



function _gettotal($sub, $currency, $discount)
{
    require('_config.php');
    $sql = "SELECT * FROM `tbltaxes` WHERE `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $tax = array();
        foreach ($query as $data) {
            if ($data['_taxtype'] == 'Variable') {
                $tax[] = ($data['_taxamount'] / 100) * $sub;
            } else {
                $tax[] = _conversion($data['_taxamount'], $currency);
            }
        }

        $final = $sub - $discount; // if not put it in else

        $arrtotal = $final + array_sum($tax);
        if ($arrtotal < 0) {
            $arrtotal = 0;
        }
        return $arrtotal;
    }
}

function _getSingleCourse($id, $param)
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcourse` WHERE `_id`='$id' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}

function _getsingleuser($id, $param)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblusers` WHERE `_id` = $id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}


function _conversion($amount, $currency)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblcurrency` WHERE `_conversioncurrency` = '$currency'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            $price = $data['_price'];
        }
        return $amount * $price;
    }
}



function _validatecoupon($amount, $coupon, $currency, $prod)
{
    require('_config.php');
    require('_alert.php');
    $sql = "SELECT * FROM `tblcoupon` WHERE `_couponname` = '$coupon'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $count = mysqli_num_rows($query);
        if ($count >= 1) {
            foreach ($query as $data) {
                $vamount = $data['_conamount'];
                $vcondition = $data['_couponcondition'];
                $vlimit = $data['_maxusage'];
                $vusage = $data['_totaluse'];
                $vdiscount = $data['_couponamount'];
                $coupontype = $data['_coupontype'];
                $couponprod = $data['_couponprod'];
            }
            $vamount = _conversion($vamount, $currency);
            if ($prod == $couponprod) {
                if ($vusage < $vlimit) {
                    if ($vcondition == 'less') {
                        if ($amount < $vamount) {
                            if ($coupontype == 'Variable') {
                                $discount = ($vdiscount / 100) * $amount;
                                return $discount;
                            }
                            if ($coupontype == 'Fixed') {
                                $discount = _conversion($vdiscount, $currency);
                                return $discount;
                            }
                            if ($coupontype == 'Uncertain') {
                                $numbers = range(0, $vdiscount);
                                shuffle($numbers);
                                $famount = array_slice($numbers, 0, 1);
                                $discount = _conversion($famount[0], $currency);
                                return $discount;
                            }
                        } else {
                            return null;
                        }
                    }
                    if ($vcondition == 'more') {
                        if ($amount >= $vamount) {
                            if ($coupontype == 'Variable') {
                                $discount = ($vdiscount / 100) * $amount;
                                return $discount;
                            }
                            if ($coupontype == 'Fixed') {
                                $discount = _conversion($vdiscount, $currency);
                                return $discount;
                            }
                            if ($coupontype == 'Uncertain') {
                                $numbers = range(30, $vdiscount);
                                shuffle($numbers);
                                $famount = array_slice($numbers, 0, 1);
                                $discount = _conversion($famount[0], $currency);
                                return $discount;
                            }
                        } else {
                            return null;
                        }
                    }
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}


function checkmembership($amount, $currency)
{
    require('_config.php');
    $useremail = $_SESSION['userEmailId'];
    $sql = "SELECT * FROM `tblusers` WHERE `_useremail` = '$useremail'";
    $query = mysqli_query($conn, $sql);
    foreach ($query as $data) {
        $membership = $data['_usermembership'];
    }
    if ($membership) {
        $sql = "SELECT * FROM `tblmembership` WHERE `_id` = $membership";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            foreach ($query as $data) {
                $type = $data['_benefittype'];
                $benifit = $data['_benefit'];
            }
            if ($type == 'Variable') {
                $discount = ($benifit / 100) * $amount;
                return $discount;
            } else {
                return _conversion($benifit, $currency);
            }
        }
    } else {
        return false;
    }
}


function _paymentconfig($param)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblpaymentconfig`";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}



?>
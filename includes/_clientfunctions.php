<?php

//Navbar

function _allcurrency()
{

    $baseCurrency = $_SESSION['baseCurrency'];

    require('_config.php');
    $sql = "SELECT * FROM `tblcurrency` WHERE `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) { ?>
            <option <?php if ($baseCurrency == $data['_conversioncurrency'])
                echo "selected"; ?>
                value="<?php echo $data['_conversioncurrency']; ?>">
                <?php echo $data['_conversioncurrency']; ?></option>
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

    $currency = _siteconfig('_sitecurrency');
    ;

    $sql = "SELECT * FROM `tbltaxes` WHERE  `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            ?>
            <div class="d-flex">
                <div class="col-8">
                    <?php echo $data['_taxname'] ?> :
                </div>

                <?php if ($data['_taxtype'] == 'Variable') { ?>
                    <div class="ml-auto price " style="color: #1c1d1f;font-weight: 400;">
                        + ₹
                        <?php echo $data['_taxamount'] ?>%
                    </div>
                <?php } else {
                    ?>
                    <div class="ml-auto price " style="color: #1c1d1f;font-weight: 400;">
                        +
                        <?php echo $currency ?>&nbsp;
                        <?php echo $data['_taxamount']; ?>
                    </div>

                <?php } ?>

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


function _updateProfile($username, $useremail, $userphone, $userage, $userbio, $location, $userpin, $country, $usercurrency)
{
    require('_config.php');
    require('_alert.php');
    $email = $_SESSION['userEmailId'];
    $phone = $_SESSION['userPhoneNo'];
    $id = $_SESSION['userId'];


    if ($phone != $userphone && $email != $useremail) {
        $sql = "SELECT * FROM `tblusers` WHERE`_useremail` = '$useremail' AND `_userphone` = '$userphone'";
        $run = true;
    }
    if ($phone != $userphone) {
        $sql = "SELECT * FROM `tblusers` WHERE `_userphone` = '$userphone'";
        $run = true;
    }
    if ($email != $useremail) {
        $sql = "SELECT * FROM `tblusers` WHERE `_useremail` = '$useremail'";
        $run = true;
    }
    if ($phone == $userphone && $email == $useremail) {
        $run = false;
    }

    if ($run) {
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $count = mysqli_num_rows($query);
            if ($count > 0) {
                $alert = new PHPAlert();
                $alert->warn("Credential Already in use");
            } else {

                $sql = "UPDATE `tblusers` SET `_username`='$username',`_useremail`='$useremail',`_userphone`='$userphone',`_userbio`='$userbio',`_userage`='$userage',`_userlocation`='$location',`_userstate`='$country',`_userpin`='$userpin',`_usercurrency`='$usercurrency' WHERE `_id` = $id";

                $query = mysqli_query($conn, $sql);
                if ($query) {
                    $alert = new PHPAlert();
                    $alert->success("Profile Updated");
                    $_SESSION['userEmailId'] = $useremail;
                    $_SESSION['userPhoneNo'] = $userphone;
                } else {
                    $alert = new PHPAlert();
                    $alert->warn("Something went wrong");
                }
            }
        }
    } else {
        $sql = "UPDATE `tblusers` SET `_username`='$username',`_userbio`='$userbio',`_userage`='$userage',`_userlocation`='$location',`_userstate`='$country',`_userpin`='$userpin',`_usercurrency`='$usercurrency' WHERE `_id` = $id";

        $query = mysqli_query($conn, $sql);
        if ($query) {
            $alert = new PHPAlert();
            $alert->success("Profile Updated");
        } else {
            $alert = new PHPAlert();
            $alert->warn("Something went wrong");
        }
    }

}


function updatePassword($oldpassword, $newpassword, $confirmnewpassword)
{
    require('_config.php');
    require('_alert.php');


    $password = $_SESSION['userPassword'];
    $id = $_SESSION['userId'];


    if ($newpassword == $confirmnewpassword) {


        $encolpassword = md5($oldpassword);

        if ($password == $encolpassword) {

            $enc_password = md5($confirmnewpassword);

            $sql = "UPDATE `tblusers` SET `_userpassword`='$enc_password' WHERE `_id` = $id";

            $query = mysqli_query($conn, $sql);
            if ($query) {
                $alert = new PHPAlert();
                $alert->success("Password Updated");
            } else {
                $alert = new PHPAlert();
                $alert->warn("Something went wrong");
            }


        } else {
            $alert = new PHPAlert();
            $alert->warn("Old Password is Wrong");
        }


    } else {
        $alert = new PHPAlert();
        $alert->warn("Confirm Password Does not Match with New Password");
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


// Home Page Functions 

function _showLatestCourses($limit)
{
    require('_config.php');

    $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` DESC  LIMIT  $limit ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $courseName = $data['_coursename'];
            $coursePrice = $data['_pricing'];
            $courseImg = $data['_thumbnail'];

            $currency = $_SESSION['baseCurrency'];

            $c = _conversion($coursePrice, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)


                ?>
            <a href="course?id=<?php echo $data['_id'] ?>" style="text-decoration: none;"
                class="courses__card position-relative col-lg-3 col-md-12 col-12  p-0   mb-md-3 mb-sm-3 mb-3   ">

                <span style="--i:1;" class="line-clamp position-absolute top-0 start-0 m-0  badge bg-white text-dark  py-3 w-100">
                    <?php
                    echo strlen($courseName) > 30 ? substr($courseName, 0, 30) . "..." : $courseName
                        ?>
                </span>

                <div class="imgDiv">
                    <img src="./uploads/coursethumbnail/<?php echo $courseImg ?>" alt="">
                </div>

                <div class="content">
                    <div class="headingDiv">
                        <span class="text-dark">

                            <?php
                            echo $updateCurrency;
                            ?>
                        </span>
                        <button><i class="fa-regular fa-heart"></i></button>
                        <button><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
            </a>
            <?php
        }
    }
}






function _showLatestBlogs($limit)
{
    require('_config.php');

    $sql = "SELECT * FROM `tblblog` ORDER BY `CreationDate` DESC  LIMIT  $limit ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $title = $data['_blogtitle'];
            $date = $data['Creation_at_Date'];
            $desc = Strip_tags($data['_blogdesc']);
            $img = $data['_blogimg'];

            ?>
            <div class="blog__card col-lg-3 col-md-12 col-12  p-0   mb-md-3 mb-sm-3 mb-3">
                <div class="imgDiv">
                    <img src="./uploads/blogsPics/<?php echo $img ?>" alt="">
                </div>

                <div class="content">
                    <h4 style="--i:1;" class="line-clamp">
                        <?php echo $title ?>
                    </h4>
                    <p style="--i:3;" class="line-clamp">
                        <?php echo $desc ?>
                    </p>
                </div>

                <div class="date">
                    <span>
                        <i class="fa-regular fa-calendar-days"></i>
                        <?php echo $date ?>
                    </span>
                    <button><i class="fa-regular fa-heart"></i>5</button>
                    <button><i class="fa-sharp fa-solid fa-share-nodes"></i></button>
                </div>
            </div>
            <?php
        }
    }
}


function _showLatestProducts($limit)
{
    require('_config.php');

    $sql = "SELECT * FROM `tblproducts` ORDER BY `CreationDate` DESC  LIMIT  $limit ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $name = $data['_name'];
            $img = $data['_img'];
            $_price = $data['_price'];


            $currency = $_SESSION['baseCurrency'];

            $c = _conversion($_price, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)


                ?>
            <div class="courses__card position-relative col-lg-3 col-md-12 col-12  p-0   mb-md-3 mb-sm-3 mb-3 ">

                <span style="--i:1;" class="line-clamp position-absolute top-0 start-0  badge bg-white text-dark  py-3 w-100">
                    <?php
                    echo strlen($name) > 20 ? substr($name, 0, 20) . "..." : $name
                        ?>
                </span>

                <div class="imgDiv">
                    <img src="./uploads/productsPics/<?php echo $img; ?>" alt="">
                </div>

                <div class="content">
                    <div class="headingDiv">
                        <span>
                            <?php
                            echo $updateCurrency;
                            ?>
                        </span>
                        <button><i class="fa-regular fa-heart"></i></button>
                        <button><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}



function _showLatestMemberships($limit)
{
    require('_config.php');

    $sql = "SELECT * FROM `tblmembership` ORDER BY `CreationDate` DESC  LIMIT  $limit ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $title = $data['_membershipname'];
            $desc = $data['_membershipdesc'];

            ?>
            <div class="courses__card col-lg-3 col-md-12 col-12  p-0   my-md-5 my-5  subscriptionCard">
                <div class="imgDiv d-flex flex-column align-items-center justify-content-center ">
                    <h3>
                        <?php echo $title ?>
                    </h3>
                    <p>
                        <?php echo $desc ?>
                    </p>
                </div>
                <div class="circle">

                </div>
                <button>
                    Purchase
                </button>
            </div>

            <?php
        }
    }
}


// All Courses Page


function _showMoreCourses($coursename, $filter, $limit, $startfrom)
{
    require('_config.php');

    if ($coursename != '') {
        $sql = "SELECT * FROM `tblcourse` where `_coursename` LIKE '%$coursename%' ";
    } else if ($filter != '') {

        if ($filter == 'new') {
            $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` DESC  LIMIT $startfrom,  $limit ";
        } else if ($filter == 'old') {
            $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` ASC  LIMIT $startfrom,  $limit ";
        } else if ($filter == 'highprice') {
            $sql = "SELECT * FROM `tblcourse` ORDER BY `_pricing` DESC  LIMIT $startfrom,  $limit ";
        } else if ($filter == 'lowprice') {
            $sql = "SELECT * FROM `tblcourse` ORDER BY `_pricing` ASC  LIMIT $startfrom,  $limit ";
        }

    } else {
        $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` DESC  LIMIT $startfrom,  $limit ";
    }

    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $courseName = $data['_coursename'];
            $coursePrice = $data['_pricing'];
            $courseImg = $data['_thumbnail'];

            $currency = $_SESSION['baseCurrency'];

            $c = _conversion($coursePrice, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)


                ?>
            <a href="course?id=<?php echo $data['_id'] ?>" style="text-decoration: none;"
                class=" courses__card position-relative col-lg-3 col-md-12 col-12  p-0 mx-2 my-3   ">

                <span style="--i:1;" class="line-clamp position-absolute top-0 start-0 m-0  badge bg-white text-dark  py-3 w-100">
                    <?php
                    echo strlen($courseName) > 30 ? substr($courseName, 0, 30) . "..." : $courseName
                        ?>
                </span>

                <div class="imgDiv">
                    <img src="./uploads/coursethumbnail/<?php echo $courseImg ?>" alt="">
                </div>

                <div class="content">
                    <div class="headingDiv">
                        <span class="text-dark">

                            <?php
                            echo $updateCurrency;
                            ?>
                        </span>
                        <button><i class="fa-regular fa-heart"></i></button>
                        <button><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
            </a>
            <?php
        }
    }
}

function _getNoOfPagesForCourses($record_per_page, $page)
{

    require('_config.php');

    $query = mysqli_query($conn, "SELECT * FROM `tblcourse`");
    $total_records = mysqli_num_rows($query);
    $total_pages = ceil($total_records / $record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;

    for ($i = 1; $i <= $total_pages; $i++) {
        echo "
        <li class='page-item'>
            <a class='page-link' style='color:#b92929;' href='all-courses?page=" . $i . "'>$i</a>
        </li>";
    }

}

// Home Page 

function _getHomePageDetails($param)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblhomepagesettings`";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}

// Contact Page 

function _addContactToDb($username, $useremail, $usermessage)
{

    require('_config.php');

    $stmt = $conn->prepare("INSERT INTO `tblcontact` (`_name`,`_email`, `_message`) VALUES (?, ?, ?)");

    $stmt->bind_param("sss", $username, $useremail, $usermessage);

    if ($stmt->execute()) {
        $_SESSION['success'] = true;
        // header("location:");
    }

    $stmt->close();
    $conn->close();

}


// About Us Page

function _getFaqsForAboutPage()
{

    require('_config.php');

    $sql = "SELECT * FROM `tblfaqs` ORDER BY `CreationDate` DESC   ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            ?>

            <div class="accordion rounded my-3 border -item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse<?php echo $data['_id']; ?>" aria-expanded="true"
                        aria-controls="collapse<?php echo $data['_id']; ?>">
                        <?php echo $data['_question'] ?>
                    </button>
                </h2>
                <div id="collapse<?php echo $data['_id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php echo $data['_answer'] ?>
                    </div>
                </div>
            </div>

            <?php

        }
    }
}


function _getPagesDescription($page)
{
    require('_config.php');

    $sql = "SELECT * FROM `tblpagesettings` where `_id`=00000000000000000001   ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {
            echo $data[$page];
        }
    }
}


// Course Page

function _getCourseProducts($courseid)
{

    require('_config.php');

    $sql = "SELECT * FROM `tblcourseproducts` where `_courseid`='$courseid'  ORDER BY `CreationDate` DESC   ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            $name = $data['_name'];
            $price = $data['_price'];
            $img = $data['_img'];

            $currency = $_SESSION['baseCurrency'];

            $c = _conversion($price, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)


                ?>

            <div class="courses__card  position-relative col-lg-4 col-md-12 p-0 mx-2 my-3 ">

                <span class="position-absolute top-0 start-0  badge bg-white text-dark  py-3 w-100">
                    <?php echo $name ?>
                </span>

                <div class="imgDiv">
                    <img src="uploads/courseproducts/<?php echo $img ?>" alt="">
                </div>

                <div class="content">
                    <div class="headingDiv">
                        <span>
                            <?php echo $updateCurrency ?>
                        </span>
                        <button><i class="fa-regular fa-heart"></i></button>
                        <button><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>

            <?php

        }
    }

}


function _getLessonPlans($id)
{

    require('_config.php');

    $sql = "SELECT * FROM `tbllessons` where `_courseid`='$id'  ORDER BY `CreationDate` DESC   ";
    $query = mysqli_query($conn, $sql);

    if ($query) {

        foreach ($query as $data) {

            ?>

            <div class="col-12">
                <div class="accordion rounded my-3 border -item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button text-dark bg-white" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse<?php echo $data['_id']; ?>" aria-expanded="true"
                            aria-controls="collapse<?php echo $data['_id']; ?>">
                            <?php echo $data['_lessonname'] ?>
                        </button>
                    </h2>
                    <?php

                    $desc = $data['_lessondescription'];

                    if ($desc != '') {
                        ?>
                        <div id="collapse<?php echo $data['_id']; ?>" class="accordion-collapse collapse text-dark bg-white"
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <?php echo $data['_lessondescription'] ?>
                            </div>
                        </div>
                        <?php
                    }



                    ?>
                </div>
            </div>

            <?php

        }
    }
}


// my account 




function _getTranscations()
{


    require('_config.php');

    $useremail = $_SESSION['userEmailId'];

    $sql = "SELECT * FROM `tblpayment` WHERE `_useremail` LIKE '%$useremail%' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {

        $count = mysqli_num_rows($query);

        if ($count >= 1) {

            foreach ($query as $data) {
                ?>
                <tr style="margin-bottom:-25px">
                    <td>
                        <?php echo $data['_razorpayid']; ?>
                    </td>
                    <td>
                        <?php echo $data['_amount']; ?>
                    </td>
                    <td>
                        <?php echo $data['_currency']; ?>
                    </td>

                    <td>
                        <div class="custom-control custom-switch">
                            <?php

                            $status = $data['_status'];
                            if ($status == 'success') {
                                ?>
                                <span class="text-success  fw-bold">success</span>
                                <?php
                            } else {
                                ?>
                                <span class="text-danger  fw-bold">failed</span>
                                <?php
                            }
                            ?>
                        </div>
                    </td>

                    <td>
                        <?php
                        $coupon = $data['_couponcode'];
                        if ($coupon == '') {
                            echo "Not Applicable";
                        } else {
                            echo $coupon;
                        }
                        ?>
                    </td>

                </tr>
                <?php
            } ?> <br>
            <?php
        } else {
            ?>
            <td></td>
            <td></td>
            <td class="text-danger">No Record Found!!</td>
            <td></td>
            <td></td>
            <?php
        }

    }
}



function _allcourses()
{
    $userid = $_SESSION['userId'];
    require('_config.php');
    $sql = "SELECT * FROM `tblmycourses` WHERE `_userid` = '$userid' AND `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {

            $text = _getSingleCourse($data['_courseid'], '_coursename');
            $price = _getSingleCourse($data['_courseid'], '_pricing');
            $courseId = $data['_courseid'];

            $currency = $_SESSION['baseCurrency'];
            $c = _conversion($price, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)

                ?>

            <div class="row mt-3">
                <div class="col-6  text-decoration-none ">
                    <div class="d-flex flex-row align-items-center
                justify-content-start">
                        <img src="./uploads/coursethumbnail/<?php echo _getSingleCourse($courseId, '_thumbnail'); ?>"
                            style="width: 200px;" />

                        <div class="d-flex flex-column ms-2">
                            <h4 class="fs-6 mx-2">
                                <a class="text-dark text-decoration-none "
                                    href="course-lesson?id=<?php echo $data['_courseid']; ?>">
                                    <?php echo strlen($text) > 58 ? substr($text, 0, 58) . "..." : $text ?>
                                </a>
                            </h4>
                            <p class="text-dark">
                                <?php echo $updateCurrency; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
    }
}

// Login Function

function _login($userpassword, $useremail)
{
    require('_config.php');
    require('_alert.php');
    if ($userpassword && $useremail != '') {
        $enc_password = md5($userpassword);
        $sql = "SELECT * FROM `tblusers` WHERE `_userstatus` = 'true' AND `_userpassword` = '$enc_password' AND `_useremail` = '$useremail' OR `_userphone` = '$useremail'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $count = mysqli_num_rows($query);
            if ($count >= 1) {
                foreach ($query as $data) {
                    $usertype = $data['_usertype'];
                    $userverify = $data['_userverify'];
                    $userid = $data['_id'];
                    $useremail = $data['_useremail'];
                    $userphone = $data['_userphone'];
                    $userpass = $data['_userpassword'];
                }
                $_SESSION['isLoggedIn'] = true;
                $_SESSION['userEmailId'] = $useremail;
                $_SESSION['userPhoneNo'] = $userphone;
                $_SESSION['userPassword'] = $userpass;
                $_SESSION['userType'] = $usertype;
                $_SESSION['userVerify'] = $userverify;
                $_SESSION['userId'] = $userid;
                $alert = new PHPAlert();
                $alert->success("Login Successfull");
                echo "<script>";
                echo "window.location.href = 'myaccount'";
                echo "</script>";
            } else {
                $alert = new PHPAlert();
                $alert->warn("Login Failed");
            }
        } else {
            $alert = new PHPAlert();
            $alert->warn("Something Went Wrong");
        }
    } else {
        $alert = new PHPAlert();
        $alert->warn("All Feilds are Required");
    }
}

function _updatedb($newfile)
{
    require('_config.php');
    require('_alert.php');
    $id = $_SESSION['userId'];
    $sql = "UPDATE `tblusers` SET `_userdp`='$newfile' WHERE `_id` = $id";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        $alert = new PHPAlert();
        $alert->success("Profile Updated");
    } else {
        $alert = new PHPAlert();
        $alert->warn("Something went wrong");
    }
}

function _getPageInformation($pageName)
{
    require('_config.php');
    $sql = "SELECT * FROM `tblpagesettings` WHERE `_id` = 1 ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$pageName];
        }
    }
}


// Course and Lesson Plans

function _getSingleCourseByPermalink($link, $param)
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcourse` WHERE `_parmalink`='$link' ";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            return $data[$param];
        }
    }
}


function _getLessonPlansForCourse($courseId)
{
    require('_config.php');
    $sql = "SELECT * FROM `tbllessons` where `_courseid`='$courseId'  ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        foreach ($query as $data) {

            $lessonid = $data['_id'];
            $lessonname = $data['_lessonname'];

            ?>
            <div class="px-4 mb-4 flex lg:px-8  py-2 bg-white rounded-3 shadow bg-body ">
                <p style="cursor: pointer;" id="l-<?php echo $lessonid ?>"
                    class="lessonCard m-0 text-dark fs-5 d-block text-decoration-none ">
                    <?php echo $lessonname ?>
                </p>
            </div>
            <?php
        }
    }

}


function _getTeacherCourses($teacherid)
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcourse` WHERE `_teacheremailid` = '$teacherid' AND `_status` = 'true'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {

            $text = _getSingleCourse($data['_id'], '_coursename');
            $price = _getSingleCourse($data['_id'], '_pricing');
            $courseId = $data['_id'];

            $currency = $_SESSION['baseCurrency'];
            $c = _conversion($price, $currency);

            $fmt = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
            $updateCurrency = $fmt->formatCurrency($c, $currency)

                ?>
            <div class="row mt-3">
                <div class="col-6  text-decoration-none ">
                    <div class="d-flex flex-row align-items-center
                justify-content-start">
                        <img src="./uploads/coursethumbnail/<?php echo _getSingleCourse($courseId, '_thumbnail'); ?>"
                            style="width: 200px;" />

                        <div class="d-flex flex-column ms-2">
                            <h4 class="fs-6 mx-2">
                                <a class="text-dark text-decoration-none " href="course-lesson?id=<?php echo $data['_id']; ?>">
                                    <?php echo strlen($text) > 58 ? substr($text, 0, 58) . "..." : $text ?>
                                </a>
                            </h4>
                            <p class="text-dark">
                                <?php echo $updateCurrency; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
}

function _getTodaysLesson($teacherid)
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcourse` WHERE `_teacheremailid` = '$teacherid' AND `_status` = 'true'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        foreach ($query as $data) {

            $courseid = $data['_id'];
            $sql2 = "SELECT * FROM `tbllessons` WHERE `_courseid` = '$courseid' AND `_status` = 'true'";
            $query2 = mysqli_query($conn, $sql2);

            if ($query2) {
                foreach ($query2 as $data) {

                    $lessonType = $data['_lessontype'];
                    $lessonname = $data['_lessonname'];
                    $lessonurl = $data['_lessonurl'];

                    $lessonDate = $data['_lessondate'];
                    $lessonTime = $data['_lessontime'];

                    $timezone = _siteconfig('_timezone');
                    date_default_timezone_set($timezone);

                    $currentDate = date("Y-m-d");

                    $exacttime = date('h:i a', strtotime($lessonTime));

                    $exactdate = date('D d-M-Y', strtotime($lessonDate));

                    if ($lessonType == "Live") {
                        if ($lessonDate === $currentDate) {
                            ?>
                            <div class="mb-3 text-decoration-none col-12 d-flex flex-row align-items-center justify-content-between shadow ">
                                <div class="d-flex flex-row align-items-center ">
                                    <div>
                                        <i class="fa-solid fa-calendar-days fs-4 me-3 text-dark"></i>
                                    </div>

                                    <div class="ms-2">
                                        <p class="text-dark fs-6 m-0">
                                            <?php echo $lessonname ?>
                                        </p>
                                        <p class="text-dark fs-6 m-0"><span>
                                                <?php echo $exacttime ?>
                                                &nbsp;
                                                <?php echo $exactdate ?>
                                            </span></p>
                                    </div>
                                </div>

                                <a href="<?php echo $lessonurl ?>" target="_blank" class="text-white rounded-circle  p-2 fs-6 text-decoration-none"
                                    style="background: #b92929;">
                                    <i class="fa-solid fa-link"></i>
                                </a>

                            </div>

                            <?php
                        }
                    }

                }
            }

        }
    }

}


// Forgot Password

function _forgetpass($userphone)
{
    require('_config.php');
    require('_alert.php');

    $userpass = rand(11111111, 99999999);
    $enc_pass = md5($userpass);
    $sql = "SELECT * FROM `tblusers` WHERE `_userphone` = '$userphone'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $sql = "UPDATE `tblusers` SET `_userpassword`='$enc_pass' WHERE `_userphone` = '$userphone'";
        $query = mysqli_query($conn, $sql);
        if ($query) {
            $subject = 'Password Changed';
            $message = "Password : $userpass (Your New Password)";
            _notifyuser('', $userphone, '', $message, '');
            $alert = new PHPAlert();
            $alert->success("Password sent to registered mobile number");
            echo "<script>";
            echo "window.location.href = 'signin'";
            echo "</script>";
        }
    } else {
        $alert = new PHPAlert();
        $alert->warn("Incorrect Credentials");
    }
}

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function _notifyuser($useremail = '', $userphone = '', $sendmail = '', $message = '', $subject = '')
{
    require('_config.php');
    if ($userphone != '') {
        $sql = "SELECT * FROM `tblsmsconfig` WHERE `_supplierstatus` = 'true'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            foreach ($query as $data) {
                $baseurl = $data['_baseurl'];
                $apikey = $data['_apikey'];
            }

            $fields = array(
                "message" => $message,
                "sender_id" => "FSTSMS",
                "language" => "english",
                "route" => "v3",
                "numbers" => $userphone,
            );

            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => $baseurl,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($fields),
                    CURLOPT_HTTPHEADER => array(
                        "authorization: $apikey",
                        "accept: */*",
                        "cache-control: no-cache",
                        "content-type: application/json"
                    ),
                )
            );

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                $alert = new PHPAlert();
                $alert->warn("SMS not sent");
            } else {
                $_SESSION['template_success'] = true;
            }
        }
    }
    if ($useremail != '') {
        $sql = "SELECT * FROM `tblemailconfig` WHERE `_supplierstatus` = 'true'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if ($count == 1) {
            $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);

            require_once "$rootDir/moniqart/moniqart/vendor/autoload.php";
            $mail = new PHPMailer(true); //Argument true in constructor enables exceptions
            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            foreach ($query as $data) {
                //Enable SMTP debugging.
                // $mail->SMTPDebug = 10;                                       
                //Set SMTP host name                          
                $mail->Host = $data['_hostname'];
                //Set this to true if SMTP host requires authentication to send email
                $mail->SMTPAuth = $data['_smtpauth'];
                //Provide username and password     
                $mail->Username = $data['_emailaddress'];
                $mail->Password = $data['_emailpassword'];
                //If SMTP requires TLS encryption then set it
                $mail->SMTPSecure = "ssl";
                //Set TCP port to connect to
                $mail->Port = $data['_hostport'];

                $mail->From = $data['_emailaddress'];
                $mail->FromName = $data['_sendername'];
                //Address to which recipient will reply
                $mail->addReplyTo($data['_emailaddress'], "Reply");
            }
            //To address and namS
            $mail->addAddress($useremail); //Recipient name is optional

            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $sendmail;
            $mail->IsHTML(true);
            if ($mail->send()) {
                $_SESSION['send_mail'] = true;
            } else {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }
    }
}


function _usetemplate($template, $data)
{
    foreach ($data as $key => $value) {
        $template = str_replace('{{ ' . $key . ' }}', $value, $template);
    }

    return $template;
}

function _verifyotp($verifyotp)
{
    require('_alert.php');
    require('_config.php');
    $useremail = $_SESSION['userEmailId'];
    $sql = "SELECT * FROM `tblusers` WHERE `_useremail` = '$useremail'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        foreach ($query as $data) {
            $otp = $data['_userotp'];
        }
        if ($verifyotp == $otp) {
            $sql = "UPDATE `tblusers` SET `_userverify` = 'true' WHERE `_useremail` = '$useremail'";
            $query = mysqli_query($conn, $sql);
            if ($query) {
                $_SESSION['signup_success'] = true;
                $sql = "SELECT * FROM `tblemailtemplates`";
                $query = mysqli_query($conn, $sql);
                foreach ($query as $data) {
                    $template = $data['_signuptemplate'];
                }
                $variables = array();
                $variables['name'] = $_SESSION['temp_username'];
                $variables['companyname'] = _siteconfig('_sitetitle');
                $sendmail = _usetemplate($template, $variables);
                $subject = "Account Created Successfully";
                $userphone = $_SESSION['temp_phone'];
                $message = 'Thank you for creating account with ' . _siteconfig('_sitetitle') . '. Kindy Login to Continue';
                _notifyuser($useremail, $userphone, $sendmail, $message, $subject);
                echo "<script>";
                echo "window.location.href = 'signin'";
                echo "</script>";
            } else {
                $alert = new PHPAlert();
                $alert->warn("Something Went Wrong");
            }
        } else {
            $alert = new PHPAlert();
            $alert->warn("Verification Failed");
        }
    }
}



// Checkout

function _purchaseCourse($courseid)
{
    $userid = $_SESSION['userId'];

    require('_config.php');
    $sql = "INSERT INTO `tblmycourses`(`_courseid`,`_userid`, `_coursestatus`, `_status`) VALUES ('$courseid','$userid','started','true')";
    $query = mysqli_query($conn, $sql);

}

function _payment($amount, $transcationId, $currency, $coupon, $status, $prod, $prodid)
{
    if ($prod == 'ecommerce') {
        $prodname = _getSingleCourse($prodid, '_coursename');
    }

    $useremail = $_SESSION['userEmailId'];

    require('_config.php');
    $sql = "INSERT INTO `tblpayment`(`_useremail`,`_razorpayid`, `_amount`, `_currency`, `_status`, `_producttitle`, `_productid`, `_producttype`, `_couponcode`) VALUES ('$useremail','$transcationId','$amount','$currency','$status','$prodname', '$prodid', '$prod', '$coupon')";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        _purchaseCourse($prodid);
        return $conn->insert_id;
    }
}

// add course to mytbl


// header

function _getLatetsFourCoursesForHeader($id, $limit)
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcourse` WHERE `_categoryid` = '$id' ORDER BY `CreationDate` DESC LIMIT  $limit ";
    $query = mysqli_query($conn, $sql);


    $sql2 = "SELECT * FROM `tblcourse` WHERE `_categoryid` = '$id'  ";
    $query2 = mysqli_query($conn, $sql2);

    $courseCount = mysqli_num_rows($query2);

    if ($query) {
        $count = mysqli_num_rows($query);

        if ($count >= 1) {
            ?>
            <ul>

                <?php

                foreach ($query as $data) {

                    $name = $data['_coursename'];
                     $desc = $data['_coursedescription'];

                    $courseImg = $data['_thumbnail'];
                    ?>
                    <li>

                        <a href="course?id=<?php echo $data['_id'] ?>" target="_blank" class="d-flex flex-row">
                            <img src="./uploads/coursethumbnail/<?php echo $courseImg ?>"
                                style="width: 50px; height: 50px; border-radius: 5px;" alt="">

                            <div style="padding-left: 4px;" >
                                <h5 style="margin: 0; padding: 0; font-size: 17px;">
                                    <?php echo substr($name, 0, 15);
                                    echo "..." ?>
                                </h5>
                                <p style="margin: 0; margin-top: 4px;  padding: 0; font-size: 12px;">
                                    <?php echo substr(strip_tags($desc), 0, 30);
                                    echo "..." ?>
                                </p>
                            </div>

                        </a>

                    </li>
                    <?php


                }
                ?>

                <?php
                if ($courseCount > 4) {
                    ?>
                    <a href="all-courses" target="_blank" style="background: #b92929; border: none;" class="btn btn-dark text-light ">View All</a>
                    <?php
                }
                ?>

            </ul>
            <?php
        }

    }

}



function _getLatestCoursesCategory()
{

    require('_config.php');
    $sql = "SELECT * FROM `tblcategory` WHERE `_categorytype` = 'courses' ORDER BY `CreationDate` DESC  ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        foreach ($query as $data) {

            $categoryId = $data['_id'];
            $categoryName = $data['_categoryname'];

            ?>
            <li>

                <a href="#">
                    <?php echo substr($categoryName, 0, 13);
                    echo "..." ?>
                    <i class="fa-solid fa-chevron-down ms-2"></i>
                </a>

                <?php
                _getLatetsFourCoursesForHeader($categoryId, 4);
                ?>


            </li>
            <?php

        }
    }


}


?>
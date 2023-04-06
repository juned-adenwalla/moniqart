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
                value="<?php echo $data['_conversioncurrency']; ?>"><?php echo $data['_conversioncurrency']; ?></option>
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
                <div class="ml-auto price " style="color: #1c1d1f;font-weight: 400;">
                    + ₹
                    <?php echo $data['_taxamount'] ?>
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
            <div class="courses__card position-relative col-lg-3 col-md-12 col-12  p-0   mb-md-3 mb-sm-3 mb-3   ">

                <span style="--i:1;" class="line-clamp position-absolute top-0 start-0 m-0  badge bg-white text-dark  py-3 w-100">
                    <?php
                    echo $courseName;
                    ?>
                </span>

                <div class="imgDiv">
                    <img src="./uploads/coursethumbnail/<?php echo $courseImg ?>" alt="">
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
                    echo $name;
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


function _showMoreCourses($coursename,$filter,$limit, $startfrom)
{
    require('_config.php');

    if($coursename != ''){
        $sql = "SELECT * FROM `tblcourse` where `_coursename` LIKE '%$coursename%' ";
    }
    else if($filter != ''){

        if($filter == 'new'){
            $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` DESC  LIMIT $startfrom,  $limit ";
        }
        else if($filter == 'old'){
            $sql = "SELECT * FROM `tblcourse` ORDER BY `CreationDate` ASC  LIMIT $startfrom,  $limit ";
        }
        else if($filter == 'highprice'){
            $sql = "SELECT * FROM `tblcourse` ORDER BY `_pricing` DESC  LIMIT $startfrom,  $limit ";
        }
        else if($filter == 'lowprice'){
            $sql = "SELECT * FROM `tblcourse` ORDER BY `_pricing` ASC  LIMIT $startfrom,  $limit ";
        }

    }
    else{
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
            <div class="courses__card position-relative col-lg-3 col-md-12 col-12  p-0 mx-2 my-3   ">

                <span style="--i:1;" class="line-clamp position-absolute top-0 start-0 m-0  badge bg-white text-dark  py-3 w-100">
                    <?php
                    echo $courseName;
                    ?>
                </span>

                <div class="imgDiv">
                    <img src="./uploads/coursethumbnail/<?php echo $courseImg ?>" alt="">
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
        header("location:");
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


// Single Course Page



?>
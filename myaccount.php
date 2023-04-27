<?php include('templates/_header.php'); ?>

<?php

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    echo "<script>";
    echo "window.location.href = 'signin'";
    echo "</script>";
} else {
}

$userid = $_SESSION['userId'];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userphone = $_POST['userphone'];
    $userage = $_POST['userage'];
    $userbio = $_POST['userbio'];
    $location = $_POST['location'];
    $pincode = $_POST['pincode'];
    $country = $_POST['country'];
    $usercurrency = $_POST['usercurrency'];
    _updateProfile($username, $useremail, $userphone, $userage, $userbio, $location, $pincode, $country, $usercurrency);
}

if (isset($_POST['updatePassword'])) {
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmnewpassword = $_POST['confirmnewpassword'];
    updatePassword($oldpassword, $newpassword, $confirmnewpassword);
}


if (isset($_POST['update'])) {
    if ($_FILES["userimg"]["name"] != '') {
        $file = $_FILES["userimg"]["name"];
        $extension = substr($file, strlen($file) - 4, strlen($file));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");
        // Validation for allowed extensions .in_array() function searches an array for a specific value.
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $newfile = md5($file) . $extension;
            move_uploaded_file($_FILES["userimg"]["tmp_name"], "./uploads/profile/" . $newfile);
            _updatedb($newfile);
        }
    }
}

?>
<!DOCTYPE html>
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



    <title>My Account</title>

</head>

<body>



    <section class="py-3 my-5 ">
        <div class="container">
            <h1 class="mb-3 fs-6 ">Account Settings</h1>
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <form action="" method="post" enctype="multipart/form-data"
                            class="img-circle text-center mb-3  position-relative ">

                            <?php
                            $userDp = _getsingleuser($userid, '_userdp');
                            if ($userDp) { ?>
                                <img class="img-account-profile rounded-circle mb-2" src="<?php
                                $img = _getsingleuser($userid, '_userdp');
                                echo base_url("uploads/profile/$img")
                                    ?>" alt="">
                            <?php } else { ?>
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                            <?php } ?>

                            <label style="top: -10px;cursor: pointer ;"
                                class="bg-white p-1 rounded-circle position-absolute start-50 translate-middle-x "
                                for="userimg">
                                <i class="fa-solid fa-plus"></i>
                            </label>

                            <input type="file" name="userimg" id="userimg" style="display: none;"
                                onchange="updateImg(this)">
                            <button style="display: none; " type="submit" id="updateBtn" name="update"></button>
                        </form>
                        <h4 class="text-center">
                            <?php echo _getsingleuser($userid, '_username') ?>
                        </h4>
                        <h6 class="text-center">
                            <?php echo _getsingleuser($userid, '_useremail') ?>
                        </h6>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="fa-solid fa-user"></i>
                            Account
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                            aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i>
                            Security
                        </a>
                        <a class="nav-link" id="courses-tab" data-toggle="pill" href="#courses" role="tab"
                            aria-controls="courses" aria-selected="false">
                            <i class="fa-solid fa-graduation-cap"></i>
                            My Courses
                        </a>
                        <a class="nav-link" id="orders-tab" data-toggle="pill" href="#orders" role="tab"
                            aria-controls="orders" aria-selected="false">
                            <i class="fa-solid fa-receipt"></i>
                            My Orders
                        </a>
                        <a class="nav-link" id="transcations-tab" data-toggle="pill" href="#transcations" role="tab"
                            aria-controls="transcations" aria-selected="false">
                            <i class="fa-solid fa-money-check-dollar"></i>
                            Transactions
                        </a>

                        <?php
                        $userType = _getsingleuser($userid, '_usertype');
                        if ($userType == 1) {
                            ?>
                            <a class="nav-link" id="instructor-tab" data-toggle="pill" href="#instructor" role="tab"
                                aria-controls="instructor" aria-selected="false">
                                <i class="fa-solid fa-person-chalkboard"></i>
                                Instructor
                            </a>
                            <?php
                        }
                        ?>



                    </div>
                </div>
                <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                    <form action="#" method="post" class="tab-pane fade show active" id="account" role="tabpanel"
                        aria-labelledby="account-tab">
                        <h3 class="mb-4">Account Settings</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" class="form-control" name="username"
                                        value="<?php echo _getsingleuser($userid, '_username') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="useremail"
                                        value="<?php echo _getsingleuser($userid, '_useremail') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="number" class="form-control" name="userphone"
                                        value="<?php echo _getsingleuser($userid, '_userphone') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="location"
                                        value="<?php echo _getsingleuser($userid, '_userlocation') ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    <input type="number" class="form-control" name="pincode"
                                        value="<?php echo _getsingleuser($userid, '_userpin') ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="inputLocation">Country</label>
                                        <select name="country" name="country" class="form-control">
                                            <?php

                                            $country = _getsingleuser($userid, '_userstate');

                                            if ($country != null) {
                                                ?>
                                                <option selected
                                                    value="<?php echo _getsingleuser($userid, '_userstate') ?>">
                                                    <?php echo _getsingleuser($userid, '_userstate') ?>
                                                </option>
                                                <?php
                                            } else {
                                                ?>
                                                <option value="">Choose Country</option>

                                                <?php
                                            }
                                            ?>

                                            </option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Åland Islands">Åland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda
                                            </option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and
                                                Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British
                                                Indian Ocean Territory</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam
                                            </option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African
                                                Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island
                                            </option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling)
                                                Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, The Democratic Republic of The">
                                                Congo, The Democratic Republic of The</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic
                                            </option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea
                                            </option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland
                                                Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia
                                            </option>
                                            <option value="French Southern Territories">French
                                                Southern Territories</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-bissau">Guinea-bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and Mcdonald Islands">Heard
                                                Island and Mcdonald Islands</option>
                                            <option value="Holy See (Vatican City State)">Holy See
                                                (Vatican City State)</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran, Islamic Republic of">Iran, Islamic
                                                Republic of</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea, Democratic People's Republic of">
                                                Korea, Democratic People's Republic of</option>
                                            <option value="Korea, Republic of">Korea, Republic of
                                            </option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao People's Democratic Republic">Lao
                                                People's Democratic Republic</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab
                                                Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia, The Former Yugoslav Republic of">
                                                Macedonia, The Former Yugoslav Republic of</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands
                                            </option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia, Federated States of">
                                                Micronesia, Federated States of</option>
                                            <option value="Moldova, Republic of">Moldova, Republic
                                                of</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands
                                                Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern
                                                Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">
                                                Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea
                                            </option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation
                                            </option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts and Nevis">Saint Kitts and
                                                Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre
                                                and Miquelon</option>
                                            <option value="Saint Vincent and The Grenadines">Saint
                                                Vincent and The Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and
                                                Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and The South Sandwich Islands">
                                                South Georgia and The South Sandwich Islands
                                            </option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan
                                                Mayen</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab
                                                Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania, United Republic of">Tanzania,
                                                United Republic of</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Timor-leste">Timor-leste</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago
                                            </option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and
                                                Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab
                                                Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">
                                                United States Minor Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Viet Nam">Viet Nam</option>
                                            <option value="Virgin Islands, British">Virgin Islands,
                                                British</option>
                                            <option value="Virgin Islands, U.S.">Virgin Islands,
                                                U.S.</option>
                                            <option value="Wallis and Futuna">Wallis and Futuna
                                            </option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="inputEmail4" class="form-label">Base Currency</label>
                                <select name="usercurrency" class="form-control">
                                    <?php

                                    $currency = _getsingleuser($userid, '_usercurrency');

                                    if ($currency != null) {
                                        ?>
                                        <option selected value="<?php echo _getsingleuser($userid, '_usercurrency') ?>">
                                            <?php echo _getsingleuser($userid, '_usercurrency') ?>
                                        </option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="">Choose Currency</option>

                                        <?php
                                    }
                                    ?>
                                    <option value="USD">America (United States) Dollars – USD</option>
                                    <option value="AFN">Afghanistan Afghanis – AFN</option>
                                    <option value="ALL">Albania Leke – ALL</option>
                                    <option value="DZD">Algeria Dinars – DZD</option>
                                    <option value="ARS">Argentina Pesos – ARS</option>
                                    <option value="AUD">Australia Dollars – AUD</option>
                                    <option value="ATS">Austria Schillings – ATS</OPTION>

                                    <option value="BSD">Bahamas Dollars – BSD</option>
                                    <option value="BHD">Bahrain Dinars – BHD</option>
                                    <option value="BDT">Bangladesh Taka – BDT</option>
                                    <option value="BBD">Barbados Dollars – BBD</option>
                                    <option value="BEF">Belgium Francs – BEF</OPTION>
                                    <option value="BMD">Bermuda Dollars – BMD</option>

                                    <option value="BRL">Brazil Reais – BRL</option>
                                    <option value="BGN">Bulgaria Leva – BGN</option>
                                    <option value="CAD">Canada Dollars – CAD</option>
                                    <option value="XOF">CFA BCEAO Francs – XOF</option>
                                    <option value="XAF">CFA BEAC Francs – XAF</option>
                                    <option value="CLP">Chile Pesos – CLP</option>

                                    <option value="CNY">China Yuan Renminbi – CNY</option>
                                    <option value="CNY">RMB (China Yuan Renminbi) – CNY</option>
                                    <option value="COP">Colombia Pesos – COP</option>
                                    <option value="XPF">CFP Francs – XPF</option>
                                    <option value="CRC">Costa Rica Colones – CRC</option>
                                    <option value="HRK">Croatia Kuna – HRK</option>

                                    <option value="CYP">Cyprus Pounds – CYP</option>
                                    <option value="CZK">Czech Republic Koruny – CZK</option>
                                    <option value="DKK">Denmark Kroner – DKK</option>
                                    <option value="DEM">Deutsche (Germany) Marks – DEM</OPTION>
                                    <option value="DOP">Dominican Republic Pesos – DOP</option>
                                    <option value="NLG">Dutch (Netherlands) Guilders – NLG</OPTION>

                                    <option value="XCD">Eastern Caribbean Dollars – XCD</option>
                                    <option value="EGP">Egypt Pounds – EGP</option>
                                    <option value="EEK">Estonia Krooni – EEK</option>
                                    <option value="EUR">Euro – EUR</option>
                                    <option value="FJD">Fiji Dollars – FJD</option>
                                    <option value="FIM">Finland Markkaa – FIM</OPTION>

                                    <option value="FRF*">France Francs – FRF*</OPTION>
                                    <option value="DEM">Germany Deutsche Marks – DEM</OPTION>
                                    <option value="XAU">Gold Ounces – XAU</option>
                                    <option value="GRD">Greece Drachmae – GRD</OPTION>
                                    <option value="GTQ">Guatemalan Quetzal – GTQ</OPTION>
                                    <option value="NLG">Holland (Netherlands) Guilders – NLG</OPTION>
                                    <option value="HKD">Hong Kong Dollars – HKD</option>

                                    <option value="HUF">Hungary Forint – HUF</option>
                                    <option value="ISK">Iceland Kronur – ISK</option>
                                    <option value="XDR">IMF Special Drawing Right – XDR</option>
                                    <option value="INR">India Rupees – INR</option>
                                    <option value="IDR">Indonesia Rupiahs – IDR</option>
                                    <option value="IRR">Iran Rials – IRR</option>

                                    <option value="IQD">Iraq Dinars – IQD</option>
                                    <option value="IEP*">Ireland Pounds – IEP*</OPTION>
                                    <option value="ILS">Israel New Shekels – ILS</option>
                                    <option value="ITL*">Italy Lire – ITL*</OPTION>
                                    <option value="JMD">Jamaica Dollars – JMD</option>
                                    <option value="JPY">Japan Yen – JPY</option>

                                    <option value="JOD">Jordan Dinars – JOD</option>
                                    <option value="KES">Kenya Shillings – KES</option>
                                    <option value="KRW">Korea (South) Won – KRW</option>
                                    <option value="KWD">Kuwait Dinars – KWD</option>
                                    <option value="LBP">Lebanon Pounds – LBP</option>
                                    <option value="LUF">Luxembourg Francs – LUF</OPTION>

                                    <option value="MYR">Malaysia Ringgits – MYR</option>
                                    <option value="MTL">Malta Liri – MTL</option>
                                    <option value="MUR">Mauritius Rupees – MUR</option>
                                    <option value="MXN">Mexico Pesos – MXN</option>
                                    <option value="MAD">Morocco Dirhams – MAD</option>
                                    <option value="NLG">Netherlands Guilders – NLG</OPTION>

                                    <option value="NZD">New Zealand Dollars – NZD</option>
                                    <option value="NOK">Norway Kroner – NOK</option>
                                    <option value="OMR">Oman Rials – OMR</option>
                                    <option value="PKR">Pakistan Rupees – PKR</option>
                                    <option value="XPD">Palladium Ounces – XPD</option>
                                    <option value="PEN">Peru Nuevos Soles – PEN</option>

                                    <option value="PHP">Philippines Pesos – PHP</option>
                                    <option value="XPT">Platinum Ounces – XPT</option>
                                    <option value="PLN">Poland Zlotych – PLN</option>
                                    <option value="PTE">Portugal Escudos – PTE</OPTION>
                                    <option value="QAR">Qatar Riyals – QAR</option>
                                    <option value="RON">Romania New Lei – RON</option>

                                    <option value="ROL">Romania Lei – ROL</option>
                                    <option value="RUB">Russia Rubles – RUB</option>
                                    <option value="SAR">Saudi Arabia Riyals – SAR</option>
                                    <option value="XAG">Silver Ounces – XAG</option>
                                    <option value="SGD">Singapore Dollars – SGD</option>
                                    <option value="SKK">Slovakia Koruny – SKK</option>

                                    <option value="SIT">Slovenia Tolars – SIT</option>
                                    <option value="ZAR">South Africa Rand – ZAR</option>
                                    <option value="KRW">South Korea Won – KRW</option>
                                    <option value="ESP">Spain Pesetas – ESP</OPTION>
                                    <option value="XDR">Special Drawing Rights (IMF) – XDR</option>
                                    <option value="LKR">Sri Lanka Rupees – LKR</option>

                                    <option value="SDD">Sudan Dinars – SDD</option>
                                    <option value="SEK">Sweden Kronor – SEK</option>
                                    <option value="CHF">Switzerland Francs – CHF</option>
                                    <option value="TWD">Taiwan New Dollars – TWD</option>
                                    <option value="THB">Thailand Baht – THB</option>
                                    <option value="TTD">Trinidad and Tobago Dollars – TTD</option>

                                    <option value="TND">Tunisia Dinars – TND</option>
                                    <option value="TRY">Turkey New Lira – TRY</option>
                                    <option value="AED">United Arab Emirates Dirhams – AED</option>
                                    <option value="GBP">United Kingdom Pounds – GBP</option>
                                    <option value="USD">United States Dollars – USD</option>
                                    <option value="VEB">Venezuela Bolivares – VEB</option>

                                    <option value="VND">Vietnam Dong – VND</option>
                                    <option value="ZMK">Zambia Kwacha – ZMK</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Birth Date</label>
                                    <input type="date" name="userage" class="form-control"
                                        value="<?php echo _getsingleuser($userid, '_userage') ?>" id="userage">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bio</label>
                                    <textarea class="form-control" name="userbio"
                                        rows="4"><?php echo _getsingleuser($userid, '_userbio') ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn redBtn" name="submit" type="submit">Update</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>

                    <form action="#" method="post" class="tab-pane fade" id="password" role="tabpanel"
                        aria-labelledby="password-tab">
                        <h3 class="mb-4">Password Settings</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Old password</label>
                                    <input type="password" name="oldpassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>New password</label>
                                    <input type="password" name="newpassword" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input type="password" name="confirmnewpassword" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn redBtn" name="updatePassword" type="submit">Update</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>

                    <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <h3 class="mb-4">My Courses</h3>
                        <?php _allcourses(); ?>
                    </div>
                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                        <h3 class="mb-4">My Orders</h3>

                    </div>
                    <div class="tab-pane fade" id="transcations" role="tabpanel" aria-labelledby="transcations-tab">
                        <h3 class="mb-4">Transactions</h3>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display table expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Amount</th>
                                                <th>Currency</th>
                                                <th>Status</th>
                                                <th>Coupon Code</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider" style="text-align: left;margin-left: 30px">
                                            <tr>
                                                <?php echo _getTranscations() ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $userType = _getsingleuser($userid, '_usertype');
                    if ($userType == 1) {
                        ?>
                        <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                            <div class="bg-white  rounded-lg d-flex flex-column ">
                                <div class="profile-tab-nav border-right">
                                    <div class="nav flex-row nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="tab_1-tab" data-toggle="pill" href="#tab_1"
                                            role="tab" aria-controls="tab_1" aria-selected="true">
                                            <i class="fa-solid fa-chalkboard-user"></i>
                                            My Courses
                                        </a>
                                        <a class="nav-link" id="tab_2-tab" data-toggle="pill" href="#tab_2" role="tab"
                                            aria-controls="tab_2" aria-selected="false">
                                            <i class="fa-solid fa-school"></i>
                                            My Lectures
                                        </a>
                                    </div>
                                </div>
                                <div class="tab-content py-4 px-0 " id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                        aria-labelledby="tab_1-tab">
                                        <h3 class="mb-4">Your Courses</h3>
                                            <?php
                                            echo _getTeacherCourses($userid);
                                            ?>

                                    </div>

                                    <div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2-tab">
                                        <h3 class="mb-4">Lectures</h3>

                                        <div class="row">
                                            <?php
                                            echo _getTodaysLesson($userid);
                                            ?>


                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

    <?php include('templates/_footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


    <script>

        const updateImg = (ele) => {
            console.log(ele.files[0]);
            document.getElementById('updateBtn').click();
        }

    </script>

</body>

</html>
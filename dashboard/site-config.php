<?php

session_start();

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    echo "<script>";
    echo "window.location.href = 'login'";
    echo "</script>";
} else {
    if ($_SESSION['userVerify'] != 'true') {
        echo "<script>";
        echo "window.location.href = 'verify'";
        echo "</script>";
    }
}

if (isset($_SESSION['forgot_success']) || !isset($_SESSION['forgot_success'])) {
    $_SESSION['forgot_success'] = false;
}

require('../includes/_functions.php');
require('../includes/_config.php');



if (isset($_POST['submit'])) {
    $sitetitle = $_POST['sitetitle'];
    $siteemail = $_POST['siteemail'];
    $sitephone = $_POST['sitephone'];
    $sitecurrency = $_POST['sitecurrency'];
    $timezone = $_POST['timezone'];
    $header = $_POST['header'];
    $footer = $_POST['footer'];
    $css = $_POST['css'];
    $logonewfile = null;
    $reslogonewfile = null;
    $faviconnewfile = null;
    if ($_FILES["logo"]["name"] != '') {
        $logofile = $_FILES["logo"]["name"];
        $extension = substr($logofile, strlen($logofile) - 4, strlen($logofile));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".webp", ".svg");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $logonewfile = md5($logofile) . $extension;
            move_uploaded_file($_FILES["logo"]["tmp_name"], "../uploads/images/" . $logonewfile);
        }
    }
    if ($_FILES["reslogo"]["name"] != '') {
        $reslogofile = $_FILES["reslogo"]["name"];
        $extension = substr($reslogofile, strlen($reslogofile) - 4, strlen($reslogofile));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".svg");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $reslogonewfile = md5($reslogofile) . $extension;
            move_uploaded_file($_FILES["reslogo"]["tmp_name"], "../uploads/images/" . $reslogonewfile);
        }
    }
    if ($_FILES["favicon"]["name"] != '') {
        $faviconfile = $_FILES["favicon"]["name"];
        $extension = substr($faviconfile, strlen($faviconfile) - 4, strlen($faviconfile));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif", ".svg");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
        } else {
            $faviconnewfile = md5($faviconfile) . $extension;
            move_uploaded_file($_FILES["favicon"]["tmp_name"], "../uploads/images/" . $faviconnewfile);
        }
    }
    _savesiteconfig($sitetitle, $siteemail, $sitephone, $sitecurrency, $timezone, $header, $footer, $css, $logonewfile, $reslogonewfile, $faviconnewfile);
}


$record_per_page = 5;
$page = '';
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$start_from = ($page - 1) * $record_per_page;



if (isset($_POST['addSocialMedia'])) {

    $_name = $_POST['name'];
    $_url = $_POST['url'];
    $_indexing = $_POST['indexing'];

    _createSocialMedia($_name, $_url, $_indexing);

}


if (isset($_GET['del'])) {

    $menuid = $_GET['id'];

    _deleteSocialMedia($menuid);
}


if (isset($_POST['editSocialMedia'])) {

    $_id = $_POST['socialmediaid'];
    $_name = $_POST['name'];
    $_url = $_POST['url'];
    $_indexing = $_POST['indexing'];

    _updateSocialMedia($_id, $_name, $_url, $_indexing);

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Site Config |
        <?php echo _siteconfig('_sitetitle'); ?>
    </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/feather/feather.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <?php include('templates/_header.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <?php include('templates/_sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?php if ($_SESSION['forgot_success']) { ?>
                        <div id="liveAlertPlaceholder">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Message Sent!</strong> message sent successfully.
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Site Configuration (Base Setting)</h4>
                                <p class="card-description">
                                    Site settings are the settings for a specific website within your Site. If you'd
                                    like to change settings for your Site overall, navigate to the Settings tab in the
                                    control panel.
                                    From site settings, you’ll be able to configure the default settings, edit your
                                    footer, add header and background images, and more.
                                </p>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col">
                                            <label for="formFile" class="form-label">Site Title</label>
                                            <input type="text" class="form-control" placeholder="Site Title"
                                                aria-label="site title" value="<?php echo _siteconfig('_sitetitle'); ?>"
                                                name="sitetitle" required>
                                        </div>
                                        <div class="col">
                                            <label for="formFile" class="form-label">Site Email</label>
                                            <input type="email" class="form-control" placeholder="Site Email"
                                                aria-label="site email" value="<?php echo _siteconfig('_siteemail'); ?>"
                                                name="siteemail" required>
                                        </div>

                                        <div class="col">
                                            <label for="sitephone" class="form-label">Site Phone</label>
                                            <input type="text" class="form-control" placeholder="Site Phone"
                                                aria-label="Site Phone" value="<?php echo _siteconfig('_sitephone'); ?>"
                                                name="sitephone" required>
                                        </div>
                                        <div class="col">
                                                <label class="form-label">Site Currency</label>
                                                <select name="sitecurrency" class="form-control">
                                                    <option  disabled >Select currency</option>
                                                    
                                                    <option selected value="<?php echo _siteconfig('_sitecurrency'); ?>"><?php echo _siteconfig('_sitecurrency'); ?></option>

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
                                    </div>

                                    <div class="row g-3" style="margin-top: 20px;">
                                        <div class="col">
                                            <label for="formFile" class="form-label">Select Timezone</label>
                                            <select class="form-control form-control-lg" name="timezone">
                                                <option>Select Timezone</option>
                                                <option value="<?php echo _siteconfig('_timezone'); ?>" selected>
                                                    <?php echo _siteconfig('_timezone'); ?></option>
                                                <option value="Etc/GMT+12">(GMT-12:00) International Date Line West
                                                </option>
                                                <option value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                                                <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                                <option value="US/Alaska">(GMT-09:00) Alaska</option>
                                                <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &
                                                    Canada)</option>
                                                <option value="America/Tijuana">(GMT-08:00) Tijuana, Baja California
                                                </option>
                                                <option value="US/Arizona">(GMT-07:00) Arizona</option>
                                                <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz,
                                                    Mazatlan</option>
                                                <option value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)
                                                </option>
                                                <option value="America/Managua">(GMT-06:00) Central America</option>
                                                <option value="US/Central">(GMT-06:00) Central Time (US & Canada)
                                                </option>
                                                <option value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico
                                                    City, Monterrey</option>
                                                <option value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                                                <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio
                                                    Branco</option>
                                                <option value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)
                                                </option>
                                                <option value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                                                <option value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)
                                                </option>
                                                <option value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                                                <option value="America/Manaus">(GMT-04:00) Manaus</option>
                                                <option value="America/Santiago">(GMT-04:00) Santiago</option>
                                                <option value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                                                <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                                                <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires,
                                                    Georgetown</option>
                                                <option value="America/Godthab">(GMT-03:00) Greenland</option>
                                                <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                                                <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                                                <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                                                <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                                                <option value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia,
                                                    Reykjavik</option>
                                                <option value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin,
                                                    Edinburgh, Lisbon, London</option>
                                                <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern,
                                                    Rome, Stockholm, Vienna</option>
                                                <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava,
                                                    Budapest, Ljubljana, Prague</option>
                                                <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen,
                                                    Madrid, Paris</option>
                                                <option value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw,
                                                    Zagreb</option>
                                                <option value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                                                <option value="Asia/Amman">(GMT+02:00) Amman</option>
                                                <option value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul
                                                </option>
                                                <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                                                <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                                                <option value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                                                <option value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia,
                                                    Tallinn, Vilnius</option>
                                                <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                                                <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                                                <option value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                                                <option value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                                                <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg,
                                                    Volgograd</option>
                                                <option value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                                                <option value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                                                <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                                                <option value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                                                <option value="Asia/Baku">(GMT+04:00) Baku</option>
                                                <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                                                <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                                                <option value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                                                <option value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent
                                                </option>
                                                <option value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New
                                                    Delhi</option>
                                                <option value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                                                <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                                                <option value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                                                <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                                                <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                                                <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta
                                                </option>
                                                <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                                                <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong
                                                    Kong, Urumqi</option>
                                                <option value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore
                                                </option>
                                                <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                <option value="Australia/Perth">(GMT+08:00) Perth</option>
                                                <option value="Asia/Taipei">(GMT+08:00) Taipei</option>
                                                <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                                                <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                                                <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                                                <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                                                <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                                                <option value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne,
                                                    Sydney</option>
                                                <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                                                <option value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                                                <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                                                <option value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New
                                                    Caledonia</option>
                                                <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington
                                                </option>
                                                <option value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.
                                                </option>
                                                <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="formFile" class="form-label">Site Logo</label>
                                            <input class="form-control" name="logo" type="file" id="formFile">
                                            <img style="border: 2px solid #EFEFEF; margin-top: 10px; padding: 10px;border-radius: 12px; width: 280px; height: 100px"
                                                src="../uploads/images/<?php echo _siteconfig('_sitelogo'); ?>"
                                                alt="sitelogo">
                                        </div>
                                        <div class="col">
                                            <label for="formFile" class="form-label">Site Logo (Responsive)</label>
                                            <input class="form-control" name="reslogo" type="file" id="formFile">
                                            <img style="border: 2px solid #EFEFEF; margin-top: 10px; padding: 10px;border-radius: 12px; width: 180px; height: 100px"
                                                src="../uploads/images/<?php echo _siteconfig('_sitereslogo'); ?>"
                                                alt="sitelogo">
                                        </div>
                                        <div class="col">
                                            <label for="formFile" class="form-label">Site Favicon</label>
                                            <input class="form-control" name="favicon" type="file" id="formFile">
                                            <img style="border: 2px solid #EFEFEF; margin-top: 10px; padding: 10px;border-radius: 12px; width: 180px; height: 100px"
                                                src="../uploads/images/<?php echo _siteconfig('_favicon'); ?>"
                                                alt="sitelogo">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Site Configuration (Header Setting)</h4>
                                <p class="card-description">
                                    Site settings are the settings for a specific website within your Site. If you'd
                                    like to change settings for your Site overall, navigate to the Settings tab in the
                                    control panel.
                                    From site settings, you’ll be able to configure the default settings, edit your
                                    footer, add header and background images, and more.
                                </p>
                                <div class="row g-3" style="margin-top: 20px;">
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">Header Codes</label>
                                        <textarea class="form-control" name="header" id="exampleFormControlTextarea1"
                                            rows="6"><?php echo _siteconfig('_customheader'); ?></textarea>
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleFormControlTextarea1" class="form-label">Custom CSS</label>
                                        <textarea class="form-control" name="css" id="exampleFormControlTextarea1"
                                            rows="6"><?php echo _siteconfig('_customcss'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Site Configuration (Footer Setting)</h4>
                                <p class="card-description">
                                    Site settings are the settings for a specific website within your Site. If you'd
                                    like to change settings for your Site overall, navigate to the Settings tab in the
                                    control panel.
                                    From site settings, you’ll be able to configure the default settings, edit your
                                    footer, add header and background images, and more.
                                </p>
                                <div class="row g-3" style="margin-top: 20px;">
                                    <div class="col-12">
                                        <label for="exampleFormControlTextarea1" class="form-label">Footer Codes</label>
                                        <textarea class="form-control" name="footer" id="exampleFormControlTextarea1"
                                            rows="6"><?php echo _siteconfig('_customfooter'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-top: 30px;">
                                    <button type="submit" name="submit" style="width: 180px;margin-left: -10px"
                                        class="btn btn-primary"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save
                                        Settings</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">


                            <div class="card-body">
                                <h4 class="card-title">Manage Social Media
                                    <button type="button"
                                        class="btn btn-primary btn-sm font-weight-medium auth-form-btn"
                                        style="height:40px; float:right; " data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" style="width: 15px;"
                                            viewBox="0 0 448 512">
                                            <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                            <path
                                                d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                        </svg>&nbsp;&nbsp;Add Social Media
                                    </button>
                                </h4>
                                <p class="card-description">
                                    From here, you'll see a list of all the categories on your site. You can edit or
                                    delete them from here. You can also change the order of your categories by dragging
                                    and dropping them into the order you
                                </p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="display expandable-table" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Name</th>
                                                        <th>Indexing</th>
                                                        <th>Status</th>
                                                        <th>Created at</th>
                                                        <th>Updated at</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: left;margin-left: 30px">
                                                    <?php
                                                    _getSocialMedia($start_from, $record_per_page);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <nav aria-label="Page navigation example" style="margin-top: 10px;">
                                    <ul class="pagination">
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM `tblsocialmedia`");
                                        $total_records = mysqli_num_rows($query);
                                        $total_pages = ceil($total_records / $record_per_page);
                                        $start_loop = $page;
                                        $difference = $total_pages - $page;
                                        if ($difference <= 4) {
                                            $start_loop = $total_pages - 4;
                                        }
                                        $end_loop = $start_loop + 3;
                                        if ($page > 1) {
                                            echo "<li class='page-item'>
                        <a href='site-config&page=" . ($page - 1) . "' class='page-link'>Previous</a>
                      </li>";
                                        }
                                        if ($total_records > 5) {

                                            for ($i = 1; $i <= $total_pages; $i++) {
                                                echo "
                      <li class='page-item'><a class='page-link' href='site-config&page=" . $i . "'>$i</a></li>";
                                            }
                                        }
                                        if ($page <= $end_loop) {
                                            echo "<li class='page-item'>
                        <a class='page-link' href='site-config&page=" . ($page + 1) . "'>Next</a>
                      </li>";
                                        } ?>
                                    </ul>
                                </nav>
                            </div>


                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="editSocialMedia" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" id="editSocialMediaBody">

                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-content" style="padding: 10px;">
                                    <div class="modal-header"
                                        style="padding: 0px;margin-bottom: 20px;padding-bottom:10px">
                                        <h4 class="modal-title fs-5" id="exampleModalLabel">Add Social Media</h4>
                                        <button type="button" class="btn-close"
                                            style="border: none;;background-color:white" data-bs-dismiss="modal"
                                            aria-label="Close"><svg style="width: 15px;"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512">
                                                <!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) -->
                                                <path
                                                    d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
                                            </svg></button>
                                    </div>
                                    <div class="modal-body" style="padding: 0px;">

                                        <div class="row">

                                            <div class="col-lg-6">
                                                <label for="name" class="form-label">Social Media Name</label>
                                                <input type="text" id="name" name="name" class="form-control" required>
                                            </div>

                                            <div class="col-lg-6">
                                                <label for="url" class="form-label">Social Media URL</label>
                                                <input type="text" id="url" name="url" class="form-control" required>
                                            </div>

                                        </div>

                                        <div class="row" style="margin-top:20px;">



                                            <div class="col-lg-6">
                                                <label for="indexing" class="form-label">Social Media Indexing</label>
                                                <input type="text" id="indexing" name="indexing" class="form-control"
                                                    required>
                                            </div>


                                        </div>




                                    </div>
                                    <div class="modal-footer" style="padding: 0px;margin-top: 20px;padding-top:10px">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="addSocialMedia" class="btn btn-primary"><i
                                                class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>



                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <?php include('templates/_footer.php'); ?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <div class="container"></div>

        <script>
            const callEditSocialMedia = (socialmediaid) => {


                $.ajax({
                    type: "POST",
                    url: `editSocialMedia.php`,
                    data: {
                        "edit": true,
                        "socialmediaid": socialmediaid
                    },
                    success: function (data) {
                        $(`#editSocialMediaBody`).html(data);
                        $(`#editSocialMedia`).modal("show");
                    }
                });

            }
        </script>

</body>
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../assets/js/off-canvas.js"></script>
<script src="../assets/js/hoverable-collapse.js"></script>
<script src="../assets/js/template.js"></script>
<script src="../assets/js/settings.js"></script>
<script src="../assets/js/todolist.js"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

</html>
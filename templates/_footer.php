<?php

if (isset($_POST['submitfooter'])) {

    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $usermessage = $_POST['usermessage'];
    _addContactToDb($username, $useremail, $usermessage);


}
?>
<footer>


    <div class="container ">

        <div class="footer__top row px-lg-0 px-sm-2 pt-5">


            <div
                class="footer__list  col-lg-3 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-evenly ">
                <a href="#">
                    <img style="width: 150px;"
                        src="<?php echo base_url('uploads/images/' . _siteconfig('_sitelogo')); ?>" alt="">
                </a>
                <p class="pt-lg-0 pt-3">
                    At MONIQART, we cover a full-range of courses across all levels of creativity and education. We aim to inspire you no matter where you are with our online presence. Take a look at what we offer.
                </p>


                <span class="pt-lg-0 pt-3"> <i class="fa-solid fa-envelope-open"></i>
                    <?php echo _siteconfig('_siteemail'); ?>
                </span>
                <span class="pt-lg-0 pt-3"> <i class="fa-solid fa-phone"></i>
                    <?php echo _siteconfig('_sitephone'); ?>
                </span>
                <span class="pt-lg-0 pt-3"> <i class="fa-solid fa-location-dot"></i> Row house No 1, Jitender co-op society, Plot no 91, Sector 3, Koparkhairne, Navi Mumbai, Pin code- 400709 </span>
            </div>

            <div
                class="footer__list pt-5 col-lg-2 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-start">
                <h2>Quick Links</h2>

                <ul>
                    <li><a href="#">classes</a></li>
                    <li><a href="#">courses</a></li>
                    <li><a href="#">art therapy</a></li>
                </ul>

            </div>

            <div
                class="footer__list pt-5 col-lg-2 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-start">
                <h2>Important Links</h2>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Collabrate</a></li>
                    <li><a href="#">Faqs</a></li>
                    <li><a href="#">Terms of use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <div
                class="footer__list pt-5 col-lg-2 col-md-6 col-sm-12 d-flex flex-column align-items-start justify-content-start">
                <h2>Maps</h2>
                <div style="width: 100%"><iframe width="100%" height="200" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0" style="border-radius: 10px;"
                        src="https://www.google.com/maps/embed/v1/place?q=Moniqart+-+Art+Therapy+online+/+offline,+Sector+3,+Kopar+Khairane,+Navi+Mumbai,+Maharashtra,+India&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"><a
                            href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe></div>
            </div>

            <div
                class="footer__list pt-5 col-lg-3 col-md-6 col-sm-12 d-flex flex-column align-items-start justify-content-start">
                <h2>Contact Us</h2>

                <form action="#" method="post"
                    class="form w-100 d-flex flex-column align-items-start justify-content-start">
                    <input name="username" type="text" placeholder="Your Name*">
                    <input name="useremail" type="text" placeholder="Your Email Address*">
                    <textarea name="usermessage" id="comments" cols="30" rows="4" placeholder="comments*"></textarea>
                    <button type="submit" name="submitfooter" class="btn" style="border-radius: 0;">
                        Submit
                    </button>
                </form>

            </div>


        </div>

        <div class="footer__bottom row px-lg-0 px-sm-2 py-4">

            <div class="  col-lg-3 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-between ">
            </div>
            <div class="  col-lg-2 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-start">
            </div>
            <div class="  col-lg-2 col-md-4 col-sm-12 d-flex flex-column align-items-start justify-content-start">
            </div>
            <div class="  col-lg-2 col-md-6 col-sm-12 d-flex flex-column align-items-start justify-content-start">
            </div>

            <div
                class=" col-lg-3 col-md-6 col-sm-12 d-flex flex-row align-items-center justify-content-lg-between justify-content-start ">
                <p>
                    Follow us
                </p>
                <a class="m-lg-0 ms-3 " href="#">
                    <i class="fa-brands fa-facebook"></i>
                </a>
                <a class="m-lg-0 ms-3 " href="https://www.instagram.com/moniqart.in/">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a class="m-lg-0 ms-3 " href="#">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a class="m-lg-0 ms-3 " href="#">
                    <i class="fa-brands fa-snapchat"></i>
                </a>
            </div>
        </div>
    </div>


</footer>
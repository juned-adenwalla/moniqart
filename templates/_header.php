<?php

include('includes/_clientfunctions.php');

session_start();

if (!isset($_SESSION['baseCurrency']) || !$_SESSION['baseCurrency'] || $_SESSION['baseCurrency'] == '') {
  if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn'] || $_SESSION['isLoggedIn'] == '') {
    $_SESSION['baseCurrency'] = _siteconfig('_sitecurrency');
  } else {
    $userId = $_SESSION['userId'];
    $_SESSION['baseCurrency'] = _getsingleuser($userId, '_usercurrency');
  }
}

if (isset($_POST['currency'])) {
  $_SESSION['baseCurrency'] = $_POST['currency'];
}

if(isset($_POST['search'])){

  $name = $_POST['search'];

  header("location:all-courses?course=$name&search=true");
}

?>
<div class="topBarContainer">
  <div class="container">
    <div class="row" style="padding-top: 8px">
      <div class="col-10">
        <p><i class="fa-solid fa-phone"></i> <span>&nbsp;
            <?php echo _siteconfig('_sitephone'); ?>
          </span>&nbsp;&nbsp;&nbsp; <i class="fa-solid fa-envelope-open"></i>&nbsp;
          <?php echo _siteconfig('_siteemail'); ?>
        </p>
      </div>
      <div class="col-2">
        <form action="#" method="post">
          <select name="currency" id="currency" style="float:right" onchange="this.form.submit()">
            <?php
            _allcurrency();
            ?>
          </select>
        </form>
      </div>
    </div>
  </div>
</div>
  <nav class="customNavbar navbar navbar-dark navbar-expand-lg p-md-3">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="<?php echo base_url('uploads/images/' . _siteconfig('_sitelogo')); ?>"
          alt=""></a>
      <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-white "></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-white mx-2 " href="#">Classes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mx-2 " href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mx-2 " href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mx-2 " href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white mx-2 " href="#">Contact</a>
          </li>
        </ul>
        <form method="post" action="#" class="form-inline my-2 my-lg-0 ms-auto">
          <input class="form-control mr-sm-2 border-0 outline-0" style="box-shadow: none;font-size: 14px;"  type="search" placeholder="Search" name="search" aria-label="Search">
        </form>
      </div>
    </div>
  </nav>

<script type="text/javascript">
  var nav = document.querySelector('nav');

  window.addEventListener('scroll', function () {
    if (window.pageYOffset > 0) {
      nav.classList.add('bg-dark', 'shadow' , 'fixed-top');
      
    } else {
      nav.classList.remove('bg-dark', 'shadow', 'fixed-top');
    }
  });


  function onSelectChange() {
    document.getElementById('frm').submit();
  }
</script>
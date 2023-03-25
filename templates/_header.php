<?php include('includes/_clientfunctions.php'); ?>
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
        <select name="currency" id="currency" style="float:right">
          <?php _allcurrency(); ?>
        </select>
      </div>
    </div>
  </div>
</div>
<div class="navbar">
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="<?php echo base_url('uploads/images/' . _siteconfig('_sitelogo')); ?>"
          alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <div class="mx-auto"></div>
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
      </div>
    </div>
  </nav>
</div>

<script type="text/javascript">
    var nav = document.querySelector('nav');

    window.addEventListener('scroll', function () {
        if (window.pageYOffset > 0) {
            nav.classList.add('bg-dark', 'shadow');
            document.querySelector('nav').style.marginTop = "-10px";
            // document.querySelector('nav').style.display = "none";
        } else {
            nav.classList.remove('bg-dark', 'shadow');
            document.querySelector('nav').style.marginTop = "40px";
            // document.querySelector('nav').style.display = "block";
        }
    });
    function onSelectChange(){
      document.getElementById('frm').submit();
    }
</script>
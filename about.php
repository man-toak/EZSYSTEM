<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EZ SYSTEM</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/ez-1.png">
    <link href="vendor/aos/aos.css" rel="stylesheet">

    <!-- Stylesheet file -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>

  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
         <div class="navbar-header">
            <!-- Navbar Header--><a href="index.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Ez</strong><strong>System</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">E</strong><strong>Z</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom"> 

           <!-- START Login dropdown    -->
             <div class="list-inline-item dropdown"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="img/user.png" width="25px;" alt="English"><span class="d-none d-sm-inline-block">LOG IN</span></a>
              <div aria-labelledby="languages" class="dropdown-menu"><a rel="nofollow" href="login-admin.php" class="dropdown-item"> <img src="img/login-9.png" alt="English" class="mr-2"><span>Admin</span></a><a rel="nofollow" href="login-participant.php" class="dropdown-item"> <img src="img/login-9.png"  alt="English" class="mr-2"><span>Participant</span></a></div>
            </div>
            <!-- END Login dropdown    -->

          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class=""><img src="img/ez-2.png" alt="logo ez" class="img-fluid"></div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li><a href="index.php"> <i class="icon-home"></i>Home </a></li>
          <!--<li><a href="register-participant.php"> <i class="icon-user-1"></i>Register</a></li>-->
          <li class="active"><a href="about.php"> <i class="icon-info"></i>About</a></li>
          <li><a href="contact.php"> <i class="icon-contract"></i>Contact</a></li>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">About</h2>
          </div>
        </div>

        <center>
        <section class="no-padding-bottom">
          <div class="container-fluid">
              <div class="col-lg-5">
                <div class="user-block block text-center">
                  <div class="avatar"><img src="img/toak.jpg" alt="..." class="img-fluid">
                    <div class="order dashbg-3">VIP</div>
                  </div><a href="#" class="user-title">
                    <h3 class="h5">Muhammad Aiman</h3><span>@ManToak</span></a>
                  <div class="contributions">DEVELOPER</div>
                  <div class="details d-flex">
                    <div class="item"><i class="icon-info"></i><strong>150</strong></div>
                    <div class="item"><i class="fa fa-gg"></i><strong>340</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>460</strong></div>
                  </div>
                </div>
              </div>
          </div>
        </section>
        </center>

        <section class="no-padding-bottom">
        <div class="container-fluid">
        <div class="alert alert-dark col-lg-12" role="alert">
          <h4 class="alert-heading">Welcome to EZSYSTEM!</h4>
          <p>I develop this system to ease event organizer out there. This system will use the NFC tag and NFC reader during the event, to retrieve the attendance information, ease the organizer in monitoring the attendees’ and delivering the event resource to the attendees.</p>
          <hr>
          <p class="mb-0">To run this system, you are required to have 3 devices below:</p>
        </div>
        </div>
        </section>

        <center>
        <section class="no-padding-bottom">
        <div class="row">
          <div class="col-md-4">
            <div class="user-block block">
                <img src="img/device.jpg" alt="PC / Tablet / Smartphone" style="width:100%">
                <div class="caption">
                  <br><p>PC / Tablet / Smartphone</p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="user-block block">
                <img src="img/nfc.jpg" alt="NFC Tag / NFC Card" style="width:100%">
                <div class="caption">
                  <br><p>NFC Tag / NFC Card</p>
                </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="user-block block">
                <img src="img/nfc-reader.png" alt="NFC Reader" style="width:100%">
                <div class="caption">
                  <br><p>NFC Reader</p>
                </div>
            </div>
          </div>
        </div>
        </section>
        </center>

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2020 &copy; EZ SYSTEM. Design by <a href="https://youtube.com/c/mantoak/">Toak</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="js/front.js"></script>
    <script src="vendor/aos/aos.js"></script>
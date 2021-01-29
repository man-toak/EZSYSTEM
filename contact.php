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
          <li><a href="about.php"> <i class="icon-info"></i>About</a></li>
          <li class="active"><a href="contact.php"> <i class="icon-contract"></i>Contact</a></li>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Contact</h2>
          </div>
        </div>


          <section class="no-padding-bottom">
            <div class="container-fluid">
              <div class="block col-lg-12">
                <div class="user-block block text-center">
                  <h2>We are here to help you</h2>
                </div>
                <p class="lead">Are you curious about something? Do you have some kind of problem with our System? Give us some feedback. Your feedback maybe can make our system become more efficient. Thank You.</p>
                <p class="text-sm">We hope your event / conference goes well! :)</p>
              </div>
            </div>
          </section>
          <section>
            <div class="row text-center">
              <div class="col-md-4">
                <div class="user-block block">
                  <div class="icon-outlined"><i class="fa fa-map-marker"></i></div>
                  <h3 class="h4">Address</h3><br>
                  <p>Jalan Sunway 1/1,<br>Bandar Sunway Semenyih,<br>                                        Selangor,  <strong>Malaysia</strong></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="user-block block">
                  <div class="icon-outlined"><i class="fa fa-phone"></i></div>
                  <h3 class="h4">Call center</h3><br>
                  <p>This number is toll free if calling from Malaysia otherwise we advise you to use the electronic form of communication.</p>
                  <p><strong>+60 33988998</strong></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="user-block block">
                  <div class="icon-outlined"><i class="fa fa-envelope"></i></div>
                  <h3 class="h4">Electronic support</h3><br>
                  <p>Please feel free to write an email to us or to use our electronic ticketing system.</p>
                </div>
              </div>
            </div>
          </section>
          <div class="col-md-12">
          <section class="user-block block">
            <div class="row">
              <div class="col-md-12">
                <div class="heading text-center">
                  <h2>Contact form</h2>
                </div>
              </div>
              <div class="col-md-8 mx-auto">
                <form autocomplete="off">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input id="firstname" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input id="lastname" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="subject">Subject</label>
                        <input id="subject" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" class="form-control" required></textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-secondary"><i class="fa fa-envelope-o"></i> Send message</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </section>
        </div>
        
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
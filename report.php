<?php  
session_start();  
  
if(!$_SESSION['username'])  
{  
  
    header("Location: login-admin.php");//redirect to the login page to secure the welcome page without login access.  
}
?>
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
  
  <?php
    include 'dbconnect.php';
    $organizer=$_SESSION['username'];
    $dbhandle = new mysqli('localhost', 'root', '', 'fyp');
    echo $dbhandle-> connect_error;

    $query = "SELECT organizer, id AS percentage FROM events WHERE organizer='$organizer' ORDER BY percentage DESC";
    $res= $dbhandle-> query($query);
    ?>

  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
         <div class="navbar-header">
            <!-- Navbar Header--><a href="homepage-admin.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Ez</strong><strong>System</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">E</strong><strong>Z</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom"> 

           <!-- START Login dropdown    -->
           <div class="logout">
          <a href="#" data-toggle="modal" data-target="#logout-admin" class="login-btn"><i class="fa fa-sign-out"></i><span class="d-none d-md-inline-block"> Logout</span></a>
        </div>
            <!-- END Login dropdown    -->

          </div>
        </div>
      </nav>
      <!-- Logout admin start-->
      <div id="logout-admin" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Organizer Logout</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <center><div class="form-group"><br>
                <button type="submit" class="btn btn-outline-primary" name="login"><a href="logout.php" class="nav-link">Logout</a></button>
          </div></center>
      <br><h5><center>You are going to leave this system </center></h5>
            </div>
          </div>
        </div>
      </div>
      <!-- Logout admin end-->
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="img/user.png" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo $_SESSION['username']; ?></h1>
            <p>Organizer</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li><a href="homepage-admin.php"> <i class="icon-home"></i>Home </a></li>
          <li><a href="listparticipant.php"> <i class="icon-user-1"></i>Participant</a></li>
          <li><a href="listevent.php"> <i class="icon-writing-whiteboard"></i>Event</a></li>
          <li><a href="listresources.php"> <i class="icon-contract"></i>Resources</i></a></li>
          <li class="active"><a href="report.php"> <i class="icon-info"></i>Report</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header no-margin-bottom">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Reports</h2>
          </div>
        </div>

        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="homepage-admin.php">Home</a></li>
            <li class="breadcrumb-item active">Reports        </li>
          </ul>
        </div>
        <!--<div class="overlay" id="piechart" width="500px;"></div>-->
        <section>
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-8">
                <div class="line-chart block chart">
                  <div class="title"><strong>Line Chart 1</strong></div>
                  <canvas id="lineChartCustom1" ></canvas>
                </div>
              </div>
              <div class="col-lg-4">       
                <div class="lin-chart block chart">
                  <div class="title"><strong>Line Chart 2</strong></div>
                  <div class="line-chart chart margin-bottom-sm">
                    <canvas id="lineChartCustom2"></canvas>
                  </div>
                  <div class="line-chart chart">
                    <canvas id="lineChartCustom3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="chart block">
                  <div class="title"> <strong>Bar Chart 1</strong></div>
                  <div class="bar-chart chart margin-bottom-sm">
                    <canvas id="barChartCustom1"></canvas>
                  </div>
                  <div class="bar-chart chart">
                    <canvas id="barChartCustom2"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="bar-chart block chart">
                  <div class="title"><strong>Bar Chart 2</strong></div>
                  <div class="bar-chart chart">
                    <canvas id="barChartCustom3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="pie-chart chart block">
                  <div class="title"><strong>Pie Chart 1</strong></div>
                  <div class="pie-chart chart margin-bottom-sm">
                    <canvas id="pieChartCustom1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="doughnut-chart chart block">
                  <div class="title"><strong>Pie Chart 2</strong></div>
                  <div class="doughnut-chart chart margin-bottom-sm">
                    <canvas id="doughnutChartCustom1"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="polar-chart chart block">
                  <div class="title"><strong>Polar Chart</strong></div>
                  <div class="polar-chart chart margin-bottom-sm">
                    <canvas id="polarChartCustom"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="radar-chart chart block">
                  <div class="title"><strong>Radar Chart</strong></div>
                  <div class="radar-chart chart margin-bottom-sm">
                    <canvas id="radarChartCustom"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
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
    <script src="js/charts-custom.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>
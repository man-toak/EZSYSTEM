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
  <!-- css counter by toak -->
  <style>
  .counter
  {
      text-align: center;
  }

  .counter-count /* kena guna class="counter-count" dalam form */
  {
      font-size: 50px;
      font-weight: bold;
      position: relative;
      color: #000000;
      text-align: center;
      display: inline-block;
  }
  </style>
  <!-- end css counter by toak -->
  
    <?php 
    $username = $_SESSION['username'];
    include 'dbconnect.php';
    $query = "SELECT *
         FROM participant WHERE organizer='$username'";      
    $result = mysqli_query($conn, $query) or die('SQL error participant');
    //$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>

      <?php $participant=0;?>
      <?php 
      while($row = mysqli_fetch_array( $result,MYSQLI_ASSOC))
      {
      ?>
        <?php $participant++; ?>
      <?php 
      }
      ?>

    <?php
    $username = $_SESSION['username'];
    include 'dbconnect.php';
    $query11 = "SELECT * FROM `events` WHERE organizer='$username' ORDER BY date ASC";
    $result11 = mysqli_query($conn,$query11) or die('SQL error count down!');
    $row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
    ?>

    <?php 
    $username = $_SESSION['username'];
    include 'dbconnect.php';
    $query1 = "SELECT *
         FROM events WHERE organizer='$username'
         ORDER BY title";      
    $result1 = mysqli_query($conn, $query1) or die('SQL error event');
    //$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    ?>

      <?php $event=0;?>
      <?php 
      while($row1 = mysqli_fetch_array( $result1,MYSQLI_ASSOC))
      {
      ?>
        <?php $event++ ?>
      <?php 
      }
      ?>

    <?php 
    $username = $_SESSION['username'];
    include 'dbconnect.php';
    $query2 = "SELECT *
         FROM resource WHERE organizer='$username' ";      
    $result2 = mysqli_query($conn, $query2) or die('SQL error resources');
    //$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
    ?>

      <?php $resource=0;?>
      <?php 
      while($row2 = mysqli_fetch_array( $result2,MYSQLI_ASSOC))
      {
      ?>
        <?php $resource++ ?>
      <?php 
      }
      ?>

    <?php 
    include 'dbconnect.php';
    $query3 = "SELECT *
         FROM users";      
    $result3 = mysqli_query($conn, $query3) or die('SQL error users');
    $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
    ?>

      <?php $user=1;?>
      <?php 
      while($row3 = mysqli_fetch_array( $result3,MYSQLI_ASSOC))
      {
      ?>
        <?php $user++ ?>
      <?php 
      }
      ?>

      <!-- start tukar date format -->
      <?php
      $eceh = $row11['date'];
      $eleh= $row11['time'];
      $masa = "$eceh $eleh";

      $date=date_create("$masa");
      $luffy =date_format($date,"M d Y H:i:s");
      ?>
      <!-- end tukar date format -->

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
          <li class="active"><a href="homepage-admin.php"> <i class="icon-home"></i>Home </a></li>
          <li><a href="listparticipant.php"> <i class="icon-user-1"></i>Participant</a></li>
          <li><a href="listevent.php"> <i class="icon-writing-whiteboard"></i>Event</a></li>
          <li><a href="listresources.php"> <i class="icon-contract"></i>Resources</i></a></li>
          <li><a href="report.php"> <i class="icon-info"></i>Report</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Home Menu</h2>
          </div>
        </div>

        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-user-1"></i></div><strong>Participants</strong>
                    </div>
                    <div class="number dashtext-1 counter-count"><?php echo $participant ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php echo $participant ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-1"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>Events</strong>
                    </div>
                    <div class="number dashtext-2 counter-count"><?php echo $event ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php echo $event ?>%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Resources</strong>
                    </div>
                    <div class="number dashtext-4 counter-count"><?php echo $resource ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: <?php echo $resource ?>%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="col-lg-12">
          <div class="block">
            <div class="stats-with-chart-2 block">
            <h2 class="text-center">Your upcoming conference will start in</h2>
            <hr>
            <p class="text-center" id="demo" style="font-size:60px"></p>
          <div class="col-lg">
            <p class="text-center text-info text-uppercase h3"><?php echo $row11['title']; ?></p>
          </div>
          </div>
          </div>
        </section>

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
    <script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $luffy ?>").getTime();

// Update the count down every 1 second
var countdownfunction = setInterval(function() {

  // Get todays date and time
  var now = new Date().getTime();
  
  // Find the distance between now an the count down date
  var distance = countDownDate - now;
  
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
  
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(countdownfunction);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
  </body>
</html>
<!-- js counter by toak -->
<script type="text/javascript">
  $('.counter-count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
          
          //chnage count up speed here
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
<!-- end js counter by toak -->

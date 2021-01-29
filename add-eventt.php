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
    <!-- Custom Font icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/ez-1.png">
    <!-- Date Time Picker -->
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <!-- Stylesheet file -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <style>
      body { background-color: #fafafa; }
      .container { margin-top: 150px; }
    </style>
  </head>
  
  <?php
  $message = "";
    //TO ADD DATA

    

    if (isset($_POST['add'])) {
      //$organizer = addslashes($_POST['organizer']);
      $title = addslashes($_POST['title']);
      $date = addslashes($_POST['date']);
      $time = addslashes($_POST['time']);
      $end = addslashes($_POST['end']);
      $venue = addslashes($_POST['venue']);
      $seat = addslashes($_POST['seat']);
      //$pass = md5($password);
      $organizer = $_SESSION['username'];

      include 'dbconnect.php';

      $query = "INSERT INTO events (organizer, title, date, time, end, venue, seat) VALUES
        ('$organizer', '$title', '$date', '$time', '$end', '$venue', '$seat')";
      $result = mysqli_query($conn,$query) or die ('events add sql');
      if ($result){
        //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
        //header("Location: listevent.php");
        $message = "Event have been registered!";}
      else
        echo "<script type='text/javascript'>alert('FAILED')</script>";
    }
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
                <button type="submit" class="btn btn-outline-primary" id="login"><a href="logout.php" class="nav-link">Logout</a></button>
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
          <li class="active"><a href="listevent.php"> <i class="icon-writing-whiteboard"></i>Event</a></li>
          <li><a href="listresources.php"> <i class="icon-contract"></i>Resources</i></a></li>
          <li><a href="report.php"> <i class="icon-info"></i>Report</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Event Registration</h2>
          </div>
        </div>

        <!--register -->
        <center>
        <section class="col-lg-12">
          <div class="block">
            <div class="d-flex justify-content-end">
            <a href="listevent.php" class="btn btn-primary"><i class="fa fa-add"></i>List events</a>
            </div>
            <?php if($message != "") {
                      echo
                        '<br><div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> '. $message . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
            <br>
            <div class="table-responsive">
              <form action="" method="post" autocomplete="off">
                <table class="table">
                  <tbody>
                    <div class="col-sm-9">
                      <tr>
                        <th>Organizer</th>
                        <td><input class="form-control" type="text" name="organizer" value="<?php echo $_SESSION['username'] ?>" disabled></td>
                        </tr>

                      <tr>
                        <th>Title</th>
                        <td><input placeholder="Enter a title" class="form-control" type="text" name="title" required></td>
                        </tr>

                      <tr>
                        <th>Date</th>
                        <td><input class="form-control" type="date" name="date" required></td>
                        </tr>

                        <tr>
                        <th>Start Time</th>
                        <td><input placeholder="Enter start time" type="time" name="time" class="form-control" required></td>
                        </tr>

                        <tr>
                        <th>End Time</th>
                        <td><input placeholder="Enter end time" type="time" name="end" class="form-control" required></td>
                        </tr>

                          <tr>
                          <th>Venue</th>
                          <td><input placeholder="Enter a venue" class="form-control" type="text" name="venue" required>
                          </td>
                          </tr>

                          <tr>
                          <th>Capacity</th>
                          <td><input placeholder="How much seats provided?" class="form-control" name="seat" required>
                          </td>
                          </tr>

                        </div>
                    </tbody>
                  </table>
                <br>
                <input type="submit" value="Register" class="btn btn-info js-scroll-trigger" id="add" name="add">
                </form>
              </div>
          </div>
        </section>
        </center>
        <!--register end -->

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the ltitleense conditions. Thank you for understanding :)-->
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
            <script type="text/javascript">
                $(function () {
                    $('#datetimepicker1').datetimepicker();
                });
            </script>
            <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-36251023-1']);
      _gaq.push(['_setDomainName', 'jqueryscript.net']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>
  </body>
</html>

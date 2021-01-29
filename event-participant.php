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
        //to retrived data
        if (isset($_GET['id']))
            $id = $_GET['id'];
        else
            $id = 0;

        include 'dbconnect.php';
        $query = "SELECT * FROM events where id = '$id'";
        $query1 = "SELECT a.*, b.* FROM participant a, attendance b
                   WHERE a.organizer=b.organizer && a.id=b.participant_id && event_id = '$id'";
        $result = mysqli_query($conn,$query) or die('SQL error events ');
        $result1 = mysqli_query($conn,$query1) or die('SQL error attendance ');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
        $tajuk = $row['title'];
        $date = date_create($row['date']);
        $hari = date_format($date,"jS F Y (D)");
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
          <li class="active"><a href="#event" aria-expanded="false" data-toggle="collapse"> <i class="icon-writing-whiteboard"></i>Event</a>
            <ul id="event" class="collapse list-unstyled ">
              <li><a href="info-event.php?id=<?php echo $row['id'] ?>">Check-In</a></li>
              <li><a href="event-checkout.php?id=<?php echo $row['id'] ?>">Check-Out</a></
              <li><a href="event-participant.php?id=<?php echo $row['id'] ?>">List Participant</a></li>
              <li><a href="listevent.php">List Event</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Event Title : <?php echo "$tajuk <div class=float-right>$hari</dvi>"; ?></h2>
          </div>
        </div>

        <!--details event -->
        <section class="col-lg-12">
          <div class="block">
            <div class="d-flex justify-content-end">
            <a href="#" onclick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
            </div>
            <center><h2><strong id="exampleModalLabel" class="modal-title">List Attendee</strong></h2></center><br>
              <div class="table-responsive"> 
                    <table class="table table-striped table-sm text">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NFC ID</th>
                          <th>NAME</th>
                          <th>IC</th>
                          <th>CHECK-IN</th>
                          <th>CHECK-OUT</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no=1;
                      while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC))
                      {
                        $clock = date_create($row1['time']);
                        $masa = date_format($clock,"h:i a");
                        if($row1['checkout']){
                        $clock1 = date_create($row1['checkout']);
                        $masa1 = date_format($clock1,"h:i a");}
                        else
                            $masa1 = "not checkout yet";
                      ?>
                        <tr>
                          <th><?php echo $no ?></th>
                          <td><?php echo $row1['participant_id']; ?></td>
                          <td><?php echo $row1['name']; ?></td>
                          <td><?php echo $row1['ic']; ?></td>
                          <td><?php echo $masa; ?></td>
                          <td><?php echo $masa1 ?></td>
                        </tr>
                        <?php $no++ ?>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>

          </div>
        </section>
        <!--details event end -->

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
  </body>
</html>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch_event.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>
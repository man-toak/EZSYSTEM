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
  $message = "";
  $error2 = "";
        //to retrived data
        if (isset($_GET['ic']))
            $ic = $_GET['ic'];
        else
            $ic = 0;

        include 'dbconnect.php';
        $query = "SELECT * FROM participant  where ic = '$ic'";
        $result = mysqli_query($conn,$query) or die('SQL error participantttt ');
        $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);


        //to edit data
        if (isset($_POST['hantar']) && isset($_POST['ic'])) {

            //$id = addslashes($_POST['id']);
            $userrfid = addslashes($_POST['rfid']);
            $ic = addslashes($_POST['ic']);
            //$name = addslashes($_POST['name']);
            //$email = addslashes($_POST['email']);
            //$attend = addslashes($_POST['attend']);
            $username = $_SESSION['username'];

            include 'dbconnect.php';

            $dahke =  "SELECT id FROM participant WHERE id ='$userrfid' && organizer='$username'";
            $zz = mysqli_query($conn,$dahke) or die ("sql error check NFC exist");
            $zzz = mysqli_fetch_array($zz, MYSQLI_ASSOC);
            if(!$zzz){
              $query2 = "UPDATE participant SET
                  id = '$userrfid' WHERE ic = '$ic'";

              $result2 = mysqli_query($conn,$query2);
              if ($result2){
                  //header("Location: info.php?s_ic={$row['s_ic']}");
                  //echo"<script type='text/javascript'>alert('UPDATE SUCCESS')</script>";
                  $message = "NFC ID updated!";
                  $query = "SELECT * FROM participant  where ic = '$ic'";
                  $result = mysqli_query($conn,$query) or die('SQL error display live NFC ');
                  $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  //header("location: info.php?ic=".$row2['ic']);
              }
              else
                  //echo"<script type='text/javascript'>alert('UPDATE FAILED')</script>";
                $message = "NFC ID has been used!";
              }
          else
              $error2 = "This NFC id already registered as participant";
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
          <li class="active"><a href="listparticipant.php"> <i class="icon-user-1"></i>Participant</a></li>
          <li><a href="listevent.php"> <i class="icon-writing-whiteboard"></i>Event</a></li>
          <li><a href="listresources.php"> <i class="icon-contract"></i>Resources</i></a></li>
          <li><a href="report.php"> <i class="icon-info"></i>Report</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Participant's Info</h2>
          </div>
        </div>

        <!--table info -->
        <section class="col-lg-12">
          <div class="block">
            <div class="text-left"><a class="btn btn-secondary btn-sm" href="listparticipant.php"><i class="fa fa-long-arrow-left"></i> back</a></div>
            <center><h1><strong id="exampleModalLabel" class="modal-title">NFC ID</strong></h1>
            <div class="modal-body">
              <p>Scan here to register or edit NFC ID for this participant.</p>
              <form action="" method="post" autocomplete="off">
                <div class="form-group">
                <input type="hidden" name="ic" value="<?php echo $row2['ic']; ?>">
                <input type="text" name="rfid" placeholder="Scan NFC tag here" class="form-control col-lg-5" class="js-scroll-trigger" required>
                </div>
                <div class="form-group">       
                <center><input type="submit" value="Save" class="btn btn-success js-scroll-trigger" name="hantar" hidden></center>
                </div>
              </form>
            </div>
            </center>
            <?php if($message != "") {
                      echo
                        '<div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> ' . $ic . "      " . $message . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                        <?php if($error2 != "") {
                      echo
                        '<br><div class="alert alert-danger alert-dismissible fade show">
                            <strong>Oops!</strong> '. $error2 . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
            <br>
            <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>NFC ID</th>
                    <td><input class="form-control-plaintext text-info" placeholder="No NFC ID assigned" value="<?php echo $row2['id']; ?>" disabled></td>
                    
                  </tr>
                  <tr>
                    <th>NAME</th>
                    <td><?php echo $row2['name']; ?></td>
                  </tr>
                  <tr>
                    <th>IC NUMBER</th>
                    <td><?php echo $row2['ic']; ?></td>
                  </tr>
                  <tr>
                    <th>EMAIL</th>
                    <td><?php echo $row2['email']; ?></td>
                  </tr>
                  </table>
                </div>
          </div>
        </section>
        <!--table info end -->

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
   url:"fetch_participant.php",
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
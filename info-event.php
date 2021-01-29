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
        $query = "SELECT * FROM events  where id = '$id'";
        $result = mysqli_query($conn,$query) or die('SQL error participantttt ');
        $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $clock = date_create($row2['time']);
        $start = date_format($clock,"h:i a");
        $clock1 = date_create($row2['end']);
        $end = date_format($clock1,"h:i a");
        $date = date_create($row2['date']);
        $hari = date_format($date,"jS F Y (D)");
        $date1 = date_create($row2['created']);
        $create = date_format($date1,"jS F Y (D) h:i a");

    ?>

    <?php
    include 'dbconnect.php';

    $message = "";
    $error = "";
    $exist = "";
    $full = "";

    if (isset($_POST['hantar']))
    {
      $organizer = $_SESSION['username'];
      $event_id= addslashes($_POST['id']);
      $participant_id= addslashes($_POST['nfc']);
      $attend_status = addslashes($_POST['attend_status']);

      $oyeh = mysqli_query($conn,"SELECT * FROM events WHERE id='" . $event_id . "' && seat = 0") ;
      $ayo = mysqli_fetch_assoc($oyeh);

      if(!$ayo)
      {
          
          $sql = mysqli_query($conn,"SELECT * FROM participant WHERE id='" . $participant_id . "' && organizer = '" . $organizer . "'") ;
          $row = mysqli_fetch_assoc($sql);
          $nama=$row['name'];

          if($row)
          {

          $zzz = mysqli_query($conn,"SELECT * FROM attendance WHERE participant_id='" . $participant_id . "' && event_id='" . $event_id . "'") ;
          $adoi = mysqli_fetch_assoc($zzz);

            if(!$adoi){

            $attend_status='1';
            $updatesql = mysqli_query($conn,"INSERT INTO attendance (organizer, event_id, participant_id, attend_status) VALUES
            ('$organizer', '$event_id', '$participant_id', '$attend_status')");

            if($updatesql){
              $minus = 1;
              $updatseat = mysqli_query($conn,"UPDATE events SET seat=seat-'" .   $minus . "'  WHERE id='" .   $event_id . "'");
              $query = "SELECT * FROM events  where id = '$id'";
              $result = mysqli_query($conn,$query) or die('SQL error display live seat ');
              $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $message = "Thank You for Attending!";}
            }
            else
              $exist = "This user already attend this event!";
          }
          else
            $error = "This card is not register yet!  Please ask for help from our crew.";
      }
      else
        $full = "This event is already full! No seat left :(";

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
          <li class="active"><a href="#event" aria-expanded="false" data-toggle="collapse"> <i class="icon-writing-whiteboard"></i>Event</a>
            <ul id="event" class="collapse list-unstyled ">
              <li><a href="info-event.php?id=<?php echo $row2['id'] ?>">Check-In</a></li>
              <li><a href="event-checkout.php?id=<?php echo $row2['id'] ?>">Check-Out</a></li>
              <li><a href="event-participant.php?id=<?php echo $row2['id'] ?>">List Participant</a></li>
              <li><a href="listevent.php">List Event</a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Event Attendance</h2>
          </div>
        </div>

        <!--details event -->
        <section class="col-lg-12">
          <div class="block">
            <center><h1><strong id="exampleModalLabel" class="modal-title">CHECK-IN</strong></h1>
            <div class="modal-body">
              <p>Scan here to submit your attendance.</p>
              <form action="" method="post" autocomplete="off">
                <div class="form-group">
                <input name="organizer" value="<?php echo $_SESSION['username'] ?>" hidden>
                <input type="hidden" name="id" value="<?php echo $row2['id']; ?>">
                <input type="text" name="nfc" placeholder="Scan NFC tag here" class="form-control col-lg-5" class="js-scroll-trigger" required>
                <input type="hidden" name="attend_status">
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
                            <strong>Success!</strong> ' . $participant_id . "      " . $message . "     ".$nama.'
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                      <?php if($error != "") {
                      echo
                        '<div class="alert alert-danger alert-dismissible fade show">
                            <strong>Oops!</strong> NFC ID = ' . $participant_id . "   ,   " . $error . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>

                      <?php if($exist != "") {
                      echo
                        '<div class="alert alert-warning alert-dismissible fade show">
                            <strong>Error!</strong> NFC ID = ' . $participant_id . "   ,   " . $exist . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>

                      <?php if($full != "") {
                      echo
                        '<div class="alert alert-warning alert-dismissible fade show">
                            <strong>Sorry!</strong>  ' . $full. '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
            <br>
            <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>ID</th>
                    <td><?php echo $row2['id']; ?></td>
                  </tr>
                  <tr>
                    <th>TITLE</th>
                    <td><?php echo $row2['title']; ?></td>
                  </tr>
                  <tr>
                    <th>DATE</th>
                    <td><?php echo $hari ?></td>
                  </tr><tr>
                    <th>TIME</th>
                    <td><?php echo "$start - $end"; ?></td>
                  </tr>
                  <tr>
                    <th>VENUE</th>
                    <td><?php echo $row2['venue']; ?></td>
                  </tr>
                  <tr>
                    <th>CREATED</th>
                    <td><?php echo $create ?></td>
                  </tr>
                  <tr>
                    <th>CAPACITY</th>
                    <td class="text-warning"><?php echo $row2['seat']; ?> left</td>
                  </tr>
                  </table>
                  <br><br>
                  <a href="listevent.php" class="btn btn-secondary">BACK</a>
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
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
  <style>
body, html {
  height: 100%;
  margin: 0;
}

.bgimg {
  background-image: url('img/mockup6.jpg');
  height: 100%;
  background-position: center;
  background-size: cover;
  position: relative;
  color: white;
  font-family: "Courier New", Courier, monospace;
  font-size: 15px;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>

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
if (isset($_GET['id']))
            $username = $_GET['id'];
        else
            $username = 0;
include 'dbconnect.php';
$query11 = "SELECT * FROM `events` WHERE organizer='$username' ORDER BY date ASC";
$result11 = mysqli_query($conn,$query11) or die('SQL error count down!');
$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
?>

<?php
if (isset($_GET['id']))
            $username = $_GET['id'];
        else
            $username = 0;
include 'dbconnect.php';
$query12 = "SELECT * FROM `events` WHERE organizer='$username' ORDER BY date ASC";
$result12 = mysqli_query($conn,$query12) or die('SQL looping event!');
?>

<?php
  $message = "";
    //TO ADD DATA
    if (isset($_POST['add'])) {
      $name = addslashes($_POST['name']);
      $ic = addslashes($_POST['ic']);
      $email = addslashes($_POST['email']);
      $userrfid = addslashes($_POST["rfid"]);

      //$pass = md5($password);

      include 'dbconnect.php';

      $id = $userrfid;
      $pass = $ic;

      $query = "INSERT INTO participant (id, name, ic, email, password) VALUES
        ('$id', '$name',$ic, '$email', '$pass')";
      $result = mysqli_query($conn,$query);
      if ($result){
        //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
        //header("Location: listparticipant.php");
        $message = "Participant have been registered!";}
      else
        echo "<script type='text/javascript'>alert('FAILED')</script>";
    }
    ?>
    <!------------------------------------------------------------------------------------------->
    <?php 
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
    //$row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
    ?>

      <?php $user=0;?>
      <?php 
      while($row3 = mysqli_fetch_array( $result3,MYSQLI_ASSOC))
      {
      ?>
        <?php $user++ ?>
      <?php 
      }
      ?>

      <!-- tukar date format -->
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
          <li><a href="index.php"> <i class="icon-home"></i>Back </a></li>
          <li><a href="register-participant.php?id=<?php echo $username ?>"> <i class="icon-user-1"></i>Register</a></li>
          <li><a href="about.php"> <i class="icon-info"></i>About</a></li>
          <li><a href="contact.php"> <i class="icon-contract"></i>Contact</a></li>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Organizer <?php echo $username ?></h2>
          </div>
        </div>

        <section class="no-padding-top no-padding-bottom">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-3 col-sm-6">
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
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-contract"></i></div><strong>Events</strong>
                    </div>
                    <div class="number dashtext-2 counter-count"><?php echo $event ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-2"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>Resources</strong>
                    </div>
                    <div class="number dashtext-4 counter-count"><?php echo $resource ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-4"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6">
                <div class="statistic-block block">
                  <div class="progress-details d-flex align-items-end justify-content-between">
                    <div class="title">
                      <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>Organizers</strong>
                    </div>
                    <div class="number dashtext-3 counter-count"><?php echo $user ?></div>
                  </div>
                  <div class="progress progress-template">
                    <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar-template dashbg-3"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <center>
        <section class="no-padding-top no-padding-bottom">
        <div class="col-lg-7">
          <div class="stats-with-chart-2 block">
            <h1>Conference will start in</h1>
            <hr>
            <p id="demo" style="font-size:30px"></p>
          <div class="col-lg">
            <p>Want to join next conference? Register Now!</p>
          </div>
          </div>
        </div>
        </section>

        <div class="col-lg-12">
                <div class="block">
                  <div class="title"><strong>List of Events</strong></div>
                  <div class="table-responsive"> 
                    <table class="table table-striped table-sm">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Event Name</th>
                          <th>Venue</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no=1;
                      while($row12 = mysqli_fetch_array($result12, MYSQLI_ASSOC))
                      {
                        $eceh1 = $row12['date'];
                        $masa1 = "$eceh1";

                        $date1=date_create("$masa1");
                        $zoro =date_format($date1,"d/m/y");
                      ?>
                        <tr>
                          <th scope="row"><?php echo $no ?></th>
                          <td><?php echo $row12['title']; ?></td>
                          <td><?php echo $row12['venue']; ?></td>
                          <td><?php echo $zoro; ?></td>
                        </tr>
                        <?php $no++ ?>
                        <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
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
    document.getElementById("demo").innerHTML = "coming soon!";
  }
}, 1000);
</script>
  </body>
</html>
<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch_organizer.php",
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
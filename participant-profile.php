<?php  
session_start();  
  
if(!$_SESSION['email'])  
{  
  
    header("Location: login-participant.php");//redirect to the login page to secure the welcome page without login access.  
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  </head>
  
    <?php 
    $email = $_SESSION['email'];
    include 'dbconnect.php';
    $query = "SELECT * FROM participant WHERE email = '$email'";      
    $result = mysqli_query($conn, $query) or die('SQL error participant');
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>

    <?php 
    $message="";
    $message1="";
    $message2="";
    $error="";
    $email = $_SESSION['email'];
    $ic = md5($row['ic']);
    $pass = $row['password'];
    include 'dbconnect.php';
    $query2 = "SELECT * FROM participant WHERE (password='$ic') AND email = '$email'";      
    $result2 = mysqli_query($conn, $query2) or die('SQL error password');
    $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
      if ($row2){
        $message="We detect your current password is still the same as your IC number. Change now for a better security :)";
      }
    ?>

    
    
    <?php
    $email=$_SESSION["email"] ;
    $conn = mysqli_connect("localhost", "root", "", "fyp") or die("Connection Error: " . mysqli_error($conn));

    //if (count($_POST) > 0) {
    if (isset($_POST['submit'])) {
        $result3 = mysqli_query($conn, "SELECT * FROM participant WHERE email='" . $email . "'");
        $row3 = mysqli_fetch_array($result3);

        $password=$_POST['password'];  
        $password=md5($password);
        $ah = $_POST["newPassword"];
        $ah = md5($ah);
        $x = md5($_POST["password"]);
        $z = md5($row["password"]);

        if ($x== $row["password"]) {
            mysqli_query($conn, "UPDATE participant set password='" . $ah . "' WHERE email='" . $email . "'");
            $cool = "Password Changed";
            $message="Thank you :)";
        } else
            $message3 = "Current Password is not correct";
    }
    ?>

    <?php
    $edit="";
    $edit1="";
    $email=$_SESSION["email"] ;
    include "dbconnect.php";

    if (isset($_POST['edit'])) {
    //$id = $_POST['id'];
    $name = addslashes($_POST['name']);
    $ic= addslashes($_POST['ic']);
    $email = addslashes($_POST['email']);

    $update = "UPDATE participant 
    SET name='" . $name . "',
    ic='" . $ic . "',
    email='" . $email . "'
    WHERE email=" . $email;

    $result1 = mysqli_query($conn,$update) or die ('info edit sql');
      if ($result1){
        //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
        //header("Location: listevent.php");
        $edit = "Info has been edited";
        $query = "SELECT * FROM participant  where email = '$email'";
        $result = mysqli_query($conn,$query) or die('SQL error display live info ');
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //echo "<meta http-equiv='refresh' content='0'>";
        //header('location: listevent.php');
        }
      else
        $edit1 = "Failed to edit this Info!";
    }
    ?>

  <body>
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid d-flex align-items-center justify-content-between">
         <div class="navbar-header">
            <!-- Navbar Header--><a href="homepage-participant.php" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">Ez</strong><strong>System</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">E</strong><strong>Z</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom"> 

           <!-- START Login dropdown    -->
           <div class="logout">
          <a href="#" data-toggle="modal" data-target="#logout-participant" class="login-btn"><i class="fa fa-sign-out"></i><span class="d-none d-md-inline-block"> Logout</span></a>
        </div>
            <!-- END Login dropdown    -->

          </div>
        </div>
      </nav>
      <!-- Logout participant start-->
      <div id="logout-participant" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">Participant Logout</h4>
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
      <!-- Logout participant end-->
    </header>
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="img/user.png" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo $row['name']; ?></h1>
            <p>Participant</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li><a href="homepage-participant.php"> <i class="icon-home"></i>Home </a></li>
          <li class="active"><a href="participant-profile.php"> <i class="icon-user-1"></i>Profile</a></li>
          <li><a href="participant-event.php"> <i class="icon-writing-whiteboard"></i>Event</a></li>
          <li><a href="participant-resources.php"> <i class="icon-contract"></i>Resources</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Profile Setting</h2>
          </div>
        </div>
        
        <section class="no-padding-top">

                        <?php if($message != "") {
                        echo
                        '<br><div class="alert alert-warning alert-dismissible fade show">
                            <strong>Ooh!</strong> '. $message . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>

          <div class="container-fluid">
            <div class="row">
              <!-- Basic Form-->
              <div class="col-lg-6">
                <div class="block">
                  <div class="title"><strong class="d-block">User Profile Info</strong><span class="d-block"></span></div>
                  <div class="block-body">
                    <form action="" method=post autocomplete="off">
                      <div class="form-group">
                        <label class="form-control-label">NFC id</label>
                        <input placeholder="No NFC id was assigned yet" value="<?php echo $row['id']; ?>" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label">Name</label>
                        <input type="text" placeholder="Full Name" value="<?php echo $row['name']; ?>" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label">IC No.</label>
                        <input type="text" placeholder="IC number without ' - ' dash" value="<?php echo $row['ic']; ?>" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label">Email</label>
                        <input type="email" placeholder="Email Address" value="<?php echo $row['email']; ?>" class="form-control" disabled>
                      </div>
                      <!--<div class="form-group">       
                        <input type="submit" value="Edit" name="edit" class="btn btn-success">
                      </div>-->
                      <!--<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success">Edit </button>-->
                    </form>
                    <!-- Modal-->
                    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Edit User Info</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <div class="modal-body">
                            <form action="" method="post">
                              <div class="form-group">
                                <label>Name</label>
                                <input type="text" placeholder="Full Name" value="<?php echo $row['name']; ?>" class="form-control" name="name">
                              </div>
                              <div class="form-group">
                                <label>IC No</label>
                                <input type="text" placeholder="IC number without ' - ' dash" value="<?php echo $row['ic']; ?>" class="form-control" minlength="12" name="ic">
                              </div>
                              <div class="form-group">       
                                <label>Email</label>
                                <input type="email" placeholder="Email Address" value="<?php echo $row['email']; ?>" class="form-control" name="email">
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            <button type="submit" name="edit" class="btn btn-info">Save changes</button>
                          </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Horizontal Form-->
              <div class="col-lg-6">
                <div class="block">
                  <div class="title"><strong class="d-block">User Password</strong><span class="d-block">Change your password here.</span></div>
                  <?php if($message2 != "") {
                        echo
                        '<br><div class="alert alert-success alert-dismissible fade show">
                            <strong>Cool!</strong> '. $message2 . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                        <?php if($error != "") {
                        echo
                        '<br><div class="alert alert-warning alert-dismissible fade show">
                            <strong>Ooh!</strong> '. $error . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                        <?php if(isset($message3)) { 
                        echo '<br><div class="alert alert-danger alert-dismissible fade show">
                              <strong>Ooh!</strong> '. $message3 . '
                              <button type="button" class="close" data-dismiss="alert">&times;</button></div>'; 
                        } ?>
                        <?php if(isset($cool)) { 
                        echo '<br><div class="alert alert-success alert-dismissible fade show">
                              <strong>Cool!</strong> '. $cool . '
                              <button type="button" class="close" data-dismiss="alert">&times;</button></div>'; 
                        } ?>
                  <div class="block-body">
                    <!--<form action="" method=post autocomplete="off" 
            oninput='up2.setCustomValidity(up2.value != up.value ? "Passwords do not match." : "")'>
                    <p>
                    <label class="form-control-label" for="username">Old Password:</label>
                    <input id="password" type="password" required name="password" class="demoInputBox form-control" onBlur="checkAvailability()"><span id="user-availability-status"></span>
                    <p>
                    <label class="form-control-label" for="password1">New Password:</label>
                    <input class="form-control" id="password1" type=password required name=up>
                    <p>
                    <label class="form-control-label" for="password2">Confirm password:</label>
                    <input class="form-control" id="password2" type=password name=up2>
                    <p>
                    <input type=submit value="Change" name="edit" class="btn btn-info">
                  </form>-->
                  <form name="frmChange" method="post" action="" oninput='confirmPassword.setCustomValidity(confirmPassword.value != newPassword.value ? "Passwords do not match." : "")' onSubmit="return validatePassword()">
                    <p>
                    <label class="form-control-label" for="username">Current Password:</label>
                    <input id="password" type="password" required name="password" class="demoInputBox form-control" onBlur="checkAvailability()"><span id="user-availability-status"></span>
                    <!--<p>
                    <label>Current Password :</label>
                    <input type="password" name="currentPassword" class="txtField form-control"/><span id="currentPassword"  class="required"></span>-->
                    <p>
                    <label class="form-control-label">New Password :</label>
                    <input type="password" name="newPassword" minlength="6" class="txtField form-control" required>
                    <p>
                    <label class="form-control-label">Confirm Password</label>
                    <input type="password" name="confirmPassword"  class="txtField form-control" required>
                    <p>
                    <input type="submit" name="submit" value="Change" class="btnSubmit btn btn-info">
                  </form>
                  </div>
                </div>
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
    <script src="js/front.js"></script><script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $row11['date'] ?>").getTime();

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
    document.getElementById("demo").innerHTML = "NO EVENT REGISTERED";
  }
}, 1000);
</script>
<script type="text/javascript">
function checkAvailability(){
  $("#loaderIcon").show();
  
  $.ajax({
    type:"POST",
    url:"check-oldpass.php",
    cache:false,
    data:{
      type:1,
      password:$("#password").val(),
    },
    success:function(data){
      $("#user-availability-status").html(data);
      $("#loaderIcon").hide(1000);
    }
  });
}
</script>
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "required";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "required";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "required";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "Password do not match!";
output = false;
}   
return output;
}
</script>
  </body>
</html>
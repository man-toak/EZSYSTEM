<?php  
session_start();//session starts here  
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
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

<!-- CHECK USRNAME EXIST -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check-organizer.php",
data:'username='+$("#register-username").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function checkAvailability1() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check-organizer.php",
data:'email='+$("#register-email").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<!-- CHECK PASSWORD SAMA KE TAK -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script type="text/javascript"><!--
    function checkPasswordMatch() {
    var password = $("#register-password").val();
    var password2 = $("#register-password1").val();
    var x = password2.length;
    if(x>5){
	    if (password != password2)
	        $("#divCheckPasswordMatch").html("Passwords do not match!").addClass('text-warning').removeClass('text-success');
	    else if ((password == 0) && (password2 == 0))
	        $("#divCheckPasswordMatch").html("Password is required").addClass('text-warning').removeClass('text-success');
	    else
	        $("#divCheckPasswordMatch").html("Passwords match!").addClass('text-success').removeClass('text-warning');
	}
}
//--></script>
</head>

<?php
  $message = "";
  $error = "";
    //TO ADD DATA
    if (isset($_POST['register'])) {
      $username = addslashes($_POST['username']);
      $email = addslashes($_POST['email']);
      $password = addslashes($_POST['password']);
      $password2 = addslashes($_POST['password2']);

      $password = md5($password);
      $password2 = md5($password2);

      include 'dbconnect.php';

      $check = "SELECT username FROM users WHERE username='$username'";
      $haha = mysqli_query($conn,$check);
      $hahaha = mysqli_fetch_array($haha, MYSQLI_ASSOC);
      if(!$hahaha){
      	$check1 = "SELECT email FROM users WHERE email='$email'";
      	$huhu = mysqli_query($conn,$check1);
      	$huhuhu = mysqli_fetch_array($huhu, MYSQLI_ASSOC);
      	if(!$huhuhu){
      		if($password == $password2){
			      $query = "INSERT INTO users (username, email, password, password2) VALUES
			        ('$username','$email', '$password', '$password2')";
			      $result = mysqli_query($conn,$query);
			      if ($result){
			        //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
			        //header("Location: listparticipant.php");
			        $message = "Organizer have been registered!";}
			      else
			        echo "<script type='text/javascript'>alert('FAILED')</script>";
				}
				else
					$error = "Password do not match!";
			}
			else
				$error = "Email is already exist";
		}
		else
			$error = "Username is already exist";
    }
    ?>

  <body>
    <div class="login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Admin Registration</h1>
                  </div>
                  <p>Automated Conference Management System using NFC Technology</p>
                  <br><center><a href="index.php"><img src="img/ez-1.png" class="img-fluid" width="100px;"></a></center>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                <?php if($message != "") {
                      echo
                        '<br><div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> '. $message . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                        <?php if($error != "") {
                      echo
                        '<br><div class="alert alert-danger alert-dismissible fade show">
                            <strong>Oops!</strong> '. $error . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
                  <form method="post" class="text-left form-validate" autocomplete="off">
                    <div class="form-group-material">
                      <input id="register-username" type="text" name="username" required minlength="5" class="demoInputBox input-material" onBlur="checkAvailability()">
                      <label for="register-username" class="label-material">Username</label>
                      <span id="user-availability-status"></span>
                    </div>
                    <div class="form-group-material">
                      <input id="register-email" type="email" name="email" required data-msg="Please enter a valid email address" class="demoInputBox input-material" onBlur="checkAvailability1()">
                      <span id="user-availability-status1"></span>
                      <label for="register-email" class="label-material">Email Address</label>
                    </div>
                    <div class="form-group-material">
                      <input id="register-password" type="password" name="password" required minlength="6" class="input-material">
                      <label for="register-password" class="label-material">Password</label>
                    </div>
                    <div class="form-group-material">
                      <input id="register-password1" type="password" name="password2" required minlength="6" class="input-material" onkeyup="checkPasswordMatch();">
                      <span class="registrationFormAlert" id="divCheckPasswordMatch"></span>
                      <label for="register-password1" class="label-material">Confirm Password</label>
                    </div>
                    <div class="form-group terms-conditions text-center">
                      <input id="register-agree" name="registerAgree" type="checkbox" required value="1" data-msg="Your agreement is required" class="checkbox-template">
                      <label for="register-agree">I agree with the <a href="#" data-toggle="modal" data-target="#myModal">terms and policy</a></label>
                    </div>
                    <div class="form-group text-center">
                      <input id="register" type="submit" value="Register" name="register" class="btn btn-primary">
                    </div>
                  </form><small>Already have an account? </small><a href="login-admin.php" class="signup">Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal-->
                    <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                      <div role="document" class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                          <div class="modal-header"><strong id="exampleModalLabel" class="modal-title">Terms and Policy</strong>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                          </div>
                          <?php include "terms&policy.php" ?>
                      </div>
                    </div>
                </div>
                    <!-- end modal -->
      <div class="copyrights text-center">
        <p>Design by <a href="https://youtube.com/c/mantoak/" class="external">Toak</a></p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="js/front.js"></script>
  </body>
</html>

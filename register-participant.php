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
  font-size: 25px;
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

<?php
  $message = "";
  $error = "";
  $error1 = "";

    //TO ADD DATA
  if (isset($_GET['id']))
            $username = $_GET['id'];
        else
            $username = 0;

    if (isset($_POST['add'])) {
      $name = addslashes($_POST['name']);
      $ic = addslashes($_POST['ic']);
      $email = addslashes($_POST['email']);
      $userrfid = addslashes($_POST["rfid"]);
      $organizer = addslashes($_POST['organizer']);
      $name = strtoupper($name);

      //$pass = md5($password);

      include 'dbconnect.php';

      $id = $userrfid;
      $pass = md5($ic);

      $check = "SELECT ic FROM participant WHERE ic ='$ic'";
      $aa = mysqli_query($conn,$check) or die ("sql error check ic exist");
      $aaa = mysqli_fetch_array($aa, MYSQLI_ASSOC);
      if(!$aaa){
        $haih = "SELECT email FROM participant WHERE email ='$email'";
        $bb = mysqli_query($conn,$haih) or die ("sql error check email exist");
        $bbb = mysqli_fetch_array($bb, MYSQLI_ASSOC);
        if(!$bbb){
            $query = "INSERT INTO participant (id, name, ic, email, password, organizer) VALUES
              ('$id', '$name','$ic', '$email', '$pass' , '$organizer')";
            $result = mysqli_query($conn,$query) or die ("sql error kat insert data");
            if ($result){
              //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
              //header("Location: listparticipant.php");
              $message = "You have been registered! Your IC is your temporary password";}
            else
              echo "<script type='text/javascript'>alert('FAILED')</script>";
          }
          else
            $error = "This email already registered as participant";
        }
        else
          $error1 = "This IC number already registered as participant";
    }
    ?>
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
          <li><a href="organizer-page.php?id=<?php echo $username ?>"> <i class="icon-home"></i>Back </a></li>
          <li class="active"><a href="register-participant.php?username=<?php echo $username ?>"> <i class="icon-user-1"></i>Register</a></li>
          <li><a href="about.php"> <i class="icon-info"></i>About</a></li>
          <li><a href="contact.php"> <i class="icon-contract"></i>Contact</a></li>
      </nav>
      <!-- Sidebar Navigation end-->
     <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Participant Registration</h2>
          </div>
        </div>

        <!--register -->
        <center>
        <section class="col-lg-12">
          <div class="block">
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
                        <?php if($error1 != "") {
                      echo
                        '<br><div class="alert alert-danger alert-dismissible fade show">
                            <strong>Oops!</strong> '. $error1 . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>
            <br>
            <div class="table-responsive">
              <form action="" method="post" autocomplete="off">
                <table class="table">
                  <tbody>
                    <div class="col-sm-9">
                      <tr>
                        <th>ORGANIZER</th>
                        <th><center><h5 class="h3 text-uppercase"><?php echo $username ?></h5></center></th>
                        </tr>
                        <input type="text" name="organizer" value="<?php echo $username ?>" hidden>
                      <tr>
                        <th>NAME</th>
                        <td><input class="form-control" type="text" name="name" required></td>
                        </tr>

                      <tr>
                        <th>IC</th>
                        <td><input class="form-control" type="text" id="ic" name="ic" placeholder="without any ' - ' dash" minlength="12" maxlength="12" required></td>
                        </tr>

                      <tr>
                        <th>EMAIL</th>
                        <td><input class="form-control" type="text" id="email" name="email" required></td>
                        </tr>

                        <!--<tr>
                          <th>SCAN NFC TAG</th>
                          <td>--><input class="form-control" type="text" id="rfid" name="rfid" hidden>
                          <!--</td>
                          </tr> -->

                        </div>
                    </tbody>
                  </table>
                <br>
                <input type="submit" value="Register" class="btn btn-info js-scroll-trigger" name="add">
                </form>
              </div>
          </div>
        </section>
        </center>
        <!--register end -->
        
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
var countDownDate = new Date("<?php echo $row['date'] ?>").getTime();

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
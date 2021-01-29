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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
        $query = "SELECT * FROM resource  where id = '$id'";
        $result = mysqli_query($conn,$query) or die('SQL error retrieve resource ');
        $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);

    ?>

    <?php
    $error="";
    $message="";
    include "dbconnect.php";

    if (isset($_POST['edit'])) {
    //$id = $_POST['id'];
    $name = addslashes($_POST['name']);
    $type = addslashes($_POST['type']);
    $file = addslashes($_POST['file']);

    $update = "UPDATE resource 
    SET name='" . $name . "',
    type='" . $type . "',
    file='" . $file . "'
    WHERE id=" . $id;

    $result1 = mysqli_query($conn,$update) or die ('resource edit sql');
      if ($result1){
        //echo "<script type='text/javascript'>alert('REGISTER SUCCESS')</script>";
        //header("Location: listevent.php");
        $message = "Resource have been edited!";
        $query = "SELECT * FROM resource  where id = '$id'";
        $result = mysqli_query($conn,$query) or die('SQL error resources ');
        $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //echo "<meta http-equiv='refresh' content='0'>";
        //header('location: listevent.php');
        }
      else
        $error = "Failed to Edit this Resource!";
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
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-alt-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom"> 

           <!-- START Login dropdown    -->
           <div class="logout">
          <a href="#" data-toggle="modal" data-target="#logout-admin" class="login-btn"><i class="fa fa-sign-out-alt"></i><span class="d-none d-md-inline-block"> Logout</span></a>
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
          <li class="active"><a href="listresources.php"> <i class="icon-contract"></i>Resources</i></a></li>
          <li><a href="report.php"> <i class="icon-info"></i>Report</i></a></li>
        </ul>
      </nav>
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h2 class="h5 no-margin-bottom">Edit Resource</h2>
          </div>
        </div>

        <!-- edit event -->
        <section class="col-lg-12">
          <div class="block">
            <div class="text-left"><a class="btn btn-secondary btn-sm" href="listresources.php"><i class="fas fa-long-arrow-alt-left"></i> back</a></div>
            <div class="h2 text-center">Info Resource</div>
                        <?php if($message != "") {
                        echo
                        '<br><div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> '. $message . '
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>'; }?>

                        <?php if($error != "") {
                        echo
                        '<br><div class="alert alert-danger alert-dismissible fade show">
                            <strong>Error!</strong> '. $error . '
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
                        <td><div class="form-control" type="plaintext" readonly><?php echo $_SESSION['username'] ?></div></td>
                        </tr>

                      <tr>
                        <th>Name</th>
                        <td><input placeholder="Enter a title" class="form-control" type="text" name="name" value="<?php echo $row2['name'] ?>" required></td>
                        </tr>

                      <tr>
                        <th>Type</th>
                        <td><input list="type" class="form-control" name="type" value="<?php echo $row2['type'] ?>" required>
                            <datalist id="type">
                              <option value="JPG/JPEG/PNG">
                              <option value="MP4/MOV">
                              <option value="PDF">
                              <option value="doc/docx">
                              <option value="ppt/pptx">
                              <option value="zip/rar">
                            </datalist>
                        </td>
                        </tr>

                        <tr>
                        <th>File</th>
                        <td><input type="file" name="file" class="form-control">
                          <span><?php echo $row2['file'] ?></span></td>
                        </tr>

                        </div>
                    </tbody>
                  </table>
                <br>
                <center>
                <input type="submit" value="SAVE" class="btn btn-success js-scroll-trigger" id="add" name="edit">
                </center>
                </form>
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
  </body>
</html>
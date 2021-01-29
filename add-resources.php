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
  $message="";
  $error="";
  include_once 'dbconnect.php';
  if(isset($_POST['upload']))
  {   
   $valid_extensions = array('jpeg','jpg','png','ppt','pptx','doc','docx','pdf','mov','mp4','zip','rar');     
   $file = $_FILES['file']['name'];
   $file_loc = $_FILES['file']['tmp_name'];
   $file_size = $_FILES['file']['size'];
   $file_type = $_FILES['file']['type'];
   $folder="resources/";
   $organizer = $_SESSION['username'];
   $type = addslashes($_POST['type']);
   
   /* new file size in KB */
   $new_size = $file_size/1024;  
   /* new file size in KB */
   
   /* make file name in lower case */
   $new_file_name = strtolower($file);
   /* make file name in lower case */

   /* verify file extension available or not */
   $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
   /* verify file extension available or not */
   
   $final_file=str_replace(' ','-',$new_file_name);
   
   if(in_array($ext, $valid_extensions)){
     if($new_size < 10000){
         if(move_uploaded_file($file_loc,$folder.$final_file))
         {
          $sql="INSERT INTO resource(organizer,name,type,file,size) 
          VALUES('$organizer','$new_file_name','$type','$final_file','$new_size')";
          mysqli_query($conn,$sql);
         
          $message = "File sucessfully upload";
                
          
         }
         else
         {
          
         $error = "Error. Please try again";
            
            }
          }
          else
            $error = "Error. File must be less than 10MB!";
        }
        else
          $error = "Error. Type of file is not supported! Only jpeg, jpg, png, ppt, pptx, doc, docx, pdf, mov, mp4, zip, rar";
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
            <h2 class="h5 no-margin-bottom">Upload Resources</h2>
          </div>
        </div>

        <!--Live search AIMAN -->
        <section class="col-lg-12">
          <div class="block">
            <div class="d-flex justify-content-end">
            <a href="listresources.php" class="btn btn-primary"><i class="fa fa-add"></i>List Resources</a>
            </div>
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
            <br>
             <table class="table">
                        <tbody>
                  <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
                    <div align="center" class="container">

                      <tr>
                        <th>ORGANIZER</th>
                        <td><input class="form-control" type="text" name="organizer" value="<?php echo $_SESSION['username'] ?>" disabled></td>
                        </tr>

                      <tr>
                        <th>TYPE</th>
                        <td><input list="type" class="form-control" name="type" required>
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
                        <th>UPLOAD FILE</th>
                        <td>
                          <input class="form-control" type="file" id="file" name="file" required>
                        </td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                <center><input type="submit" value="UPLOAD" class="btn btn-info" name="upload"></center>
                </form>
          </div>
        </section>
        <!--Live search AIMAN end -->

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
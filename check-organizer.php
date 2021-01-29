
<?php
require_once("dbconnect.php");


if(!empty($_POST["username"])) {
  $str = $_POST["username"];
  $query = "SELECT * FROM users WHERE username='" . $_POST["username"] . "'";
  $result = mysqli_query($conn,$query) or die('SQL error check USERNAME');
  if(strlen($str) > 4){
  if(mysqli_num_rows($result)>0) {
      echo "<span class='text-warning'> Username '" . $_POST["username"] . "' is not available.</span>";
  }else{
      echo "<span class='text-success'> Username is available.</span>";
  }
}
}
if(!empty($_POST["email"])) {
  $query = "SELECT * FROM users WHERE email='" . $_POST["email"] . "'";
  $result = mysqli_query($conn,$query) or die('SQL error check email');
  if(mysqli_num_rows($result)>0) {
      echo "<span class='text-warning'> Email is Already Registered.</span>";
  }
}
?>
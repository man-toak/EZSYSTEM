<?php

include 'dbconnect.php';

      if(isset($_POST['username1']))
      {
       $name=$_POST['username1'];

       $checkdata=" SELECT username FROM users WHERE username ='$name' ";
       $result = mysqli_query($conn,$checkdata) or die('SQL error USER'); 

       if(mysqli_num_rows($result)>0)
       {
        echo ("Username '$name' Already Exist!");
       }
       else
       {
        echo "Username is available!";
       }
       exit();
      }

?>

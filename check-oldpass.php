<?php
session_start();
	include 'dbconnect.php';
	if(!$conn){
       die("Failed to connnect:" . mysqli_connnect_error());
    } 
	if(isset($_POST['type']) == 1){
		$email = $_SESSION['email'];
		$password =md5($_POST['password']);
		 $query ="SELECT * FROM participant where email ='".$email."' && password = '".$password."' ";
		$result =mysqli_query($conn, $query);
		$rowcount=mysqli_num_rows($result);
		if($rowcount >0){
			echo "<div class=text-success><span class='status-not-available'> Correct!</span></div>";
		}else{
			 echo "<div class=text-warning><span class='status-available'> Oops! This is not your current password!</span></div>";
		}
	}
?>
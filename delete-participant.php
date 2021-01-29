<?php
		//TO ADD DATA
	  if (isset($_GET['ic'])) {
      $ic = $_GET['ic'];

			include 'dbconnect.php';

			$query = "INSERT INTO history_participant SELECT * FROM participant WHERE ic = $ic";
			$result = mysqli_query($conn,$query) or die ('phistory');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listparticipant.php");
			}
			else
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE FAILED')</script>";
		}
?>
<?php
		//TO ADD DATA
		if (isset($_GET['ic'])) {
      	$ic = $_GET['ic'];

			include 'dbconnect.php';

			$query1 = "DELETE FROM participant WHERE ic = $ic";
			$result1 = mysqli_query($conn,$query1) or die ('participant');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listparticipant.php");
			}
			else
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE FAILED')</script>";
		}
?>

<?php
		//TO ADD DATA
	  if (isset($_GET['pic'])) {
      $pic = $_GET['pic'];

			include 'dbconnect.php';

			$query = "INSERT INTO participant SELECT * FROM history_participant WHERE pic = $pic";
			$result = mysqli_query($conn,$query) or die ('phistory');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listparticipant.php");
			}
			else
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE FAILED')</script>";
		}
?>
<?php
		//TO ADD DATA
		if (isset($_GET['pic'])) {
      	$pic = $_GET['pic'];

			include 'dbconnect.php';

			$query1 = "DELETE FROM history_participant WHERE pic = $pic";
			$result1 = mysqli_query($conn,$query1) or die ('history_participant');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listparticipant.php");
			}
			else
				echo "<script type='text/javascript'>alert('PARTICIPANT DELETE FAILED')</script>";
		}
?>

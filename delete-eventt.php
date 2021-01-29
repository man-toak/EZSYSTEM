<?php
		//TO ADD DATA
	  if (isset($_GET['id'])) {
      $id = $_GET['id'];

			include 'dbconnect.php';

			$query = "INSERT INTO history_event SELECT * FROM events WHERE id = $id";
			$result = mysqli_query($conn,$query) or die ('event history');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('events DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listevent.php");
			}
			else
				echo "<script type='text/javascript'>alert('events DELETE FAILED')</script>";
		}
?>
<?php
		//TO ADD DATA
		if (isset($_GET['id'])) {
      	$id = $_GET['id'];

			include 'dbconnect.php';

			$query1 = "DELETE FROM events WHERE id = $id";
			$result1 = mysqli_query($conn,$query1) or die ('events');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('events DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listevent.php");
			}
			else
				echo "<script type='text/javascript'>alert('events DELETE FAILED')</script>";
		}
?>

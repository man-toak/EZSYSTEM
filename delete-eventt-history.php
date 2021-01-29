<?php
		//TO ADD DATA
	  if (isset($_GET['id'])) {
      $id = $_GET['id'];

			include 'dbconnect.php';

			$query = "INSERT INTO events SELECT * FROM history_event WHERE id = $id";
			$result = mysqli_query($conn,$query) or die ('masalah event');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('events DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listevent.php");
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

			$query1 = "DELETE FROM history_event WHERE id = $id";
			$result1 = mysqli_query($conn,$query1) or die ('history eventttt');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('events DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listevent.php");
			}
			else
				echo "<script type='text/javascript'>alert('events DELETE FAILED')</script>";
		}
?>

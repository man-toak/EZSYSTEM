<?php
		//TO ADD DATA
		if (isset($_GET['id'])) {
      		$id = $_GET['id'];

			include 'dbconnect.php';

			$query = "INSERT INTO resource SELECT * FROM history_resource WHERE id = $id";
			$result = mysqli_query($conn,$query) or die ('error sql insert resource');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('RESOURCE DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listresources.php");
			}
			else
				echo "<script type='text/javascript'>alert('RESOURCE DELETE FAILED')</script>";
		}
?>
<?php
		//TO ADD DATA
		if (isset($_GET['id'])) {
     	 	$id = $_GET['id'];

			include 'dbconnect.php';

			$query1 = "DELETE FROM history_resource WHERE id = $id";
			$result1 = mysqli_query($conn,$query1) or die ('error delete history');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('RESOURCE DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:deleted-listresources.php");
			}
			else
				echo "<script type='text/javascript'>alert('RESOURCE DELETE FAILED')</script>";
		}
?>

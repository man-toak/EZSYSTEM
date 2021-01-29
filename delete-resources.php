<?php
		//TO ADD DATA
		if (isset($_GET['id'])) {
      		$id = $_GET['id'];

			include 'dbconnect.php';

			$query = "INSERT INTO history_resource SELECT * FROM resource WHERE id = $id";
			$result = mysqli_query($conn,$query) or die ('error insert history');

			if ($result)
			{
				echo "<script type='text/javascript'>alert('RESOURCE DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listresources.php");
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

			$query1 = "DELETE FROM resource WHERE id = $id";
			$result1 = mysqli_query($conn,$query1) or die ('error sql delete resource');

			if ($result1)
			{
				echo "<script type='text/javascript'>alert('RESOURCE DELETE SUCCESS')</script>";
				echo "<meta http-equiv='refresh' content='0'>";
				header("Location:listresources.php");
			}
			else
				echo "<script type='text/javascript'>alert('RESOURCE DELETE FAILED')</script>";
		}
?>

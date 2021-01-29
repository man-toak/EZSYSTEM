<?php
//fetch.php
session_start();
include 'dbconnect.php';
$output = '';
if(isset($_POST["query"]))
{
 $organizer = $_SESSION['username'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM participant
  WHERE (ic LIKE '%".$search."%'
  OR name LIKE '%".$search."%'
  OR id LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
 $organizer = $_SESSION['username'];
 $query = "
  SELECT * FROM participant WHERE organizer='$organizer' ORDER BY name
 ";
}
$result = mysqli_query($conn, $query);
$bil=1;
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>NO.</th>
                        <th>NFC ID</th>
                        <th>NAME</th>
                        <th>IC</th>
                        <th>EMAIL</th>
                        <th>VIEW</th>
                        <th>DELETE</th>
                      </tr>
					</thead>
 ';
 while($row = mysqli_fetch_array($result))
 {
	 $ic = $row['ic'];
	 $name = $row['name'];
   $id = $row['id'];
	 $email = $row['email'];

  $output .= '
   <tr>
    <th>'.$bil.'</th>
    <td>'.$id.'</td>
    <td>'.$name.'</td>
    <td>'.$ic.'</td>
    <td>'.$email.'</td>
	<td><a href="info-participant.php?ic='.$ic.'" class="btn btn-info">View</a></td>
	<td><a href="" class="btn btn-danger delete" data-action="delete" data-body-message="Are you sure to delete this data?" data-redirect-url="delete-participant.php?ic='.$ic.'">Delete</a></td>
   </tr>
  ';
  $bil++;
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}
?>

<!--untuk guna onclick function -->
<script type="text/javascript">
function confirmDelete(){
return confirm('Are you sure you want to delete this?');
}
</script>

<script src="js/delete.js"></script>

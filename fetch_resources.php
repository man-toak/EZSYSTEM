<?php
//fetch.php
session_start();
include 'dbconnect.php';
$output = '';
if(isset($_POST["query"]))
{
 $organizer = $_SESSION['username'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM resource
  WHERE (name LIKE '%".$search."%'
  OR type LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
  $organizer = $_SESSION['username'];
 $query = "SELECT * FROM resource WHERE organizer='$organizer' ORDER BY name
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="box mt-0 mb-lg-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>NO.</th>
                        <th>NAME</th>
                        <th>TYPE</th>
                        <th>SIZE</th>
                        <th>VIEW</th>
                        <!--<th>REQUEST</th>-->
                        <th>Delete</th>
                      </tr>
					</thead>
 ';
 $bil=1;
 while($row = mysqli_fetch_array($result))
 {
	 $name = $row['name'];
	 $type = $row['type'];
   $id = $row['id'];
   $size = $row['size'];
   $file = $row['file'];

  $output .= '
   <tr>
    <th>'.$bil.'</th>
    <td>'.$name.'</td>
    <td>'.$type.'</td>
    <td>'.$size.' KB</td>
    <td><a class="btn btn-success btn-sm" href="resources/'.$file.'" target="_blank">View</a></td>
    <!--<td><a class="btn btn-info btn-sm" href="edit-resources.php?id='.$id.'">Edit</a></td>-->
    <!--<td><a class="btn btn-info btn-sm" href="request-resources.php?id='.$id.'">Request</a></td>-->
	<td><a href="" class="btn btn-danger btn-sm delete" data-action="delete" data-body-message="Are you sure to delete this data?" data-redirect-url="delete-resources.php?id='.$id.'">Delete</a></td>
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

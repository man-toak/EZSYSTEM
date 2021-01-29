<?php
//fetch.php
session_start();
include 'dbconnect.php';
$output = '';
if(isset($_POST["query"]))
{
 $organizer = $_SESSION['username'];
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM history_resource
  WHERE (name LIKE '%".$search."%'
  OR type LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
 $organizer = $_SESSION['username'];
 $query = "SELECT * FROM history_resource WHERE organizer='$organizer' ORDER BY name
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
                        <th>RECOVER</th>
                      </tr>
					</thead>
 ';
 $bil=1;
 while($row = mysqli_fetch_array($result))
 {
	 $name = $row['name'];
	 $type = $row['type'];
   $id = $row['id'];

  $output .= '
   <tr>
    <th>'.$bil.'</th>
    <td>'.$name.'</td>
    <td>'.$type.'</td>
	<td><a href="" class="btn btn-success recover" data-action="recover" data-body-message="Are you sure to recover this data?" data-redirect-url="delete-resources-history.php?id='.$id.'">Recover</a></td>
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


<script src="js/recover.js"></script>

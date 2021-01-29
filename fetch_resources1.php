<?php
//fetch.php
session_start();
include 'dbconnect.php';
$output = '';
$email = $_SESSION['email'];
$test = "SELECT * FROM participant WHERE email='$email' ";
$aa = mysqli_query($conn, $test) or die('SQL error participant');
$bb=mysqli_fetch_array($aa,MYSQLI_ASSOC);
$sai = $bb['organizer'];
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "SELECT * FROM resource
  WHERE (name LIKE '%".$search."%'
  OR type LIKE '%".$search."%')
  AND organizer='$sai'
 ";
}
else
{
  $email = $_SESSION['email'];
 $query = "SELECT a.*, b.* FROM participant a, resource b WHERE a.organizer=b.organizer AND email='$email'
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
    <!--<td><a class="btn btn-info" href="edit-resources.php?id='.$id.'">Request</a></td>-->
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

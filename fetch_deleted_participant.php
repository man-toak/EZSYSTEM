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
  SELECT * FROM history_participant
  WHERE (pic LIKE '%".$search."%'
  OR pname LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
 $organizer = $_SESSION['username'];
 $query = "
  SELECT * FROM history_participant WHERE organizer='$organizer' ORDER BY pname
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
                        <!--<th>VIEW</th>-->
                        <th>RECOVER</th>
                      </tr>
					</thead>
 ';
 while($row = mysqli_fetch_array($result))
 {
	 $pic = $row['pic'];
	 $pname = $row['pname'];
   $pid = $row['pid'];
	 $pemail = $row['pemail'];

  $output .= '
   <tr>
    <th>'.$bil.'</th>
    <td>'.$pid.'</td>
    <td>'.$pname.'</td>
    <td>'.$pic.'</td>
    <td>'.$pemail.'</td>
	<!--<td><a href="info-participant.php?ic='.$pic.'" class="btn btn-info">View</a></td>-->
	<td><a href="" class="btn btn-success recover" data-action="recover" data-body-message="Are you sure to recover this data?" data-redirect-url="delete-participant-history.php?pic='.$pic.'">Recover</a></td>
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

<script src="js/recover.js"></script>
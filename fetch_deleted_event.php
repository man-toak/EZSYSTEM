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
  SELECT * FROM history_event
  WHERE (id LIKE '%".$search."%'
  OR title LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
  $organizer = $_SESSION['username'];
 $query = "
  SELECT * FROM history_event WHERE organizer='$organizer' ORDER BY title
 ";
}
$result = mysqli_query($conn, $query);
$bil=1;
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="row">
 ';
 while($row = mysqli_fetch_array($result))
 {
	$title = $row['title'];
    $id = $row['id'];
	$date = $row['date'];
   $time = $row['time'];
    $venue = $row['venue'];

  $output .= '
   <div class="col-lg-4">
                <div class="user-block block text-center">
                  <a href="#" class="user-title">
                    <h3 class="h5">'.$title.'</h3><span>@'.$venue.'</span></a>
                  <div class="contributions">'.$date.'</div>
                  <br><div class="contributions">'.$time.'</div>
                  <div class="details d-flex">
                    <div class="item"><i class="fa fa-gg"></i><strong>'.$bil.'</strong></div>
                    <div class="item"><i class="icon-flow-branch"></i><strong>'.$id.'</strong></div>
                    <div class="item"><a href="" class="fa fa-arrow-up recover"  data-action="recover" data-body-message="Are you sure to recover this data?" data-redirect-url="delete-eventt-history.php?id='.$id.'"></a></div>
                  </div>
                </div>
              </div>
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

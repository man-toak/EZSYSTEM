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
  SELECT * FROM events
  WHERE (id LIKE '%".$search."%'
  OR title LIKE '%".$search."%')
  AND organizer='$organizer'
 ";
}
else
{
$organizer = $_SESSION['username'];
 $query = "
  SELECT * FROM events WHERE organizer='$organizer' ORDER BY date
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
	 $date = date_create($row['date']);
   $test = date_format($date,"jS F Y (D)");
   $time = date_create($row['time']);
   $masa= date_format($time,"h:i a");
   $time1 = date_create($row['end']);
   $habis= date_format($time1,"h:i a");
   $venue = $row['venue'];
   $seat = $row['seat'];

  $output .= '
   <div class="col-lg-4">
                <div class="user-block block text-center">
                  <div class="d-flex justify-content-end">
                      <a  href="edit-eventt.php?id='.$id.'" class="btn btn-info btn-sm">Edit</a>
                  </div>
                  <a href="info-event.php?id='.$id.'" class="user-title">
                    <h3 class="h5">'.$title.'</h3><span>@'.$venue.'</span></a>
                    <div class="contributions">'.$test.'</div>
                    <br><div class="contributions">'.$masa.' - '.$habis.'</div>
                    <div class="details d-flex">
                    <div class="item"><i class="fas fa-fingerprint"></i><strong>'.$bil.'</strong></div>
                    <div class="item"><i class="fas fa-chair"></i><strong>'.$seat.' left</strong></div>
                    <div class="item"><a href="" class="fas fa-trash-alt delete"  data-action="delete" data-body-message="Are you sure to delete this data?" data-redirect-url="delete-eventt.php?id='.$id.'"></a></div>
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

<!--untuk guna onclidk function -->
<script type="text/javascript">
function confirmDelete(){
return confirm('Are you sure you want to delete this?');
}
</script>

<script src="js/delete.js"></script>

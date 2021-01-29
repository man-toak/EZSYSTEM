<?php
//fetch.php
include 'dbconnect.php';
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM users
  WHERE username LIKE '%".$search."%'
  OR email LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM users ORDER BY username
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
	 $id = $row['id'];
   $username = $row['username'];
	 $email = $row['email'];

  $output .= '

              <div class="col-lg-4">
                <div class="user-block block text-center">
                <a href="organizer-page.php?id='.$username.'">
                  <div class="avatar"><img src="img/user.png" alt="organizer picture" class="img-fluid"></a>
                    <div class="order dashbg-2">'.$bil.'</div>
                  </div><a href="organizer-page.php?id='.$username.'" class="user-title">
                    <h3 class="h5">'.$username.'</h3><span>'.$email.'</span></a>
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

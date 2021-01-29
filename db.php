<?php
include 'dbconnect.php';

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
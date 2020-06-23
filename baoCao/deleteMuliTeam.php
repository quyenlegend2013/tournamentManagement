<?php
require "connect/connect.php";
if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  $sqlmartial = "DELETE FROM pugilist WHERE teamID = '$id'";
  $query = "DELETE FROM team WHERE teamID = '".$id."'";
  mysqli_query($conn, $sqlmartial);
  mysqli_query($conn, $query);
 }
}
$sqlnum = 'SELECT * FROM team';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

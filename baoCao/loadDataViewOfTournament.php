<?php
require "connect/connect.php";
$tourID = $_POST['tourID'];
$sql = "SELECT * FROM tournament t WHERE t.tourID='$tourID' ";
$retval = mysqli_query($conn, $sql);
$data =  array();
foreach($retval as $row)
{
	$data[] = $row;
}
echo json_encode($data);



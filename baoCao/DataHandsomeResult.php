<?php
require "connect/connect.php";
$tourID = $_POST['tourID'];
$sqlQuery = "SELECT * FROM (pugilist p INNER JOIN result r ON p.pugID=r.pugID) 
INNER JOIN team t ON p.teamID=t.teamID WHERE r.tourID='$tourID'";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

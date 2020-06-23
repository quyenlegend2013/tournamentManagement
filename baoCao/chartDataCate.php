<?php
header('Content-Type: application/json');
require "connect/connect.php";
$sqlcountkt="SELECT t.tourName,COUNT(tt.teamID) as 'dem' FROM tourteam tt INNER JOIN tournament t ON t.tourID=tt.tourID GROUP BY t.tourName";
$result = mysqli_query($conn,$sqlcountkt);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

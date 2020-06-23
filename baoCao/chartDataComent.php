<?php
require "connect/connect.php";
$sqlComent="SELECT t.tourName,COUNT(t.tourID) AS 'dem' FROM tournament t INNER JOIN tourcate tc ON t.tourID=tc.tourID GROUP BY t.tourID";
$result = mysqli_query($conn,$sqlComent);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

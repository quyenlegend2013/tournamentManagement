<?php
require "connect/connect.php";
$dkID = $_POST["dkID"];
$sqlQuery = "SELECT * FROM ((pugilist p INNER JOIN team t ON t.teamID = p.teamID) INNER JOIN dkpug dk ON dk.pugID=p.pugID) INNER JOIN dk d ON d.dkID=dk.dkID WHERE d.dkID='$dkID'";
$result = mysqli_query($conn,$sqlQuery);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

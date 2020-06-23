<?php
header('Content-Type: application/json');
require "connect/connect.php";
$sqlcountkt = "SELECT t.teamName,COUNT(t.teamID) AS 'dem' FROM team t INNER JOIN pugilist p ON t.teamID=p.teamID GROUP BY t.teamID";
$result = mysqli_query($conn, $sqlcountkt);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

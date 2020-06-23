<?php
header('Content-Type: application/json');
require "connect/connect.php";
$sqlcountkt="SELECT r.total,COUNT(r.total) as 'demPoint' FROM pugilist p INNER JOIN result r ON r.pugID=p.pugID GROUP BY r.total";
$result = mysqli_query($conn,$sqlcountkt);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);

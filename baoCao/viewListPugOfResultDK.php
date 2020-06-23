<?php
require('connect/connect.php');
$dkID = $_POST['dkID'];

$sql = "SELECT * FROM (pugilist p INNER JOIN team t ON t.teamID=p.teamID) INNER JOIN dkpug dk ON dk.pugID = p.pugID WHERE dk.dkID = '$dkID'";
$query = mysqli_query($conn, $sql);
$data = array();
foreach ($query as $row) {
    $data[] = $row;
}
echo json_encode($data);

<?php
require('connect/connect.php');
$tourID = $_POST['tourID'];

$sql = "SELECT * FROM pugilist p INNER JOIN result r ON r.pugID=p.pugID WHERE r.tourID = '$tourID'";
$query = mysqli_query($conn, $sql);
$data = array();
foreach ($query as $row) {
    $data[] = $row;
}
echo json_encode($data);

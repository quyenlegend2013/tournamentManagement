<?php
require("connect/connect.php");
$sid = $_POST["s"];
$sql = "select p.pugName,t.teamName from pugilist p INNER JOIN team t ON t.teamID=p.teamID where pugID='$sid'";
$querySql = mysqli_query($conn, $sql);
//$reval=mysqli_fetch_array($querySql);
$data = array();
foreach ($querySql as $row) {
    $data[] = $row;
}
echo json_encode($data);

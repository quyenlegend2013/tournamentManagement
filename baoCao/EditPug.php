<?php
require("connect/connect.php");
$pugID = $_POST["pugID"];
$sqlPug = "SELECT * FROM pugilist p INNER JOIN team t ON t.teamID=p.teamID  WHERE pugID='$pugID'";
$queryPug = mysqli_query($conn, $sqlPug);
$data = array();
foreach($queryPug as $row)
{
    $data[] = $row;
}
echo json_encode($data);

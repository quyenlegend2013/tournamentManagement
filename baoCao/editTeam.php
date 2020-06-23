<?php
require("connect/connect.php");
$teamID = $_POST["teamID"];
$sqlCate = "SELECT * FROM team WHERE teamID='$teamID'";
$queryCate = mysqli_query($conn, $sqlCate);
$data = array();
foreach ($queryCate as $row) {
    $data[] = $row;
}
echo json_encode($data);

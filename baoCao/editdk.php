<?php
require("connect/connect.php");
$dkID = $_POST["dkID"];
$sqlCate = "SELECT * FROM dk WHERE dkID='$dkID'";
$queryCate = mysqli_query($conn, $sqlCate);
$data = array();
foreach ($queryCate as $row) {
    $data[] = $row;
}
echo json_encode($data);

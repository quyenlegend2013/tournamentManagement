<?php
require("connect/connect.php");
$tourID = $_POST["tourID"];
$sqlTour = "SELECT * FROM tournament WHERE tourID='$tourID'";
$queryTour = mysqli_query($conn, $sqlTour);
$data = array();
foreach ($queryTour as $row) {
    $data[] = $row;
}
echo json_encode($data);

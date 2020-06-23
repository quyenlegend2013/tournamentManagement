<?php
require "connect/connect.php";
$tourID = $_GET['tourID'];
$cateID = $_GET['cateID'];

$sqlTourCate = "INSERT INTO tourcate(tourID,cateID) VALUES('$tourID','$cateID');";
$retvalTourCate = mysqli_query($conn, $sqlTourCate);

<?php
require "connect/connect.php";
$pugID = $_POST['pugID'];
$tourcateID = $_POST['tourcateID'];

$sqlPugTourCate = "INSERT INTO pugtourcate(pugID,tourcateID) VALUES('$pugID','$tourcateID')";
$retvalPugTourCate = mysqli_query($conn, $sqlPugTourCate);

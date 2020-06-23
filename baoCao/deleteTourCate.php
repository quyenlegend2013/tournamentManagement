<?php
require "connect/connect.php";
$tourID = $_GET['tourID'];
$tourcateID = $_GET['tourcateID'];

$sqlpugtourcate = "DELETE FROM pugtourcate WHERE tourcateID = '$tourcateID'";
$retvalpugtourteam = mysqli_query($conn, $sqlpugtourcate);

$sql = "DELETE FROM tourcate WHERE tourcateID = '$tourcateID'";
$retval = mysqli_query($conn, $sql);

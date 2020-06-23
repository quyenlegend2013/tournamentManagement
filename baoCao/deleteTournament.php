<?php
require "connect/connect.php";
$tourID = $_GET['tourID'];
$sql = "DELETE FROM tournament WHERE tourID = '$tourID' ";
$retval = mysqli_query($conn, $sql);
$sqlnum = 'SELECT * FROM tournament';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

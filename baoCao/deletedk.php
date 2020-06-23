<?php
require "connect/connect.php";
$dkID = $_POST['dkID'];
$sql = "DELETE FROM dk WHERE dkID = '$dkID' ";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM dk';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

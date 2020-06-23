<?php
require "connect/connect.php";
$pugID = $_GET['pugID'];
$sql = "DELETE FROM pugilist WHERE pugID = '$pugID' ";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM pugilist';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

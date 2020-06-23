<?php
require "connect/connect.php";
$teamID = $_GET['teamID'];
$sqlmartial = "DELETE FROM pugilist WHERE teamID = '$teamID'";
$sql = "DELETE FROM team WHERE teamID = '$teamID' ";
$retval = mysqli_query($conn, $sqlmartial);
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM team';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

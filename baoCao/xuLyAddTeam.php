<?php
require "connect/connect.php";
$teamName = $_POST["teamName"];
$teamLeader = $_POST["teamLeader"];
$teamDescription = $_POST["teamDescription"];
$sql = "insert into team(teamName,leader,teamDescription) values ('$teamName','$teamLeader','$teamDescription')";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM team';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

<?php
require "connect/connect.php";
$teamID = $_POST["teamName"];
$dob = $_POST["dob"];
$pugName = $_POST["pugName"];
$level = $_POST["level"];
$gender = $_POST["gender"];
//echo $gender;

$sql = "insert into pugilist(pugName,dob,gender,level,teamID) values ('$pugName','$dob','$gender','$level','$teamID')";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM pugilist';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

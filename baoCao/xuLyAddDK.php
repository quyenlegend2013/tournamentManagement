<?php
require "connect/connect.php";
$dkName = $_POST["dkName"];
$belongtoExam = $_POST["belongtoExam"];
$dkDescription = $_POST["dkDescription"];
$sql = "INSERT INTO dk(dkName,belongtoExam,dkDescription) VALUES ('$dkName','$belongtoExam','$dkDescription')";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM dk';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

<?php
require "connect/connect.php";
$tourName = $_POST["tourName"];
$organizers = $_POST["organizers"];
$accusative = $_POST["accusative"];
$role = $_POST["role"];
$object = $_POST["object"];
$place = $_POST["place"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$endTime = $_POST["endTime"];
$openingTime = $_POST["openingTime"];
$competitionTime = $_POST["competitionTime"];
$sql = "insert into tournament(tourName,organizers,accusative,role,object,place,email,phone,openingTime,endTime,competitionTime) 
    values ('$tourName','$organizers','$accusative','$role','$object','$place','$email','$phone','$openingTime','$endTime','$competitionTime')";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM tournament';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

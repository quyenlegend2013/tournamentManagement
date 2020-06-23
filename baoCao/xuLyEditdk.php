<?php
require "connect/connect.php";
$dkID = $_POST["dkID"];
$dkName = $_POST["dkName"];
$belongtoExam = $_POST["belongtoExam"];
$dkDescription = $_POST["dkDescription"];

$sql = "UPDATE dk SET dkName='$dkName',belongtoExam='$belongtoExam',dkDescription='$dkDescription' WHERE dkID='$dkID'";
$retval = mysqli_query($conn, $sql);

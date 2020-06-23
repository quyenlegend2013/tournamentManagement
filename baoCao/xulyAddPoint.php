<?php
require "connect/connect.php";

$pugID = $_POST["pugID"];
$tourID = $_POST["tourID"];

$exam1_f = $_POST["exam1_f"];
$exam2_f = $_POST["exam2_f"];
$exam3_f = $_POST["exam3_f"];
$exam4_f = $_POST["exam4_f"];
$exam5_f = $_POST["exam5_f"];
$total_f = $_POST["total_f"];

$exam1_s = $_POST["exam1_s"];
$exam2_s = $_POST["exam2_s"];
$exam3_s = $_POST["exam3_s"];
$exam4_s = $_POST["exam4_s"];
$exam5_s = $_POST["exam5_s"];
$total_s = $_POST["total_s"];

$total = $_POST["total"];

$sql = "insert into result(tourID,pugID,exam1_f,exam2_f,exam3_f,exam4_f,exam5_f,exam1_s,exam2_s,exam3_s,exam4_s,exam5_s,total_f,total_s,total,rank) values ('$tourID','$pugID','$exam1_f','$exam2_f','$exam3_f','$exam4_f','$exam5_f','$exam1_s','$exam2_s','$exam3_s','$exam4_s','$exam5_s','$total_f','$total_s','$total',0)";
$retval = mysqli_query($conn, $sql);

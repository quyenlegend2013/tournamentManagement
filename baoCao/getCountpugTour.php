<?php
require "connect/connect.php";
$tourID = $_POST['tourID'];
$sql = "SELECT * FROM pugtourcate ptc INNER JOIN tourcate tc ON tc.tourcateID = ptc.tourcateID WHERE tc.tourID = '$tourID'";
$querySql = mysqli_query($conn,$sql);
//$revalSql = mysqli_fetch_row($querySql);
$num = mysqli_num_rows($querySql);
echo $num;

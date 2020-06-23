<?php
require "connect/connect.php";

$cateName = $_POST["cateName"];
$cateSex = $_POST["cateSex"];
$cateDescription = $_POST["cateDescription"];

$sql = "insert into categories(cateName,cateSex,cateDescription) values ('$cateName','$cateSex','$cateDescription')";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM categories';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

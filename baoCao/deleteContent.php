<?php
require "connect/connect.php";
$cateID = $_GET['cateID'];
$sql = "DELETE FROM categories WHERE cateID = '$cateID' ";
$retval = mysqli_query($conn, $sql);

$sqlnum = 'SELECT * FROM categories';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

<?php
require "connect/connect.php";
$cateID = $_POST["cateID"];
$cateName = $_POST["cateName"];
$cateSex = $_POST["cateSex"];
$cateDescription = $_POST["cateDescription"];

$sql = "UPDATE categories SET cateName='$cateName',cateSex = '$cateSex',cateDescription='$cateDescription' WHERE cateID='$cateID'";
$retval = mysqli_query($conn, $sql);

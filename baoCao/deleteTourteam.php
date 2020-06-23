<?php
    require "connect/connect.php";
    
    $tourID = $_GET['tourID'];
	$cateID = $_GET['teamID'];
	$tourteamID = $_GET["tourteamID"];

	$sqlpugtourteam = "DELETE FROM pugtourteam WHERE tourteamID = '$tourteamID'";
	$retvalpugtourteam=mysqli_query($conn,$sqlpugtourteam);

	$sql="DELETE FROM tourteam WHERE tourteamID = '$tourteamID'";
	$retval=mysqli_query($conn,$sql);

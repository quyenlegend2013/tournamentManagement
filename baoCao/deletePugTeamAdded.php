<?php
	require "connect/connect.php";
    $pugID =$_POST['pugID'];
    $tourteamID =$_POST['tourteamID'];
	$sql="DELETE FROM pugtourteam WHERE pugID = '$pugID' AND tourteamID = '$tourteamID'";
	$retval=mysqli_query($conn,$sql);

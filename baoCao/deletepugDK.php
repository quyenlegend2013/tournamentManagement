<?php
	require "connect/connect.php";
    $pugID =$_POST['pugID'];
    $dkID =$_POST['dkID'];
	$sql="DELETE FROM dkpug WHERE pugID = '$pugID' AND dkID = '$dkID'";
	$retval=mysqli_query($conn,$sql);

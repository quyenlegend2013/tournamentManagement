<?php
require("connect/connect.php");
$dkID = $_POST["dkID"];
$pugID = $_POST["pugID"];
$sql = "INSERT dkpug(pugID,dkID) values('.$pugID.','.$dkID.')";
$query = mysqli_query($conn,$sql);

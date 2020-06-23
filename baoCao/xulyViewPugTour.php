<?php
require "connect/connect.php";
$pugID = $_POST["pugID"];
$tourteamID = $_POST["tourteamID"];
$sqlPugtour = "INSERT INTO pugtourteam(pugID,tourteamID) VALUES('$pugID','$tourteamID')";
$retvalPugtour = mysqli_query($conn, $sqlPugtour);

<?php
require "connect/connect.php";
$tourID = $_GET['tourID'];
$teamID = $_GET['teamID'];

$sqlTourTeam = "INSERT INTO tourteam(tourID,teamID) VALUES('$tourID','$teamID');";
$retvalTourTeam = mysqli_query($conn, $sqlTourTeam);

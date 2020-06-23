<?php
require "connect/connect.php";
$tourID = $_POST["tourID"];
$tourName = $_POST["tourName"];
$organizers = $_POST["organizers"];
$accusative = $_POST["accusative"];
$role = $_POST["role"];
$object = $_POST["object"];
$place = $_POST["place"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$endTime = $_POST["endTime"];
$openingTime = $_POST["openingTime"];
$competitionTime = $_POST["competitionTime"];
$sql = "UPDATE tournament SET tourName='$tourName',organizers='$organizers',accusative='$accusative',role='$role',object='$object',place='$place',email='$email',phone='$phone',openingTime='$openingTime',endTime='$endTime',competitionTime='$competitionTime' WHERE tourID='$tourID'";
$retval = mysqli_query($conn, $sql);

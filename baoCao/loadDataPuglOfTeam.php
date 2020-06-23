<?php
require "connect/connect.php";
$teamID = $_POST['teamID'];
$sql = "SELECT * FROM (pugilist p  INNER JOIN team t ON t.teamID = p.teamID) WHERE t.teamID='$teamID' ";
$retval = mysqli_query($conn, $sql);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {
	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
	echo "</tr>";
	$stt++;
}

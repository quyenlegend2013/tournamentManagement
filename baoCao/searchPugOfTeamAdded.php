<?php
require("connect/connect.php");
$tourteamID = $_POST["tourteamID"];
$search = $_POST["data"];
$sql = "SELECT * FROM (pugtourteam ptt INNER JOIN pugilist p ON p.pugID=ptt.pugID) INNER JOIN team t ON t.teamID=p.teamID WHERE p.pugName LIKE '%$search%' AND ptt.tourteamID='$tourteamID'";
$querySql = mysqli_query($conn, $sql);
$stt = 1;
while ($rs = mysqli_fetch_assoc($querySql)) {
	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo '<td><button type="button" class="btn btn-danger" onclick="deletePugAdded(' . $rs["pugID"] . ',' . $tourteamID . ');"><i class="fas fa-user-minus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

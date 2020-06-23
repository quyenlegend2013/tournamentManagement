<?php
require "connect/connect.php";
$tourteamID = $_POST["tourteamID"];
$teamID = $_POST["teamID"];
$tourID = $_POST["tourID"];
$search = $_POST["data"];
$sqlp		=	"SELECT * FROM team t INNER JOIN pugilist p ON p.teamID = t.teamID WHERE p.pugName LIKE '%$search%' AND t.teamID='$teamID' AND NOT EXISTS (SELECT r.pugID FROM result r WHERE r.pugID=p.pugID AND r.tourID='$tourID')";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {
	$sqlPrepare		=	'SELECT * FROM pugtourteam ptt WHERE ptt.tourteamID= ' . $tourteamID . ' AND ptt.pugID=' . $rs["pugID"];
	$retvalPrepare = mysqli_query($conn, $sqlPrepare);
	$num = mysqli_num_rows($retvalPrepare);
	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='" . $rs["pugID"] ."'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo ($num>0)?'<td><a onclick="error()"><button type="button" class="btn btn-success" disabled onclick="error();" ><i class="far fa-check-square"></i></button></a></td>':'<td><button type="button" class="btn btn-success" onclick="insertTourPugTeam(' . $rs["pugID"] . ',\'' . $tourteamID . '\')" ><i class="fas fa-user-plus"></i></button></td>';
	echo "</tr>";
	$stt++;
}
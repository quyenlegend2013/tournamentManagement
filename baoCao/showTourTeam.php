<?php
require "connect/connect.php";
$tourID = $_POST["tourID"];
$sqlp		=	"SELECT * FROM tourteam tt INNER JOIN team t ON t.teamID = tt.teamID WHERE tt.tourID = '$tourID'";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo "<td>" . $rs["leader"] . "</td>";
	echo "<td>" . $rs["teamDescription"] . "</td>";
	echo '<td><a href="viewPugTeam.php?tourteamID=' . $rs["tourteamID"] . '&teamID=' . $rs["teamID"] . '&tourID=' . $tourID . '"><button id="s" type="button" class="btn btn-success"><i class="far fa-list-alt"></i></button></a></td>';
	echo '<td><button type="button" class="btn btn-danger" onclick="deleteTourTeam(' . $rs["teamID"] . ',\'' . $rs["tourID"] . '\',\'' . $rs["tourteamID"] . '\')" ><i class="fas fa-user-minus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

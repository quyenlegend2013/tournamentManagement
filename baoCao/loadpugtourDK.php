<?php
require "connect/connect.php";
$tourID = $_POST["tourID"];

$sqlp		=	"SELECT * FROM pugilist p INNER JOIN team t ON t.teamID=p.teamID WHERE  NOT EXISTS (SELECT tdk.pugID FROM tourdk tdk WHERE tdk.pugID = p.pugID) ";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . $rs["dob"] . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" onclick="inserttourDK(' . $rs["pugID"] . ',' . $tourID . ')"><i class="fas fa-user-plus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

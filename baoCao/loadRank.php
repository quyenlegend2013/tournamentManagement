<?php
require "connect/connect.php";
$tourID = $_POST['tourID'];
$sqlp		=	"select * from pugilist p INNER JOIN result r ON r.pugID=p.pugID WHERE r.tourID = '$tourID' ORDER BY r.total DESC";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	if ($stt == 1) {
		echo "<td style='color:#F00;'>" . $stt . "</td>";
	} else {
		echo "<td>" . $stt . "</td>";
	}
	echo "<td>" . $rs["pugID"] . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . $rs["total"] . "</td>";
	echo "</tr>";
	$stt++;
}

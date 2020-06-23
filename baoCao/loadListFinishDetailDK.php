<?php
require "connect/connect.php";
$sql		=	"SELECT * FROM dkpug ddk INNER JOIN pugilist p ON ddk.pugID=p.pugID";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_POST["i"];
$dkID = $_POST["dkID"];

$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"SELECT * FROM (dkpug ddk INNER JOIN pugilist p ON ddk.pugID=p.pugID) INNER JOIN team t ON t.teamID=p.teamID WHERE ddk.dkID= $dkID limit $currentpage1, $pagesize";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deletedkpug(' . $rs["pugID"] . ',' . $dkID . ');"><i class="fas fa-minus"></i></button></td>';

	echo "</tr>";
	$stt++;
}

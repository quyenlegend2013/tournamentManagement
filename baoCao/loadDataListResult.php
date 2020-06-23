<?php
require "connect/connect.php";
$sql		=	"SELECT * FROM tournament";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_GET["i"];


$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"SELECT * FROM tournament ";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
//$stt=1;
while ($rs = mysqli_fetch_assoc($retval)) {
	$sqlr		=	'SELECT * FROM result r WHERE tourID=' . $rs["tourID"];
	$retvalr = mysqli_query($conn, $sqlr);
	$num = mysqli_num_rows($retvalr);
	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["tourName"] . "</td>";
	echo "<td>" . date("d-m-Y h:m:s", strtotime($rs["openingTime"])) . "</td>";
	echo "<td>" . date("d-m-Y h:m:s", strtotime($rs["endTime"])) . "</td>";
	echo "<td>" . $rs["competitionTime"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="passModel(' . $rs["tourID"] . ',\'' . $rs["tourName"] . '\')"><i class="far fa-list-alt"></i></button></td>';
	echo ($num == 0) ? '<td></td>' : '<td><span class="badge badge-primary">Poined</span></td>';
	echo "</tr>";
	$stt++;
}

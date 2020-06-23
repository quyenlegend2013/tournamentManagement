<?php
require "connect/connect.php";
$tourID = $_POST["tourID"];
$sqlp		=	"SELECT * FROM categories";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {
	$sqlPrepare		=	'SELECT * FROM tourcate tc WHERE tc.tourID= ' . $tourID . ' AND tc.cateID=' . $rs["cateID"];
	$retvalPrepare = mysqli_query($conn, $sqlPrepare);
	$num = mysqli_num_rows($retvalPrepare);

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["cateName"] . "</td>";
	echo "<td>" . $rs["cateDescription"] . "</td>";
	echo ($num > 0) ? '<td><a onclick="error();"><button type="button" class="btn btn-success" disabled ><i class="far fa-check-square"></i></button></a></td>' : '<td><button id="s" type="button" class="btn btn-success" onclick="insertTourCate(' . $rs["cateID"] . ',' . $tourID . ')"><i class="fas fa-user-plus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

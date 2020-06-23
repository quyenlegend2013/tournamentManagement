<?php
require "connect/connect.php";

$sql		=	"SELECT * FROM tournament";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_GET["i"];
$datecurrent = date("Y/m/d");
$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"SELECT * FROM tournament  t";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($rs = mysqli_fetch_assoc($retval)) {
	if (strtotime($datecurrent) > strtotime($rs["endTime"])) {

		echo "<tr>";
		echo "<td>" . $stt . "</td>";
		echo "<td>" . $rs["tourName"] . "</td>";
		echo "<td>" . $rs["organizers"] . "</td>";
		echo "<td>" . $rs["accusative"] . "</td>";
		echo '<td><a onclick="errorSetting();"><button type="button" disabled onclick="location.href=\'chamdiemquyen.php?tourID=' . $rs["tourID"] . '\'" class="btn btn-success"><i class="fas fa-flag"></i></button></a></td>';
		echo '<td><span class="badge badge-danger">Ket thuc</span></td>';
		echo "</tr>";
		$stt++;
	} else {
		echo "<tr>";
		echo "<td>" . $stt . "</td>";
		echo "<td>" . $rs["tourName"] . "</td>";
		echo "<td>" . $rs["organizers"] . "</td>";
		echo "<td>" . $rs["accusative"] . "</td>";
		echo '<td><a href="chamdiemquyen.php?tourID=' . $rs["tourID"] . '"><button type="button" class="btn btn-success"><i class="fas fa-flag"></i></button></a></td>';
		if (strtotime($datecurrent) >= strtotime($rs["openingTime"]) and strtotime($datecurrent) <= strtotime($rs["endTime"])) {
			echo '<td><span class="badge badge-success">đang dien ra</span></td>';
		} else if (strtotime($datecurrent) < strtotime($rs["openingTime"])) {
			echo '<td><span class="badge badge-primary">Sap dien ra</span></td>';
		}
		echo "</tr>";
		$stt++;
	}
}

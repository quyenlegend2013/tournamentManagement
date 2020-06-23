<?php
require "connect/connect.php";

$sql		=	"select * from team";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_GET["i"];

$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"select * from team limit $currentpage1, $pagesize";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($rs = mysqli_fetch_assoc($retval)) {
	$sqlCountPug = "SELECT COUNT(p.pugID) as 'count' FROM team t INNER JOIN pugilist p ON p.teamID=t.teamID WHERE t.teamID=" . $rs["teamID"];
	$queryCountPug = mysqli_query($conn, $sqlCountPug);
	$revalCountPug = mysqli_fetch_array($queryCountPug);

	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='" . $rs["teamID"] . "'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo "<td>" . $rs["leader"] . "</td>";
	echo "<td>" . $rs["teamDescription"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" onclick="pass(' . $rs["teamID"] . ',\'' . $rs["teamName"] . '\');" data-toggle="modal" data-target=".bd-example-modal-lg" >' . $revalCountPug["count"] . '</button></td>';
	echo '<td><button type="button" class="btn btn-warning" onclick=passTeamID(' . $rs["teamID"] . '); data-toggle="modal" data-target="#exampleModalCenter1" ><i class="fas fa-edit"></i></button></td>';
	echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteTeam(' . $rs["teamID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
	echo "</tr>";
	$stt++;
}

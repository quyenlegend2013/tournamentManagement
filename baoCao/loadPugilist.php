<?php
require "connect/connect.php";
$sql		=	"select * from pugilist";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_GET["i"];

$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"select * from pugilist p INNER JOIN team t ON t.teamID=p.teamID limit $currentpage1, $pagesize";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='" . $rs["pugID"] . "'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo '<td><button type="button" class="btn btn-warning" onclick=passPugID(' . $rs["pugID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-edit"></i></button></td>';
	echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deletePugilist(' . $rs["pugID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
	echo "</tr>";
	$stt++;
}

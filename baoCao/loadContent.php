<?php
require "connect/connect.php";

$sql		=	"select * from categories";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$currentpage	= $_GET["i"];

$currentpage1	= ($currentpage - 1) * $pagesize;
$sqlp		=	"select * from categories limit $currentpage1, $pagesize";
$retval = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='" . $rs["cateID"] . "'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["cateName"] . "</td>";
	echo "<td>" . $rs["cateSex"] . "</td>";
	echo "<td>" . $rs["cateDescription"] . "</td>";
	echo '<td><button type="button" class="btn btn-warning" onclick=passCateID(' . $rs["cateID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-edit"></i></button></td>';
	echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteContent(' . $rs["cateID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
	echo "</tr>";
	$stt++;
}

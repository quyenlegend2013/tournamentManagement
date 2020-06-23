<?php
require "connect/connect.php";
$data = $_POST["data"];

$sqlp		=	"SELECT * FROM tournament  WHERE tourName LIKE '%$data%' ";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
$datecurrent = date("Y/m/d");
while ($rs = mysqli_fetch_assoc($retval)) {
	if(strtotime($datecurrent) > strtotime($rs["endTime"]))
	{
	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='".$rs["tourID"]."'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["tourName"] . "</td>";
	echo "<td>" . $rs["organizers"] . "</td>";
	echo "<td>" . $rs["accusative"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" onclick=pass(' . $rs["tourID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="far fa-list-alt"></i></button></td>';
	echo '<td><a onclick="errorEdit();" ><button type="button" class="btn btn-warning" disabled onclick="location.href=\'editTournament.php?tourID=' . $rs["tourID"] . '\'"><i class="fas fa-edit"></i></button></a></td>';
	echo '<td><button type="button" id="delete" class="btn btn-danger"  onclick="deleteTournament(' . $rs["tourID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
	echo '<td><a onclick="errorSetting();"><button type="button"  class="btn btn-secondary" disabled onclick="location.href=\'detailTour.php?tourID='. $rs["tourID"] .'\'"><i class="far fa-sun"></i></button></a></td>';
	echo '<td><span class="badge badge-danger">Ket thuc</span></td>';
	echo "</tr>";
	}
	else
	{
	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='".$rs["tourID"]."'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["tourName"] . "</td>";
	echo "<td>" . $rs["organizers"] . "</td>";
	echo "<td>" . $rs["accusative"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" onclick=pass(' . $rs["tourID"] . '); data-toggle="modal" data-target="#exampleModalCenter" ><i class="far fa-list-alt"></i></button></td>';
	echo '<td><button type="button" class="btn btn-warning" onclick=passtourID(' . $rs["tourID"] . '); data-toggle="modal" data-target="#exampleModalCenter1" ><i class="fas fa-edit"></i></button></td>';
	echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteTournament(' . $rs["tourID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
	echo '<td><a href="detailTour.php?tourID=' . $rs["tourID"] . '"><button type="button" class="btn btn-secondary"><i class="far fa-sun"></i></button></a></td>';
	if (strtotime($datecurrent) >= strtotime($rs["openingTime"]) and strtotime($datecurrent) <= strtotime($rs["endTime"])) {
		echo '<td><span class="badge badge-success">đang dien ra</span></td>';
	} else if(strtotime($datecurrent) < strtotime($rs["openingTime"]))
	{
		echo '<td><span class="badge badge-primary">Sap dien ra</span></td>';	
	}
	echo "</tr>";
}
	$stt++;
}

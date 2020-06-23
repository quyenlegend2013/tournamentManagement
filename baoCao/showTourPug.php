<?php
require "connect/connect.php";
$tourcateID = $_POST["tourcateID"];
$tourID = $_POST["tourID"];
$cateSex = $_POST["cateSex"];
$sqlp		=	" SELECT * FROM (((pugtourteam ptt INNER JOIN tourteam tt ON tt.tourteamID = ptt.tourteamID)
 INNER JOIN tournament tnm ON tnm.tourID = tt.tourID)
  INNER JOIN tourcate tc ON tnm.tourID = tc.tourID)
  INNER JOIN pugilist p ON p.pugID = ptt.pugID 
  WHERE p.gender = '$cateSex' AND tc.tourcateID = '$tourcateID' AND tt.tourID = '$tourID'";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	$sqlPrepare		=	'SELECT * FROM pugtourcate ptc INNER JOIN tourcate tc ON tc.tourcateID = ptc.tourcateID WHERE  ptc.pugID=' . $rs["pugID"].' AND ptc.tourcateID='.$tourcateID;
	$retvalPrepare = mysqli_query($conn, $sqlPrepare);
	$num = mysqli_num_rows($retvalPrepare);
	echo "<tr>";
	echo "<td><input type ='checkbox' id='checkk' value='" . $rs["pugID"] ."'/></td>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . date("d-m-Y",strtotime($rs["dob"])) . "</td>";
	echo "<td>" . $rs["gender"] . "</td>";
	echo ($num>0)?'<td><a onclick="error()"><button type="button" class="btn btn-success" disabled onclick="error();" ><i class="far fa-check-square"></i></button></a></td>':'<td><button type="button" class="btn btn-success" onclick="insertTourPugCate(' . $rs["pugID"] . ',\'' . $tourcateID . '\')" ><i class="fas fa-user-plus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

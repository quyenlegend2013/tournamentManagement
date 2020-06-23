<?php
require "connect/connect.php";

$tourID = $_POST["tourID"];
$sqlp		= "SELECT * FROM (((((pugilist p INNER JOIN pugtourteam ptt ON ptt.pugID = p.pugID) 
	INNER JOIN pugtourcate ptc ON ptc.pugID = p.pugID)
	 INNER JOIN tourcate tc ON tc.tourcateID = ptc.tourcateID)
	 INNER JOIN categories c ON c.cateID = tc.cateID)
	  INNER JOIN team t ON t.teamID = p.teamID)
	 INNER JOIN tourteam tt ON ptt.tourteamID =tt.tourteamID 
	WHERE tt.tourID = '$tourID' AND tc.tourID = '$tourID' AND NOT EXISTS (SELECT * FROM result r WHERE p.pugID = r.pugID AND r.tourID ='$tourID')";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["pugName"] . "</td>";
	echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
	echo "<td>" . $rs["teamName"] . "</td>";
	echo "<td>" . $rs["cateName"] . "</td>";
	echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="sid(' . $rs["pugID"] . ')">Point</button></td>';
	echo "</tr>";
	$stt++;
}

<?php
require "connect/connect.php";
$a = $_POST['data'];
//echo $a;
$sql = "select * from team where teamName like '%$a%'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if ($num > 0) {
	$stt = 1;
	while ($rs = mysqli_fetch_assoc($query)) {
		echo "<tr>";
		echo "<td><input type ='checkbox' id='checkk' value='" . $rs["teamID"] . "'/></td>";
		echo "<td>" . $stt . "</td>";
		echo "<td>" . $rs["teamName"] . "</td>";
		echo "<td>" . $rs["leader"] . "</td>";
		echo "<td>" . $rs["teamDescription"] . "</td>";
		echo '<td><button type="button" class="btn btn-success" onclick=pass(' . $rs["teamID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="far fa-list-alt"></i></button></td>';
		echo '<td><button type="button" class="btn btn-warning" onclick=passTeamID(' . $rs["teamID"] . '); data-toggle="modal" data-target="#exampleModalCenter1" ><i class="fas fa-edit"></i></button></td>';
		echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteTeam(' . $rs["teamID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
		echo "</tr>";
		$stt++;
	}
}

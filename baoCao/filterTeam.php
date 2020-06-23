<?php
require "connect/connect.php";
$filterr = $_POST["filterr"];
$sql = "SELECT * FROM team t INNER JOIN pugilist p ON p.teamID=t.teamID WHERE t.teamName= '$filterr'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if ($num > 0) {
	$stt = 1;
	while ($rs = mysqli_fetch_assoc($query)) {
		echo "<tr>";
		echo "<td><input type ='checkbox' id='checkk' value='" . $rs["pugID"] . "'/></td>";
		echo "<td>" . $stt . "</td>";
		echo "<td>" . $rs["pugName"] . "</td>";
		echo "<td>" . $rs["dob"] . "</td>";
		echo "<td>" . $rs["teamName"] . "</td>";
		echo '<td><button type="button" id="edit" class="btn btn-warning" onclick="location.href=\'editPug.php?pugID=' . $rs["pugID"] . '\'"><i class="fas fa-edit"></i></button></td>';
		echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deletePugilist(' . $rs["pugID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
		echo "</tr>";
		$stt++;
	}
}

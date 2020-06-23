<?php
require "connect/connect.php";
$a = $_POST['data'];
//echo $a;
$sql = "SELECT * FROM pugilist p INNER JOIN team t ON t.teamID=p.teamID where pugName like '%$a%'";
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
		echo '<td><button type="button" id="edit" class="btn btn-warning" onclick="location.href=\'editCandidate.php?studentID=' . $rs["pugID"] . '\'"><i class="fas fa-edit"></i></button></td>';
		echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteStudent(' . $rs["pugID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
		echo "</tr>";
		$stt++;
	}
}

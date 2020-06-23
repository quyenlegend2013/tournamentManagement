<?php
require "connect/connect.php";
$a = $_POST['data'];
//echo $a;
$sql = "select * from categories where cateName like '%$a%'";
$query = mysqli_query($conn, $sql);
$num = mysqli_num_rows($query);
if ($num > 0) {
	$stt = 1;
	while ($rs = mysqli_fetch_assoc($query)) {

		echo "<tr>";
		echo "<td><input type ='checkbox' id='checkk' value='" . $rs["cateID"] . "'/></td>";
		echo "<td>" . $stt . "</td>";
		echo "<td>" . $rs["cateName"] . "</td>";
		echo "<td>" . $rs["cateDescription"] . "</td>";
		echo '<td><button type="button" class="btn btn-warning" onclick="location.href=\'editContent.php?cateID=' . $rs["cateID"] . '\'"><i class="fas fa-edit"></i></button></td>';
		echo '<td><button type="button" id="delete" class="btn btn-danger" onclick="deleteContent(' . $rs["cateID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
		echo "</tr>";
		$stt++;
	}
}

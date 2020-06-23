<?php
require "connect/connect.php";
$tourID = $_POST["tourID"];
$sqlp		=	"SELECT * FROM tourcate t INNER JOIN categories c ON c.cateID = t.cateID WHERE t.tourID = '$tourID'";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {

	echo "<tr>";
	echo "<td>" . $stt . "</td>";
	echo "<td>" . $rs["cateName"] . "</td>";
	echo "<td>" . $rs["cateDescription"] . "</td>";
	echo '<td><a href="viewPugCate.php?tourcateID=' . $rs["tourcateID"] . '&tourID=' . $tourID . '&cateSex=' . $rs["cateSex"] . '"><button id="s" type="button" class="btn btn-success"><i class="far fa-list-alt"></i></button></a></td>';
	echo '<td><button type="button" class="btn btn-danger" onclick="deleteTourCate(' . $rs["tourcateID"] . ',' . $tourID . ')" ><i class="fas fa-user-minus"></i></button></td>';
	echo "</tr>";
	$stt++;
}

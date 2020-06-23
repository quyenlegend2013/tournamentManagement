<?php
require("connect/connect.php");
$dkID = $_POST["dkID"];
$tim = $_POST["tim"];
$sql = "SELECT * FROM pugilist p  INNER JOIN team t ON t.teamID = p.teamID WHERE p.pugName LIKE '%$tim%'";
$querysql = mysqli_query($conn, $sql);
$stt = 1;
while ($row = mysqli_fetch_assoc($querysql)) {
    $sqlPrepare    =  'SELECT * FROM dkpug d WHERE d.dkID= ' . $dkID . ' AND d.pugID=' . $row["pugID"];
    $retvalPrepare = mysqli_query($conn, $sqlPrepare);
    $num = mysqli_num_rows($retvalPrepare);
    echo "<tr>";
    echo "<td><input type ='checkbox' id='checkk' value='".$row["pugID"]."'/></td>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["pugName"] . "</td>";
    echo "<td>" . $row["dob"] . "</td>";
    echo "<td>" . $row["teamName"] . "</td>";
    echo ($num > 0) ? '<td><a onclick="error();"><button type="button" class="btn btn-success" disabled ><i class="far fa-check-square"></i></button></a></td>':'<td><button id="s" type="button" class="btn btn-success" onclick="insertDetailDK(' . $row["pugID"] . ',' . $dkID . ')"><i class="fas fa-user-plus"></i></button></td>';
    echo "</tr>";
    $stt++;
}

<?php
require("connect/connect.php");
$dkID = $_POST["dkID"];
$tourID = $_POST["tourID"];
if ($tourID == 0 || $tourID==1) {
    $sql = "SELECT * FROM pugilist p  INNER JOIN team t ON t.teamID = p.teamID";
} else {
    $sql = "SELECT * FROM ((pugilist p  INNER JOIN pugtourteam ptt ON p.pugID = ptt.pugID) INNER JOIN tourteam tt ON tt.tourteamID = ptt.tourteamID) INNER JOIN team t ON t.teamID = p.teamID WHERE tt.tourID = '$tourID'";
}
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
    echo "<td>" . date("d-m-Y", strtotime($row["dob"])) . "</td>";
    echo "<td>" . $row["teamName"] . "</td>";
    echo ($num > 0) ? '<td><a onclick="error();"><button type="button" class="btn btn-success" disabled ><i class="far fa-check-square"></i></button></a></td>' : '<td><button id="s" type="button" class="btn btn-success" onclick="insertDetailDK(' . $row["pugID"] . ',' . $dkID . ')"><i class="fas fa-user-plus"></i></button></td>';
    echo "</tr>";
    $stt++;
}

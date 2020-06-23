<?php
require("connect/connect.php");
$tourcateID = $_POST["tourcateID"];
$sql = "SELECT * FROM pugtourcate ptc INNER JOIN pugilist p ON p.pugID=ptc.pugID WHERE ptc.tourcateID='$tourcateID'";
$query = mysqli_query($conn, $sql);
$stt = 1;
while ($rs = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $rs["pugName"] . "</td>";
    echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
    echo "<td>" . $rs["gender"] . "</td>";
    echo '<td><button type="button" class="btn btn-danger" onclick="deletePugAdded(' . $rs["pugID"] . ',' . $tourcateID . ');"><i class="fas fa-user-minus"></i></button></td>';
    echo "</tr>";
    $stt++;
}

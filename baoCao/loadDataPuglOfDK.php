<?php
require "connect/connect.php";
$dkID = $_POST['dkID'];
$sql = "SELECT * FROM pugilist p  INNER JOIN dkpug d ON d.pugID = p.pugID WHERE d.dkID='$dkID' ";
$retval = mysqli_query($conn, $sql);
$stt = 1;
while ($rs = mysqli_fetch_assoc($retval)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $rs["pugName"] . "</td>";
    echo "<td>" . date("d-m-Y", strtotime($rs["dob"])) . "</td>";
    echo "</tr>";
    $stt++;
}

<?php
require("connect/connect.php");
$sql = "SELECT * FROM dk";
$querysql = mysqli_query($conn, $sql);
$stt = 1;
while ($row = mysqli_fetch_assoc($querysql)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["dkName"] . "</td>";
    echo "<td>" . $row["belongtoExam"] . "</td>";
    echo "<td>" . $row["dkDescription"] . "</td>";
    echo "<td><a href='ChamDiem.php?dkID=" . $row["dkID"] . " '><button type='button' class='btn btn-success'><i class='far fa-flag'></i></button></a></td>";
    echo "</tr>";
    $stt++;
}

<?php
require("connect/connect.php");

$a    = $_POST["data"];
$sqlp = "SELECT *FROM dk WHERE dkName LIKE '%$a%'";
$query = mysqli_query($conn, $sqlp);
$stt = 1;
while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["dkName"] . "</td>";
    echo "<td>" . $row["belongtoExam"] . "</td>";
    echo "<td>" . $row["dkDescription"] . "</td>";
    echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="passModel(' . $row["dkID"] . ',\'' . $row["dkName"] . '\')"><i class="far fa-list-alt"></i></button></td>';
    echo "</tr>";
    $stt++;
}

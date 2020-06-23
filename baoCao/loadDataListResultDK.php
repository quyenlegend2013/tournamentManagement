<?php
require("connect/connect.php");
$sql        =    "SELECT * FROM dk";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$currentpage    = $_POST["i"];

$currentpage1    = ($currentpage - 1) * $pagesize;
$sqlp = "SELECT *FROM dk";
$query = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($row = mysqli_fetch_assoc($query)) {
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["dkName"] . "</td>";

    if ($row["belongtoExam"] == 0 || $row["belongtoExam"] == 1) {
        echo "<td>No</td>";
    } else {
        $sqltourName  = "SELECT tourName FROM tournament WHERE tourID = " . $row["belongtoExam"];
        $querytourName = mysqli_query($conn, $sqltourName);
        $revalTourName = mysqli_fetch_array($querytourName);
        echo "<td>" . $revalTourName["tourName"] . "</td>";
    }
    echo "<td>" . $row["dkDescription"] . "</td>";
    echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="passModel(' . $row["dkID"] . ',\'' . $row["dkName"] . '\')"><i class="far fa-list-alt"></i></button></td>';
    echo "</tr>";
    $stt++;
}

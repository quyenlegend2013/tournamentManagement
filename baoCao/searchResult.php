<?php
require "connect/connect.php";
$a = $_POST['data'];
//echo $a;
$sqlp        =    "SELECT * FROM tournament WHERE tourName LIKE '%$a%'";
$retval = mysqli_query($conn, $sqlp);
$stt = 1;
//$stt=1;
while ($rs = mysqli_fetch_assoc($retval)) {
    $sqlr        =    'SELECT * FROM result r WHERE tourID=' . $rs["tourID"];
    $retvalr = mysqli_query($conn, $sqlr);
    $num = mysqli_num_rows($retvalr);
    echo "<tr>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $rs["tourName"] . "</td>";
    echo "<td>" . date("d-m-Y h:m:s", strtotime($rs["openingTime"])) . "</td>";
    echo "<td>" . date("d-m-Y h:m:s", strtotime($rs["endTime"])) . "</td>";
    echo "<td>" . $rs["competitionTime"] . "</td>";
    echo '<td><button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="passModel(' . $rs["tourID"] . ',\'' . $rs["tourName"] . '\')"><i class="far fa-list-alt"></i></button></td>';
    echo ($num == 0) ? '<td></td>' : '<td><span class="badge badge-primary">Poined</span></td>';
    echo "</tr>";
    $stt++;
}

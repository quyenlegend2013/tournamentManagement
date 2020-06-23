<?php
require("connect/connect.php");
$data = $_POST["saveData"];

$jsonData = json_decode($data);
for ($i = 0; $i < COUNT($jsonData); $i++) {
    $dkID = $jsonData[$i][0];
    $pugID = $jsonData[$i][1];
    $rank = $jsonData[$i][7];
    if ($rank == null) {
        $rank = " ";
    }
    $sql = "UPDATE dkpug SET rank='$rank' WHERE dkID='$dkID' AND pugID=' $pugID'";
    $retval = mysqli_query($conn, $sql);
}

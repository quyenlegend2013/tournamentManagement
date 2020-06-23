<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        $query = "DELETE FROM tournament WHERE tourID = '" . $id . "'";
        mysqli_query($conn, $query);
    }
}
$sqlnum = 'SELECT * FROM tournament';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

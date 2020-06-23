<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        $query = "DELETE FROM pugilist WHERE pugID = '" . $id . "'";
        mysqli_query($conn, $query);
    }
}
$sqlnum = 'SELECT * FROM pugilist';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

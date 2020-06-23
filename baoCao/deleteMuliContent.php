<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    foreach ($_POST["id"] as $id) {
        $query = "DELETE FROM categories WHERE cateID = '" . $id . "'";
        mysqli_query($conn, $query);
    }
}
$sqlnum = 'SELECT * FROM categories';
$queryNum = mysqli_query($conn, $sqlnum);
$num = mysqli_num_rows($queryNum);
echo $num;

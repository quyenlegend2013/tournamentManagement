<?php
require("connect/connect.php");
$cateID = $_POST["cateID"];
$sqlCate = "SELECT * FROM categories WHERE cateID='$cateID'";
$queryCate = mysqli_query($conn, $sqlCate);
$data = array();
foreach ($queryCate as $row) {
    $data[] = $row;
}
echo json_encode($data);

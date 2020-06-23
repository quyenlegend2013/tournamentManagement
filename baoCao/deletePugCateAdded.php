<?php
require "connect/connect.php";
$pugID = $_POST['pugID'];
$tourcateID = $_POST['tourcateID'];
$sql = "DELETE FROM pugtourcate WHERE pugID = '$pugID' AND tourcateID = '$tourcateID'";
$retval = mysqli_query($conn, $sql);

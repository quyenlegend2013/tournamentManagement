<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    $dkID = $_POST["dkID"];
    foreach ($_POST["id"] as $id) {
        $sqlPugtour  = "INSERT dkpug(pugID,dkID) values('.$id.','.$dkID.')";
        $retvalPugtour = mysqli_query($conn, $sqlPugtour);
    }
}

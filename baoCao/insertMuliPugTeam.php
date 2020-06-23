<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    $tourteamID = $_POST["tourteamID"];
    foreach ($_POST["id"] as $id) {
        $sqlPugtour = "INSERT INTO pugtourteam(pugID,tourteamID) VALUES('$id','$tourteamID')";
        $retvalPugtour = mysqli_query($conn, $sqlPugtour);
    }
}

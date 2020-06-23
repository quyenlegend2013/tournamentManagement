<?php
require "connect/connect.php";
if (isset($_POST["id"])) {
    $tourcateID = $_POST["tourcateID"];
    foreach ($_POST["id"] as $id) {
        $sqlPugtour = "INSERT INTO pugtourcate(pugID,tourcateID) VALUES('$id','$tourcateID')";
        $retvalPugtour = mysqli_query($conn, $sqlPugtour);
    }
}

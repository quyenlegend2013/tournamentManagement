<?php
require "connect/connect.php";
$teamID = $_POST["teamID"];
$teamName = $_POST["teamName"];
$teamLeader = $_POST["leader"];
$teamDescription = $_POST["teamDescription"];

$sql = "UPDATE team SET teamName='$teamName',leader='$teamLeader',teamDescription='$teamDescription' WHERE teamID='$teamID'";
$retval = mysqli_query($conn, $sql);

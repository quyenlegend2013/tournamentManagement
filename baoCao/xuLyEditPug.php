<?php
require "connect/connect.php";
$pugID = $_POST["pugID"];
$pugName = $_POST["pugName"];
$dob = $_POST["dob"];
$teamID = $_POST["teamName"];
$level = $_POST["level"];
$gender = $_POST["gender"];

$sql = "UPDATE pugilist SET pugName='$pugName',dob='$dob',gender='$gender',level='$level',teamID='$teamID' WHERE pugID='$pugID'";
$retval = mysqli_query($conn, $sql);

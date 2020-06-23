<?php
require "connect/connect.php";
session_start();
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);
//$maHoa = md5($password);
$sql = "select * from user where userEmail='$email' and userPass='$password'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
if ($count == 1) {
	$_SESSION["user"] = $email;
	header("location:dashboard.php");
} else {
	header("location:login.php?check=f");
}

<?php
require "connect/connect.php";
session_start();
if (isset($_POST['face'])) {

	$para =  shell_exec("python detector.py");
	if ($para == 1) {
		$sql = "SELECT * FROM user WHERE userID = $para";
		$quey = mysqli_query($conn, $sql);
		$reval = mysqli_fetch_array($quey);
		$_SESSION["user"] = $reval["userEmail"];
		header("location:dashboard.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<script type="text/javascript">
		$(document).ready(function(e) {
			$("#alertt").hide();
			var urlParams = new URLSearchParams(window.location.search);
			if (urlParams.get('check') == 'f') {
				$("#alertt").show();
			}
		});
	</script>
</head>

<body>
	<div id="q1" class="container-fluid" style="padding-top: 100px;">
		<div class="col-md-4 offset-md-4">
			<div class="card card-body">
				<div class=" bg-light border-bottom">
					<nav class="navbar navbar-expand-lg navbar-light">
						<h4>Please Sign In</h4>
					</nav>
				</div>
				<nav class="navbar navbar-expand-lg navbar-light offset-2">
					<div id="alertt" class="alert alert-danger">Invalid Email and password</div>
				</nav>
				<form action="checkLogin.php" method="post">
					<nav class="navbar navbar-expand-lg navbar-light">
						<input type='text' name='email' id="email" class="form-control" placeholder="User name" />
						
					</nav>
					<nav class="navbar navbar-expand-lg navbar-light">
						<input type='password' name='password' id="password" class="form-control" placeholder="Password" />
					</nav>

					<nav class="navbar navbar-expand-lg navbar-light">
						<div class="custom-control custom-checkbox">

							<input type="checkbox" name="remember-me" class="custom-control-input" id="defaultLoginFormRemember">
							<label class="custom-control-label" for="defaultLoginFormRemember">Remember
								me</label>
						</div>
					</nav>

					<nav class="navbar navbar-expand-lg navbar-light">
						<button class="btn btn-success btn-block" name="submit" type="submit">Login</button>
					</nav>

				</form>

				<nav class="navbar navbar-expand-lg navbar-light offset-md-4">
					<form method="POST">
						<button class="btn btn-success" type="submit" name="face">FaceID</button>
					</form>
				</nav>

			</div>
		</div>
	</div>
	<script type="text/javascript">

		$(function() {

			if (localStorage.chkbox && localStorage.chkbox != '') {
				$('#defaultLoginFormRemember').attr('checked', 'checked');
				$('#email').val(localStorage.email);
				$('#password').val(localStorage.password);
			} else {
				$('#defaultLoginFormRemember').removeAttr('checked');
				$('#email').val('');
				$('#password').val('');
			}

			$('#defaultLoginFormRemember').click(function() {
				if ($('#defaultLoginFormRemember').is(':checked')) {

					localStorage.email = $('#email').val();
					localStorage.password = $('#password').val();
					localStorage.chkbox = $('#defaultLoginFormRemember').val();
					console.log(localStorage.email);
				} else {
					localStorage.email = '';
					localStorage.password = '';
					localStorage.chkbox = '';
				}
			});
		});
	</script>
	<script src="js/darkmode-js.min.js"></script>
	<script src="js/s.js"></script>
</body>

</html>
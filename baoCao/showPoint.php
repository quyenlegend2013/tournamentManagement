<?php
require("connect/connect.php");
$sid = $_GET["sID"];
$tourID = $_GET["tourID"];
$sql = "select p.pugName,t.teamName from pugilist p INNER JOIN team t ON t.teamID=p.teamID where pugID='$sid'";
$querySql = mysqli_query($conn, $sql);
$reval = mysqli_fetch_array($querySql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="SHORTCUT ICON" href="img/co.png">
	<script type="text/javascript" src="js/javascriptQuyen.js"></script>
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	
	<title>Show Point</title>
	<script type="text/javascript">

		function phanTrangRank(i) {
			var tourID = '<?php echo $tourID; ?>';
			$.ajax({
				url: 'loadRank.php?i=' + i,
				type: 'POST',
				data:{tourID:tourID},
				success: function(response) {
					$('.danhsachRank').html(response);
					//$("#delete").attr("disabled", true);
					//$("#edit").attr("disabled", true);

					setInterval(function onloadddd() {

						$.ajax({
							url: 'loadRank.php',
							type: 'POST',
							data:{tourID:tourID},
							success: function(response) {
								$('.danhsachRank').html(response);
								//$("#delete").attr("disabled", true);
								//$("#edit").attr("disabled", true);

							}
						})
					}, 15000);

					document.getElementById("infor").hidden = false;
					document.getElementById("rank").hidden = true;
					document.getElementById("hiddenPoint").hidden = true;

				}
			})
			//setInterval(onloadddd(), 10000);
		}

		function countTime() {
			var counter = {};
			counter.end = 50;
			// Get the containers
			counter.min = document.getElementById("cd-min");
			counter.sec = document.getElementById("cd-sec");
			if (counter.end > 0) {
				counter.ticker = setInterval(function() {
					// Stop if passed end time
					counter.end--;
					if (counter.end <= 0) {
						clearInterval(counter.ticker);
						counter.end = 0;
					}

					// Calculate remaining time
					var secs = counter.end;
					var mins = Math.floor(secs / 60); // 1 min = 60 secs
					secs -= mins * 60;

					// Update HTML
					counter.min.innerHTML = mins;
					counter.sec.innerHTML = secs;
					/* if(mins==0 && secs==0)
				  {
					  window.location="2-coming-soon.html";
			
				   }*/

				}, 1000);
			}

		}
	</script>

	<style>
		.ten {
			width: 100%;
			height: 500px;
			background: #F00;
			font-size: 100px;
			text-align: center;
			margin: auto;
			padding-top: 10%;
			color: #FFF;
			text-decoration: blink;
		}
	</style>
</head>

<body onload="phanTrangRank(1);" style="background:#000;">

	<div class="container-fluid" style="margin-bottom:2%; margin-top:2%;" id="infor">
		<div class="row" style="margin-top:2%; margin-bottom:2%;">
			<div class="col-12 text-center text-white" style="font-size:80px;" id="teamName"><?php echo $reval["teamName"]; ?></div>
		</div>
		<div class="row">
			<div class="ten" id="pugName"><?php echo $reval["pugName"]; ?></div>
		</div>
		<div class="row justify-content-center" style="color:#FFF; font-size:90px;">
			<div class="col-1" id="cd-min">00</div> :
			<div class="col-1" id="cd-sec">00</div>
		</div>

	</div>

	<div class="container-fluid" style="margin-top:2%;" id="hiddenPoint">
		<div class="row pt-2 pb-2" style="font-size:60px; color:#FFF;">
			<div class="col-6 text-center" id="pointteamName"><?php echo $reval["teamName"];  ?></div>
			<div class="col-6 text-center" id="pointpugName"><?php echo $reval["pugName"];  ?></div>
		</div>
		<div class="row">
			<div class="col-6">
				<div class="row">
					<table class="table table-success font-weight-bold" style="font-size:52px;">
						<tr>
							<td>1</td>
							<td><span id="exam1_f">0.0</span></td>
							<td><span id="exam1_s">0.0</span></td>
						</tr>
						<tr>
							<td>2</td>
							<td><span id="exam2_f">0.0</span></td>
							<td><span id="exam2_s">0.0</span></td>
						</tr>
						<tr>
							<td>3</td>
							<td><span id="exam3_f">0.0</span></td>
							<td><span id="exam3_s">0.0</span></td>
						</tr>
						<tr>
							<td>4</td>
							<td><span id="exam4_f">0.0</span></td>
							<td><span id="exam4_s">0.0</span></td>
						</tr>
						<tr>
							<td>5</td>
							<td><span id="exam5_f">0.0</span></td>
							<td><span id="exam5_s">0.0</span></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-6">
				<div class="row justify-content-center bg-success">
					<div style="margin:100px 5px 190px 5px; font-size:144px;" class="font-weight-bold"><span id="total">0.0</span></div>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid" id="rank">
		<table class="table table-striped" style="text-align:center; font-size:55px; color:#FFF;">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>Name</th>
					<th>Total</th>
				</tr>
			</thead>
			<tbody class="danhsachRank"></tbody>
		</table>
	</div>


</body>

</html>
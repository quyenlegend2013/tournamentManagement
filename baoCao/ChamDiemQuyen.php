<?php
require("connect/connect.php");
session_start();
if ($_SESSION["user"] == "") {
	header("location:login.php");
}
$tourID = $_GET["tourID"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>This Point</title>
	<link rel="SHORTCUT ICON" href="img/co.png">
	<script type="text/javascript" src="js/javascriptQuyen.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/sweetalert2.all.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/handsontable.full.min.css">
	<script type="text/javascript" src="js/handsontable.full.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#alertt").hide();
		});

		function phanTrang(i) {
			var tourID = "<?php echo $tourID ?>"
			$.ajax({
				url: 'loaddataExam.php?i=' + i,
				type: 'POST',
				data: {
					tourID: tourID
				},
				success: function(response) {
					$('.danhsach').html(response);


				}
			})
		}

		function sid(s) {
			document.getElementById("pugID").value = s;
			//oDisplayShow.close();
			if (!oDisplayShowPoint) {
				oDisplayShowPoint = window.open('showPoint.php?sID=' + s + '&tourID=' + <?php echo $tourID; ?>, '_blank', 'location=yes;menubar=yes;status=no;toolbar=yes');
			} else {
				$.ajax({
					url: 'getExamID.php',
					type: 'POST',
					dataType: 'JSON',
					data: {
						s: s
					},
					success: function(data) {
						//alert(data[0].pugName);
						oDisplayShowPoint.document.getElementById("pugName").innerHTML = data[0].pugName;
						oDisplayShowPoint.document.getElementById("teamName").innerHTML = data[0].teamName;
						oDisplayShowPoint.document.getElementById("pointpugName").innerHTML = data[0].pugName;
						oDisplayShowPoint.document.getElementById("pointteamName").innerHTML = data[0].teamName;
					}
				})
			}

		}

		function setValue(sid) {
			oDisplayShowPoint.document.getElementById(sid).innerHTML = oDisplays.document.getElementById(sid).value;

		}

		var h = "";
		var noi = new Array();
		var q1 = 0.0;

		function soVDVq1() {
			//var giai=new Array();
			var exam1_f = document.getElementById("exam1_f").value;
			var exam2_f = document.getElementById("exam2_f").value;
			var exam3_f = document.getElementById("exam3_f").value;
			var exam4_f = document.getElementById("exam4_f").value;
			var exam5_f = document.getElementById("exam5_f").value;
			//var vdv=document.getElementById("giaiVDV").value;

			//menu.hidden=false;
			var mang = [exam1_f, exam2_f, exam3_f, exam4_f, exam5_f];

			mang.sort(function(a, b) {
				return a - b
			}); // sap xep
			var maxx = mang.pop(); //xoa cuoi mang 
			var minx = mang.shift(); // xoa dau mang

			var sum = 0.0;
			for (var i = 0; i < mang.length; i++) {
				sum += Number(mang[i]);

			}
			noi.push(sum);
			document.getElementById("min_f").value = minx;
			document.getElementById("max_f").value = maxx;
			document.getElementById("total_f").value = parseFloat(sum).toFixed(2);
			q1 = sum;
			oDisplayShowPoint.document.getElementById("total").innerHTML = parseFloat(sum).toFixed(2);

		}

		function soVDVq2() {
			//var giai=new Array();
			var exam1_s = document.getElementById("exam1_s").value;
			var exam2_s = document.getElementById("exam2_s").value;
			var exam3_s = document.getElementById("exam3_s").value;
			var exam4_s = document.getElementById("exam4_s").value;
			var exam5_s = document.getElementById("exam5_s").value;
			//var vdv=document.getElementById("giaiVDV").value;

			//menu.hidden=false;
			var mang = [exam1_s, exam2_s, exam3_s, exam4_s, exam5_s];

			mang.sort(function(a, b) {
				return a - b
			}); // sap xep
			var maxx = mang.pop(); //xoa cuoi mang 
			var minx = mang.shift(); // xoa dau mang

			var sum2 = 0.0;
			for (var i = 0; i < mang.length; i++) {
				sum2 += Number(mang[i]);

			}
			noi.push(sum2);
			document.getElementById("min_s").value = minx;
			document.getElementById("max_s").value = maxx;
			document.getElementById("total_s").value = parseFloat(sum2).toFixed(2);
			var result_total = parseFloat(sum2 + q1).toFixed(2);
			document.getElementById("total").value = result_total;
			oDisplayShowPoint.document.getElementById("total").innerHTML = result_total;

		}

		function resultt() {
			var q1 = document.getElementById("total_f").value;
			var q2 = document.getElementById("total_s").value;
			var s;
			s = q1 + q2;
			var q1 = document.getElementById("total").value = s;
		}

		function anFace() {
			oDisplayShowPoint.document.getElementById("infor").hidden = true;
			oDisplayShowPoint.document.getElementById("rank").hidden = true;
			oDisplayShowPoint.document.getElementById("hiddenPoint").hidden = false;
		}

		function hienFace() {
			oDisplayShowPoint.document.getElementById("infor").hidden = false;
			oDisplayShowPoint.document.getElementById("rank").hidden = true;
			oDisplayShowPoint.document.getElementById("hiddenPoint").hidden = true;

		}

		function rankVDV() {

			oDisplayShowPoint.document.getElementById("hiddenPoint").hidden = true;
			oDisplayShowPoint.document.getElementById("infor").hidden = true;

			oDisplayShowPoint.document.getElementById("rank").hidden = false;

		}

		function exportExam() {
			var tourID = '<?php echo $tourID; ?>';
			$.ajax({
				url: 'DataHandsomeResult.php',
				type: 'POST',
				dataType: 'JSON',
				data: {
					tourID: tourID
				},
				success: function(data) {
					var container = document.getElementById('example');
					var hot = new Handsontable(container, {
						data: data,
						autoWrapRow: true,
						rowHeaders: true,
						colHeaders: true,
						filters: true,
						dropdownMenu: true,
						manualRowMove: true,
						manualColumnMove: true,
						contextMenu: true,
						maxRows: 100,
						colHeaders: [
							'Pugilist ID',
							'Full name',
							'Dob',
							'Team Name',
							'Exam 1F',
							'Exam 2F',
							'Exam 3F',
							'Exam 4F',
							'Exam 5F',
							'Exam 1S',
							'Exam 2S',
							'Exam 3S',
							'Exam 4S',
							'Exam 5S',
							'Total S',
							'Total F',
							'Total'
						],
						columns: [{
								data: 'pugID',
								readOnly: true
							},
							{
								data: 'pugName'

							},
							{
								data: 'dob',
							},
							{
								data: 'teamName',
								//dateFormat: 'MM/DD/YYYY'

							},

							{
								data: 'exam1_f',

							},
							{
								data: 'exam2_f',

							},
							{
								data: 'exam3_f',
								//dateFormat: 'MM/DD/YYYY'
							},
							{
								data: 'exam4_f',
								//type: 'text',

							},
							{
								data: 'exam5_f',

							},
							{
								data: 'exam1_s',
								//type: 'text'

							},
							{
								data: 'exam2_s',

							},
							{
								data: 'exam3_s',

							},
							{
								data: 'exam4_s',

							},
							{
								data: 'exam5_s',

							},
							{
								data: 'total_f',

							},
							{
								data: 'total_s',

							},
							{
								data: 'total',

							}
						]

					});


					var exportFiles = document.getElementById('export');
					var exportPlugin1 = hot.getPlugin('exportFile');

					exportFiles.addEventListener('click', function() {
						exportPlugin1.downloadFile('csv', {
							bom: true,
							columnDelimiter: ',',
							columnHeaders: true,
							exportHiddenColumns: true,
							exportHiddenRows: true,
							fileExtension: 'csv',
							filename: 'Exam-CSV-file_[YYYY]-[MM]-[DD]',
							mimeType: 'text/csv',
							rowDelimiter: '\r\n',
							rowHeaders: true
						});
					});
				}
			})
		}

		function savepug() {
			var pugID = $("#pugID").val();
			var tourID = $("#tourID").val();
			var exam1_f = $("#exam1_f").val();
			var exam2_f = $("#exam2_f").val();
			var exam3_f = $("#exam3_f").val();
			var exam4_f = $("#exam4_f").val();
			var exam5_f = $("#exam5_f").val();
			var exam1_s = $("#exam1_s").val();
			var exam2_s = $("#exam2_s").val();
			var exam3_s = $("#exam3_s").val();
			var exam4_s = $("#exam4_s").val();
			var exam5_s = $("#exam5_s").val();
			var min_f = $("#min_f").val();
			var max_f = $("#max_f").val();
			var total_f = $("#total_f").val();
			var min_s = $("#min_s").val();
			var max_s = $("#max_s").val();
			var total_s = $("#total_s").val();
			var total = $("#total").val();
			//alert(pugID + "-" + tourID);
			if (exam1_f == '' || exam2_f == '' || exam3_f == '' || exam4_f == '' || exam5_f == '' || exam1_s == '' || exam2_s == '' || exam3_s == '' || exam4_s == '' || exam5_s == '') {
				$("#alertt").show();
			} else {
				$.ajax({
					url: 'xulyAddPoint.php',
					type: 'POST',
					data: {
						pugID: pugID,
						tourID: tourID,
						exam1_f: exam1_f,
						exam2_f: exam2_f,
						exam3_f: exam3_f,
						exam4_f: exam4_f,
						exam5_f: exam5_f,
						exam1_s: exam1_s,
						exam2_s: exam2_s,
						exam3_s: exam3_s,
						exam4_s: exam4_s,
						exam5_s: exam5_s,
						min_f: min_f,
						max_f: max_f,
						total_f: total_f,
						min_s: min_s,
						max_s: max_s,
						total_s: total_s,
						total: total
					},
					success: function(data) {
						phanTrang(1);
						Swal.fire({
							position: 'top',
							icon: 'success',
							//title: 'Your work has been saved',
							showConfirmButton: false,
							timer: 1500
						})

					}
				})
			}

		}

		function clearResult() {
			$("#exam1_f").val('');
			$("#exam2_f").val('');
			$("#exam3_f").val('');
			$("#exam4_f").val('');
			$("#exam5_f").val('');
			$("#exam1_s").val('');
			$("#exam2_s").val('');
			$("#exam3_s").val('');
			$("#exam4_s").val('');
			$("#exam5_s").val('');
			$("#min_f").val('');
			$("#max_f").val('');
			$("#total_f").val('');
			$("#min_s").val('');
			$("#max_s").val('');
			$("#total_s").val('');
			$("#total").val('');
			oDisplayShowPoint.document.getElementById("exam1_f").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam2_f").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam3_f").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam4_f").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam5_f").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam1_s").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam2_s").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam3_s").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam4_s").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("exam5_s").innerHTML = '0.0';
			oDisplayShowPoint.document.getElementById("total").innerHTML = '0.0';

		}

		function unloadQuyen() {
			oDisplayShowPoint.close();
			window.location.href = "fighting.php";
		}
	</script>
</head>

<body onload="phanTrang(1); onloadd();">
	<div class="container-fluid">
		<div class="row mb-2 mt-2 ml-2">
			<div class="col-1"> <button type="button" id="export" class="btn btn-warning " onclick="exportExam()">Export</button></div>
			<div hidden="true" id="example" class="mt-2 ml-3"></div>
			<div class="col-2"> <button type="button" class="btn btn-danger" onclick="unloadQuyen()">Exit</button></div>
		</div>
		<div class="card card-body">
			<table class="table table-striped" style="text-align:center">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>DOB</th>
						<th>Team</th>
						<th>Content</th>
						<th>Active</th>

					</tr>
				</thead>
				<tbody class="danhsach"></tbody>
			</table>
		</div>
	</div>

	<div class="container-fluid">
		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">

					<div class="modal-body">
						<div class="row alert alert-danger" id="alertt">
							Point not empty
						</div>
						<div class="row" style="margin-left:10%; margin-top:2%;">

							<div class="col-5 card card-body">
								<div class="row mt-1">
									<h6 class="card-title">Round 1</h6>
								</div>
								<input type="hidden" name="pugID" id="pugID" />
								<input type="hidden" name="tourID" id="tourID" value="<?php echo $tourID ?>" />
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="1f" name="exam1_f" id="exam1_f" onchange="setValue('exam1_f');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="2f" name="exam2_f" id="exam2_f" onchange="setValue('exam2_f');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="3f" name="exam3_f" id="exam3_f" onchange="setValue('exam3_f');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="4f" name="exam4_f" id="exam4_f" onchange="setValue('exam4_f');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="5f" name="exam5_f" id="exam5_f" onchange="setValue('exam5_f');" required="required" onfocusout="soVDVq1();" />
								</div>

							</div>
							<div class="col-5 ml-2 card card-body">

								<div class="row mt-1">
									<h6 class="card-title">Round 2</h6>
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="1s" name="exam1_s" id="exam1_s" onchange="setValue('exam1_s');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="2s" name="exam2_s" id="exam2_s" onchange="setValue('exam2_s');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="3s" name="exam3_s" id="exam3_s" onchange="setValue('exam3_s');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="4s" name="exam4_s" id="exam4_s" onchange="setValue('exam4_s');" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="5s" name="exam5_s" id="exam5_s" onchange="setValue('exam5_s');" onfocusout="soVDVq2();" required="required" />
								</div>
							</div>
						</div>


						<div class="row" style="margin-left:10%; margin-top:1%;">

							<div class="col-5 card card-body">

								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="min_f" name="min_f" id="min_f" readonly="readonly" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="max_f" name="max_f" id="max_f" readonly="readonly" />
								</div>

								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="total_f" name="total_f" id="total_f" readonly="readonly" />
								</div>

							</div>
							<div class="col-5 ml-2 card card-body">

								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="min_s" name="min_s" id="min_s" readonly="readonly" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="max_s" name="max_s" id="max_s" readonly="readonly" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="total_s" name="total_s" id="total_s" readonly="readonly" />
								</div>
							</div>
						</div>

						<div class="row mt-2 mb-2" style="margin-left:30%;">
							<div class="col-6"><input type="text" class="form-control" placeholder="total" name="total" id="total" onfocusout="setValue('total');" readonly="readonly" /></div>
						</div>

						<div class="row mt-2 mb-2 justify-content-center">
							<div class="col-2"><button type="button" class="btn btn-success" onclick="savepug();">Save</button></div>
							<div class="col-2"><button type="button" class="btn btn-success" onclick="clearResult();">Clear</button></div>
							<div class="col-2"><button type="button" class="btn btn-success" onclick="anFace();">Point</button></div>
							<div class="col-2"><button type="button" class="btn btn-success" onclick="hienFace();">View</button></div>
							<div class="col-2"><button type="button" class="btn btn-success" onclick="rankVDV();">Rank</button></div>
							<div class="col-2"><button type="button" class="btn btn-success" onclick="oDisplayShowPoint.countTime();">Time</button></div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

	</div>

	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script src="js/darkmode-js.min.js"></script>
	<script src="js/s.js"></script>
</body>

</html>
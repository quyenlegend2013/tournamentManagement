<?php include 'masterheader.php'; ?>
<?php
$sql		=	"SELECT * FROM pugilist";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$num	= ceil($rowtotal / $pagesize);

$sqlFilter = "SELECT teamName,teamID FROM team";
$queryFilter = mysqli_query($conn, $sqlFilter);

$sqlTeam = "select teamName,teamID from team";
$queryTeam = mysqli_query($conn, $sqlTeam);
$numTeam = mysqli_num_rows($queryTeam);

$sqleditTeam = "select teamName,teamID from team";
$queryeditTeam = mysqli_query($conn, $sqleditTeam);
$numeditTeam = mysqli_num_rows($queryeditTeam);
?>
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white">
			<li class="breadcrumb-item active" aria-current="page">Pugilist</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-4">
			<h2>Pugilist<span class="badge badge-warning" id="countPug"><?php echo $rowtotal; ?></span></h2>
		</div>
		<div class="col-4" style="margin-left:20%;">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Search..." id="tim" onClick="dosearch();" aria-label="Recipient's username" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-outline-secondary" onclick="startSpeech();" type="button"><i class="fas fa-microphone"></i></button>
				</div>
			</div>
			<script type="text/javascript">
				var r = document.getElementById("tim");

				function startSpeech() {
					if ('webkitSpeechRecognition' in window) {
						var speedRecord = new webkitSpeechRecognition();
						speedRecord.continuous = true;
						speedRecord.interimResults = true;
						speedRecord.lang = 'vi-VN';
						speedRecord.start();
						var final = '';
						speedRecord.onresult = function(event) {
							var interim = '';
							for (var i = event.resultIndex; i < event.results.length; i++) {
								var tran = event.results[i][0].transcript;
								tran.replace("\n", "<br>");
								if (event.results[i].isFinal) {
									final += tran;
								} else {
									interim += tran;
								}
							}
							r.value = final + interim;
							var t = final;

							$.post('searchPugilist.php', {
								data: t
							}, function(data) {
								if (t == "") //add  t.indexOf("xóa")!=-1
								{
									//r.value="";
									phanTrang(1);
								} else {
									$('.danhsach').html(data);
									speedRecord.stop();

								}
							})


						};
						speedRecord.onspeechend = function() {
							speedRecord.stop();
						};
						speedRecord.onerror = function(event) {};

					} else {
						r.value = 'Do not found ';
					}

				}
			</script>
		</div>
	</div>
	<nav class="navbar navbar-light bg-white">
		<div class="mb-2 mt-2 card card-body">
			<div class="row">
				<div class="col-1"><button class="btn btn-danger" name="btn_delete" id="btn_delete">Delete</button></div>
				<div class="col-2"><button class="btn btn-info" type="button" onclick="stroll();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
						+ Add Pugilist
					</button></div>
				<div class="col-2">
					<select id="filterTeam" class="form-control" onchange="filter()">
						<?php
						echo "<option>All</option>";
						while ($rs = mysqli_fetch_assoc($queryFilter)) {
							echo "<option>" . $rs["teamName"] . "</option>";
						}
						?>
					</select>
				</div>
				<div class="col-2" style="margin-left:35%;"><button type="button" class="btn btn-raised btn-info" onclick="location.href='exportPugilist.php'">Export Data</button></div>
			</div>
		</div>
	</nav>
	<!-- add pug -->
	<div class="collapse" id="collapseExample">
		<nav class="navbar navbar-light bg-white">
			<div class="card card-body" style="background-color: #EC586C">
				<div class="row alert alert-danger" id="alertt">
					Some information not empty
				</div>
				<div class="row alert alert-success" id="alertSuccess">
				</div>
				<div class="row pb-2" style="margin-left:10%">

					<div class="col-5 card card-body">
						<div class="row mt-1">
							<h6 class="card-title">Basic Information</h6>
						</div>
						<div class="row mt-3">
							<input type="text" class="form-control" placeholder="Pugilist Name" id="pugName" name="pugName" required="required" />
						</div>
						<div class="row mt-3">
							<input type="date" class="form-control" placeholder="Date of birth " id="dob" name="dob" required="required" onchange="checkDate();" />
							<p id="checkDate" style="color: red"></p>
						</div>
						<div class="row mt-3">

							<div class="ml-1 form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Men">
								<label class="form-check-label" for="inlineRadio1">Men</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Woman">
								<label class="form-check-label" for="inlineRadio2">Woman</label>
							</div>
						</div>
					</div>
					<div class="col-5 ml-2 card card-body">

						<div class="row mt-1">
							<h6 class="card-title">The other</h6>
						</div>
						<div class="row mt-3">
							<select class="form-control" name="teamName" id="teamName">
								<?php
								if ($numTeam > 0) {
									while ($rs = mysqli_fetch_assoc($queryTeam)) {
										echo "<option value='" . $rs["teamID"] . "'>" . $rs["teamName"] . "</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="row mt-3">
							<select class="form-control" name="level" id="level">
								<?php
								$i = 8;
								while ($i > 0) {
									echo "<option>" . $i . "</option>";
									$i--;
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-6" align="right"><button type="button" id="submitAdd" onclick="addPug();" class="btn btn-success" name="">Save</button></div>
					<div class="col-6" align="left"><button type="reset" class="btn btn-success" name="">Cancel</button></div>
				</div>


			</div>
		</nav>
	</div>
	<!-- end pug -->

	<div class="container-fluid">
		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Pugilist</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">


						<div class="row pb-2" style="margin-left:10%">

							<div class="col-5 card card-body">
								<div class="row mt-1">
									<h6 class="card-title">Basic Information</h6>
								</div>
								<input type="hidden" name="pugID" id="editpugID" />
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="Pugilist Name" id="editpugName" required="required" />
								</div>
								<div class="row mt-3">
									<input type="date" class="form-control" placeholder="Date of birth " id="editdob" required="required" />
								</div>
								<div class="row mt-3">

									<div class="ml-1 form-check form-check-inline">
										<input class="form-check-input" type="radio" name="editgender" id="inlineRadio1" value="Men">
										<label class="form-check-label" for="inlineRadio1">Men</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="editgender" id="inlineRadio2" value="Woman">
										<label class="form-check-label" for="inlineRadio2">Woman</label>
									</div>
								</div>

							</div>
							<div class="col-5 ml-2 card card-body">

								<div class="row mt-1">
									<h6 class="card-title">The other</h6>
								</div>
								<div class="row mt-3">
									<select class="form-control" id="editteamName">

										<?php
										if ($numeditTeam > 0) {
											// echo "<option>" . $revalPug['teamName'] . "</option>";
											while ($rs = mysqli_fetch_assoc($queryeditTeam)) {
												echo "<option value='" . $rs['teamID'] . "'>" . $rs["teamName"] . "</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="row mt-3">
									<select class="form-control" id="editlevel">

										<?php
										$i = 8;
										while ($i > 0) {
											echo "<option value=" . $i . ">" . $i . "</option>";
											$i--;
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="row mt-2 mb-2">
							<div class="col-6" align="right"><button type="button" onclick="editpug();" class="btn btn-success" name="">Save</button></div>
							<div class="col-6" align="left"><button type="button" class="btn btn-success" onclick="clearPugilist();">Cancel</button></div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- load list pugilist -->
	<nav class="navbar navbar-light bg-white">
		<div class="card card-body mb-3">
			<table class="table table-hover table-bordered" style="text-align:center">
				<thead>
					<tr class="text-white" style="background-color: darkblue;">
						<th><input type="checkbox" id="checkAll"></th>
						<th>#</th>
						<th>Name</th>
						<th>DOB</th>
						<th>Team</th>
						<th colspan="2">Active</th>
					</tr>
				</thead>
				<tbody class="danhsach"></tbody>
			</table>
			<div class="row" style="margin-left:78%;">
				<?php
				for ($i = 1; $i <= $num; $i++) {
					echo '<button id="anphantrang" type="button" class="btn btn-raised btn-secondary" onclick="phanTrang(' . $i . ');">' . $i . '</button>&nbsp;&nbsp;&nbsp;';
				}
				?>

			</div>
		</div>
	</nav>
	<!-- end list pugilist -->
</div>

<script type="text/javascript">
	$(document).ready(function() {
		phanTrang(1);
		$("#alertt").hide();
		$("#alertSuccess").hide();
	});

	var dem = 1;

	function stroll() {
		if (dem % 2 != 0) {
			$('html, body').animate({
				scrollTop: 120
			}, 'slow');
		} else {
			$('html, body').animate({
				scrollTop: -10
			}, 'slow');

		}
		dem++;

	}

	function checkDate() {
		var dob = $("#dob").val();
		var varDate = new Date(dob);
		var today = new Date();
		today.setHours(0, 0, 0, 0);

		if (varDate >= today) {
			//Do something..
			//alert("Time in input is greater than now!!!! ")
			$("#checkDate").text("your birthday is greater than or equal to today!!!!");
			$("#submitAdd").attr("disabled", true);
		} else {
			$("#checkDate").text("");
			$("#submitAdd").attr("disabled", false);
		}

	}

	$('#checkAll').click(function() {
		if ($("#checkAll").is(":checked")) {
			// do something if the checkbox is NOT checked
			$('input:checkbox').prop('checked', this.checked)
			//$("#btn_delete").show();
		} else {
			$('input:checkbox').prop('checked', false)
		}

	});

	$('#btn_delete').click(function() {
		var id = [];
		$(':checkbox:checked').each(function(i) {
			id[i] = $(this).val();
		});
		if (id.length === 0) //tell you if the array is empty
		{
			// alert("Please Select atleast one checkbox");
			Swal.fire({
				icon: 'error',
				title: 'Oops...',
				text: 'Please Select one checkbox to delete',
				//footer: '<a href>Why do I have this issue?</a>'
			})

		}
		//alert(JSON.stringify(id));
		else {

			Swal.fire({
				title: 'Are you sure delete this pugilist?',
				// text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#00a550',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {


					$.ajax({
						url: 'deleteMuliPugilist.php',
						method: 'POST',
						data: {
							id: id
						},
						success: function(data) {
							$("#countPug").text(data);
							phanTrang(1);
						}

					});
					Swal.fire(
						'Deleted!',
						'success'
					)
				}
			})



		}
	})

	function loaddata() {
		$.ajax({
			url: 'loaddata.php',
			type: 'POST',
			data: {
				res: 1
			},
			success: function(response) {
				$('.danhsach').html(response);
				//$("#delete").attr("disabled", true);
				//$("#edit").attr("disabled", true);

			}
		})
	}

	function dosearch() {
		$('#tim').keyup(function() {
			var txt = $('#tim').val();
			$.post('searchPugilist.php', {
				data: txt
			}, function(data) {
				if (txt == "") {
					phanTrang(1);
				} else {
					$('.danhsach').html(data);
				}

			})
		})
	};

	function deletePugilist(pugID) {

		Swal.fire({
			title: 'Are you sure delete all pugilist that you chose?',
			// text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#00a550',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'deletePugilist.php?pugID=' + pugID,
					method: 'POST',
					success: function(data) {
						$("#countPug").text(data);
						phanTrang(1);
					},

				});
				Swal.fire(
					'Deleted!',
					'success'
				)
			}
		})

	}

	function phanTrang(i) {
		$.ajax({
			url: 'loadPugilist.php?i=' + i,
			type: 'POST',
			success: function(response) {
				$('.danhsach').html(response);
				//$("#delete").attr("disabled", true);
				//$("#edit").attr("disabled", true);

			}
		})
	}

	function filter() {
		var filterr = document.getElementById("filterTeam").value;
		//var anphantrang=document.getElementById("anPhanTrang");

		if (filterr == "All") {
			phanTrang(1);

		} else {

			$.post('filterTeam.php', {
				filterr: filterr
			}, function(data) {
				$('.danhsach').html(data);

			})
		}


	}

	function addPug() {

		var pugName = $("#pugName").val();
		var level = $("#level").val();
		var teamName = $("#teamName").val();
		var gender = $("input[name='gender']:checked").val()
		var dob = $("#dob").val();
		//alert(pugName+"-"+level+"-"+teamName+"-"+inlineRadio1+"-"+dob);
		if (pugName == '' || level == '' || teamName == '' || dob == '') {
			$("#alertt").fadeIn('slow');
		} else {
			$("#alertt").fadeOut('slow');
			$.ajax({
				url: 'xuLyAddPug.php',
				type: 'POST',
				data: {
					pugName: pugName,
					level: level,
					teamName: teamName,
					gender: gender,
					dob: dob
				},
				success: function(data) {
					$("#countPug").text(data);
					$("#alertSuccess").fadeIn();
					$("#alertSuccess").html("Add success &nbsp;" + "<span class='font-weight-bold'>" + pugName + "</span>");
					
					phanTrang(1);
					$("#pugName").val('');
					$("#level").val('');
					$("#teamName").val('');
					$("#dob").val('');

				}
			});
		}

	}

	function passPugID(pugID) {
		$.ajax({
			url: 'editpug.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				pugID: pugID
			},
			success: function(datas) {
				//alert(datas[0].teamID);
				$("#editpugName").val(datas[0].pugName)
				$("#editdob").val(datas[0].dob);
				$("#editpugID").val(datas[0].teamID);
				$("#editlevel").val(datas[0].level);
				$("#editpugID").val(datas[0].pugID);
				$("input[name=editgender][value=" + datas[0].gender + "]").attr('checked', 'checked');
				$("#editteamName option[value=" + datas[0].teamID + "]").attr("selected", "selected");

			}
		});
	}

	function editpug() {
		var pugID = $("#editpugID").val();
		var pugName = $("#editpugName").val();
		var level = $("#editlevel").val();
		var teamName = $("#editteamName").val();
		var gender = $("input[name='editgender']:checked").val()
		var dob = $("#editdob").val();
		//alert(pugID+"-"+pugName+"-"+level+"-"+teamName+"-"+gender+"-"+dob);
		$.ajax({
			url: 'xuLyEditPug.php',
			type: 'POST',
			data: {
				pugName: pugName,
				level: level,
				teamName: teamName,
				gender: gender,
				dob: dob,
				pugID: pugID
			},
			success: function(data) {
				Swal.fire({
					position: 'top',
					icon: 'success',
					//title: 'Your work has been saved',
					showConfirmButton: false,
					timer: 1500
				})
				phanTrang(1);

			}

		});
	}

	function clearPugilist() {
		$("#editpugName").val('');
		$("#editdob").val('');
		$("#editpugID").val('');
		$("#editlevel").val('');
		$("#editpugID").val('');
	}
</script>
<?php include 'masterfooter.php'; ?>
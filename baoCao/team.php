<?php include 'masterheader.php'; ?>
<?php
$sql		=	"SELECT * FROM team";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$num	= ceil($rowtotal / $pagesize);
?>
<div class="container-fluid">

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white">
			<li class="breadcrumb-item active" aria-current="page">Team</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-4">
			<h2>Team<span class="badge badge-warning" id="countTeam"><?php echo $rowtotal; ?></span></h2>
		</div>
		<div class="col-4" style="margin-left:20%;">
			<!--<input type="text" placeholder="Search..." class="form-control" id="tim" onclick="dosearch()" />-->
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
							$.post('searchTeam.php', {
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
						r.value = ' dont found ';
					}

				}
			</script>

		</div>
	</div>

	<nav class="navbar navbar-light bg-white">
		<div class="mb-2 mt-2 card card-body">
			<div class="row">
				<div class="col-1"><button class="btn btn-danger" name="btn_delete" id="btn_delete">Delete</button></div>
				<div class="col-3"><button class="btn btn-info" type="button" onclick="stroll();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
						+ Add Team
					</button></div>
				<div class="col-2" style="margin-left: 40%;"><button type="button" class="btn btn-raised btn-info" onclick="location.href='exportTeam.php'">Export Data</button></div>
			</div>
		</div>
	</nav>

	<!-- add team -->
	<div class="collapse" id="collapseExample">
		<nav class="navbar navbar-light bg-white">
			<div class="card card-body" style="background-color: brown;">
				<div class="row alert alert-danger" id="alertt">
					some information not empty
				</div>
				<div class="row alert alert-success" id="alertSuccess">
				</div>

				<div class="row" style="margin-left:10%">

					<div class="col-5 card card-body">
						<div class="row mt-1">
							<h6 class="card-title">Basic Information</h6>
						</div>
						<div class="row mt-3">
							<input type="text" class="form-control" placeholder="Team Name" name="teamName" id="teamName" required="required" />
						</div>
						<div class="row mt-3">
							<input type="text" class="form-control" placeholder="Leader" name="teamLeader" id="teamLeader" required="required" />
						</div>
					</div>
					<div class="col-5 ml-2 card card-body">

						<div class="row mt-1">
							<h6 class="card-title">Description</h6>
						</div>
						<div class="row mt-3">
							<textarea class="ckeditor form-control" cols="80" id="editor1" name="teamDescription" rows="2" placeholder="Description"></textarea>

						</div>


					</div>
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-6" align="right"><button type="button" class="btn btn-success" onclick="addTeam();">Save</button></div>
					<div class="col-6" align="left"><button type="button" class="btn btn-success" onclick="clearTeam();">Cancel</button></div>
				</div>

			</div>
		</nav>
	</div>
	<!-- end team -->
	<!-- load team -->
	<nav class="navbar navbar-light bg-white">
		<div class="card card-body mb-3">
			<table class="table table-hover table-bordered" style="text-align:center">
				<thead>
					<tr class="text-white" style="background-color: darkblue;">
						<th><input type="checkbox" id="checkAll"></th>
						<th>#</th>
						<th>Team</th>
						<th>Leader</th>
						<th>Decription</th>
						<th>Total pugilist</th>
						<th colspan="2">Active</th>
					</tr>
				</thead>
				<tbody class="danhsach"></tbody>
			</table>
			<div class="row" style="margin-left:78%;">
				<?php
				//$num	=ceil($rowtotal/$pagesize);
				for ($i = 1; $i <= $num; $i++) {
					echo '<button type="button" class="btn btn-raised btn-secondary" onclick="phanTrang(' . $i . ');">' . $i . '</button>&nbsp;&nbsp;&nbsp;';
				}

				?>

			</div>
		</div>
	</nav>
	<!-- end load team -->
</div>
<!-- view pug of team -->
<div class="container-fluid">
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">pugilist of <span id="titleTeamName"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>DateOfBirth</th>
							</tr>
						</thead>
						<tbody class="pugOfTeam"></tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end pug of team -->
<!-- edit team -->

<div class="container-fluid">
	<!-- Modal -->
	<div class="modal fade bd-example-modal-lg" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Edit Team</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<nav class="navbar navbar-light bg-white">
						<div class="row" style="margin-left:10%">

							<div class="col-5 card card-body">
								<div class="row mt-1">
									<h6 class="card-title">Basic Information</h6>
								</div>
								<input type="hidden" id="editTeamID">
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="Team Name" name="teamName" id="editTeamName" required="required" />
								</div>
								<div class="row mt-3">
									<input type="text" class="form-control" placeholder="Leader" name="teamLeader" id="editTeamLeader" required="required" />
								</div>
							</div>
							<div class="col-5 ml-2 card card-body">

								<div class="row mt-1">
									<h6 class="card-title">Description</h6>
								</div>
								<div class="row mt-3">
									<textarea class="ckeditor form-control" cols="80" id="editor2" name="teamDescription" rows="2" placeholder="Description"></textarea>

								</div>

							</div>
						</div>

					</nav>
					<div class="row mt-2 mb-2">
						<div class="col-6" align="right"><button type="button" class="btn btn-success" onclick="editTeam();">Save</button></div>
						<div class="col-6" align="left"><button type="button" class="btn btn-success" onclick="clearTeam();">Cancel</button></div>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

<!-- end edit team -->
<script type="text/javascript">
	$(document).ready(function() {
		phanTrang(1);
		$("#alertt").hide();
		//$("#btn_delete").hide();
		$("#alertSuccess").hide();
	});

	var dem = 1;

	function stroll() {
		if (dem % 2 != 0) {
			$('html, body').animate({
				scrollTop: 220
			}, 'slow');
		} else {
			$('html, body').animate({
				scrollTop: -50
			}, 'slow');

		}
		dem++;

	}

	$('#checkAll').click(function() {
		if ($("#checkAll").is(":checked")) {
			// do something if the checkbox is NOT checked
			$('input:checkbox').prop('checked', this.checked)
			//$("#btn_delete").show();
		} else {
			$('input:checkbox').prop('checked', false)
			//$("#btn_delete").hide();
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
				title: 'Are you sure delete this team that you will all pugilist in this team?',
				// text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#00a550',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'deleteMuliTeam.php',
						method: 'POST',
						data: {
							id: id
						},
						success: function(data) {
							$("#countTeam").text(data);
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
			})
		}
	})

	function dosearch() {
		$('#tim').keyup(function() {
			var txt = $('#tim').val();
			$.post('searchTeam.php', {
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

	function deleteTeam(teamID) {

		Swal.fire({
			title: 'Are you sure delete this team that you will all pugilist in this team?',
			// text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#00a550',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'deleteTeam.php?teamID=' + teamID,
					method: 'POST',
					success: function(data) {
						$("#countTeam").text(data);
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
			url: 'loadTeam.php?i=' + i,
			type: 'POST',
			success: function(response) {
				$('.danhsach').html(response);
				//$("#delete").attr("disabled", true);
				//$("#edit").attr("disabled", true);

			}
		})
	}

	function pass(teamID, teamName) {
		$.ajax({
			url: 'loadDataPuglOfTeam.php',
			type: 'POST',
			data: {
				teamID: teamID,
			},
			success: function(response) {
				$('.pugOfTeam').html(response);
				$('#titleTeamName').text(teamName);
				//alert(response)
				//$("#delete").attr("disabled", true);
				//$("#edit").attr("disabled", true);

			}
		})
	}

	function addTeam() {
		var teamName = $("#teamName").val();
		var teamLeader = $("#teamLeader").val();
		var teamDescription = CKEDITOR.instances['editor1'].getData();
		if (teamName == '' || teamLeader == '') {
			$("#alertt").fadeIn('slow');
		} else {
			$("#alertt").fadeOut('slow');
			$.ajax({
				url: 'xuLyAddTeam.php',
				type: 'POST',
				data: {
					teamName: teamName,
					teamLeader: teamLeader,
					teamDescription: teamDescription
				},
				success: function(data) {
					$("#countTeam").text(data);
					$("#alertSuccess").fadeIn();
					$("#alertSuccess").html("Add success &nbsp;" + "<span class='font-weight-bold'>" + teamName + "</span>");
					// Swal.fire({
					// 	position: 'top',
					// 	icon: 'success',
					// 	//title: 'Your work has been saved',
					// 	showConfirmButton: false,
					// 	timer: 1500
					// })
					phanTrang(1);
					$("#teamName").val('');
					$("#teamLeader").val('');
					CKEDITOR.instances['editor1'].setData('');


				}

			});
		}
	}

	function clearTeam() {
		$("#editTeamName").val('');
		$("#editTeamLeader").val('');
		CKEDITOR.instances['editor2'].setData('');
	}

	function passTeamID(teamID) {
		//alert(cateID);
		$.ajax({
			url: 'editTeam.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				teamID: teamID
			},
			success: function(datas) {
				$("#editTeamID").val(datas[0].teamID)
				$("#editTeamName").val(datas[0].teamName);
				$("#editTeamLeader").val(datas[0].leader);
				CKEDITOR.instances['editor2'].setData(datas[0].teamDescription);

			}
		});
	}

	function editTeam() {
		var teamName = $("#editTeamName").val();
		var teamID = $("#editTeamID").val();
		var leader = $("#editTeamLeader").val();
		var teamDescription = CKEDITOR.instances['editor2'].getData();

		$.ajax({
			url: 'xuLyEditTeam.php',
			type: 'POST',
			data: {
				teamName: teamName,
				teamID: teamID,
				leader: leader,
				teamDescription: teamDescription
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
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php include 'masterfooter.php'; ?>
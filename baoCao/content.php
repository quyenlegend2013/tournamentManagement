<?php include 'masterheader.php'; ?>
<?php
$sql		=	"SELECT * FROM categories";
$rs			=	mysqli_query($conn, $sql);
$rowtotal	=	mysqli_num_rows($rs);
$pagesize	=	10;
$num	= ceil($rowtotal / $pagesize);
?>
<div class="container-fluid">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white">
			<li class="breadcrumb-item active" aria-current="page">Content</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-4">
			<h2>Content<span class="badge badge-warning" id="countContent"><?php echo $rowtotal; ?></span></h2>
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
							$.post('searchContent.php', {
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
						+ Add Content
					</button></div>
				<div class="col-2" style="margin-left: 40%;"><button type="button" class="btn btn-raised btn-info" onclick="location.href='exportContent.php'">Export Data</button></div>
			</div>
		</div>
	</nav>
	<!-- add content -->
	<div class="collapse" id="collapseExample">
		<nav class="navbar navbar-light bg-white">
			<div class="card card-body" style="background-color: darkslategray;">
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
							<input type="text" id='cateName' class="form-control" placeholder="Content Name" name="cateName" required="required" />
						</div>
						<div class="row mt-3">
							<div class="ml-1 form-check form-check-inline">
								<input class="form-check-input" type="radio" name="cateSex" id="inlineRadio1" value="Men">
								<label class="form-check-label" for="inlineRadio1">Men</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="cateSex" id="inlineRadio2" value="Woman">
								<label class="form-check-label" for="inlineRadio2">Woman</label>
							</div>
						</div>

					</div>
					<div class="col-5 ml-2 card card-body">

						<div class="row mt-1">
							<h6 class="card-title">Description</h6>
						</div>
						<div class="row mt-3">
							<textarea class="ckeditor form-control" cols="80" id="editor1" name="cateDescription" rows="2" placeholder="Description"></textarea>
						</div>


					</div>
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-6" align="right"><button type="button" onclick="addContent();" class="btn btn-success" name="">Save</button></div>
					<div class="col-6" align="left"><button type="reset" class="btn btn-success" name="">Cancel</button></div>
				</div>


			</div>
		</nav>
	</div>
	<!-- end add content -->
	<!-- edit cate -->
	<div class="container-fluid">
		<!-- Modal -->
		<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit Content</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<nav class="navbar navbar-light bg-white">
							<div class="row" style="margin-left: 5%;">

								<div class="col-5 card card-body">
									<div class="row mt-1">
										<h6 class="card-title">Basic Information</h6>
									</div>
									<input type="hidden" name="cateID" id="cateID" />

									<div class="row mt-3">
										<input type="text" class="form-control" placeholder="Content Name" name="cateName" id="editcateName" required="required" />
									</div>
									<div class="row mt-3">
										<div class="ml-1 form-check form-check-inline">
											<input class="form-check-input" type="radio" name="editcateSex" id="inlineRadio1" value="Men">
											<label class="form-check-label" for="inlineRadio1">Men</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input" type="radio" name="editcateSex" id="inlineRadio2" value="Woman">
											<label class="form-check-label" for="inlineRadio2">Woman</label>
										</div>
									</div>


								</div>
								<div class="col-6 ml-2 card card-body">

									<div class="row mt-1">
										<h6 class="card-title">Description</h6>
									</div>
									<div class="row mt-3">
										<textarea class="ckeditor form-control" cols="80" id="editor2" name="cateDescription" rows="2" placeholder="Description"><?php echo $revalCate["cateDescription"]; ?></textarea>
									</div>

								</div>
							</div>
						</nav>
						<div class="row mt-2 mb-2">
							<div class="col-6" align="right"><button type="button" onclick="editCate();" class="btn btn-success" name="">Save</button></div>
							<div class="col-6" align="left"><button type="reset" class="btn btn-success" onclick="clearContent();">Cancel</button></div>
						</div>

					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- end edit cate -->

	<nav class="navbar navbar-light bg-white">
		<div class="card card-body mb-3">
			<table class="table table-hover table-bordered" style="text-align:center">
				<thead>
					<tr class="text-white" style="background-color: darkblue;">
						<th><input type="checkbox" id="checkAll"></th>
						<th>#</th>
						<th>Content Name</th>
						<th>Content Sex</th>
						<th>Decription</th>
						<th colspan="2">Active</th>
					</tr>
				</thead>
				<tbody class="danhsach"></tbody>
			</table>
			<div class="row" style="margin-left:78%;">
				<?php
				
				for ($i = 1; $i <= $num; $i++) {
					echo '<button type="button" class="btn btn-raised btn-secondary" onclick="phanTrang(' . $i . ');">' . $i . '</button>&nbsp;&nbsp;&nbsp;';
				}

				?>

			</div>
		</div>
	</nav>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		phanTrang(1);
		$("#alertt").hide();
		$("#alertSuccess").hide();

	});
	var dem = 1
	function stroll() {
		if (dem % 2 != 0) {
			$('html, body').animate({
				scrollTop: 220
			}, 'slow');
		}
		else
		{	
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
				title: 'Are you sure delete all content chose?',
				// text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#00a550',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url: 'deleteMuliContent.php',
						method: 'POST',
						data: {
							id: id
						},
						success: function(data) {
							//alert(data);
							$("#countContent").text(data);
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
			$.post('searchContent.php', {
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

	function deleteContent(cateID) {
		Swal.fire({
			title: 'Are you sure delete this content?',
			// text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#00a550',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: 'deleteContent.php?cateID=' + cateID,
					method: 'POST',
					success: function(data) {
						$("#countContent").text(data);
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
			url: 'loadContent.php?i=' + i,
			type: 'POST',
			success: function(response) {
				$('.danhsach').html(response);
				//$("#delete").attr("disabled", true);
				//$("#edit").attr("disabled", true);

			}
		})
	}

	function addContent() {
		var cateName = $("#cateName").val();
		var cateSex = $("input[name='cateSex']:checked").val();
		var cateDescription = CKEDITOR.instances['editor1'].getData();
		if (cateName == '' || cateDescription == '') {
			$("#alertt").fadeIn('slow');
		} else {
			$("#alertt").hide();
			$.ajax({
				url: 'xuLyAddContent.php',
				type: 'POST',
				data: {
					cateName: cateName,
					cateSex: cateSex,
					cateDescription: cateDescription
				},
				success: function(data) {
					//$("#alertSuccess").show();
					$("#alertSuccess").fadeIn();
					$("#alertSuccess").html("Add success &nbsp;" + "<span class='font-weight-bold'>" + cateName + "</span>");
					// $("#alertSuccess").fadeIn(1000);
					// $("#alertSuccess").delay(10000).fadeOut(1000);

					// Swal.fire({
					// 	position: 'top',
					// 	icon: 'success',
					// 	//title: 'Your work has been saved',
					// 	showConfirmButton: false,
					// 	timer: 1500
					// })
					$("#countContent").text(data);
					phanTrang(1);
					$("#cateName").val('');
					CKEDITOR.instances['editor1'].setData('');
				}

			});
		}
		//$("#alertSuccess").html("Add success"+"<span class='font-weight-bold'>" +cateName+"</span>");
		// $("#alertSuccess").fadeIn(1000);
		// $("#alertSuccess").delay(5000).fadeOut(1000);

	}

	function passCateID(cateID) {
		//alert(cateID);
		$.ajax({
			url: 'editContent.php',
			type: 'POST',
			dataType: 'JSON',
			data: {
				cateID: cateID
			},
			success: function(datas) {
				$("#cateID").val(datas[0].cateID)
				$("#editcateName").val(datas[0].cateName);
				$("input[name=editcateSex][value=" + datas[0].cateSex + "]").attr('checked', 'checked');
				CKEDITOR.instances['editor2'].setData(datas[0].cateDescription);

			}
		});
	}

	function editCate() {
		var cateName = $("#editcateName").val();
		var cateID = $("#cateID").val();
		var cateSex = $("input[name='editcateSex']:checked").val();
		var cateDescription = CKEDITOR.instances['editor2'].getData();

		$.ajax({
			url: 'xuLyeditContent.php',
			type: 'POST',
			data: {
				cateID: cateID,
				cateName: cateName,
				cateSex: cateSex,
				cateDescription: cateDescription
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

	function clearContent() {
		$("#cateID").val('')
		$("#editcateName").val('');
		CKEDITOR.instances['editor2'].setData('');
	}
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php include 'masterfooter.php'; ?>
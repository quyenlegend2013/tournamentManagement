<?php include("masterheader.php") ?>
<?php
$sql        =    "SELECT * FROM dk";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$num    = ceil($rowtotal / $pagesize);

$datecurrent = date("d/m/Y");
$sqlTourName = 'SELECT tourID,tourName FROM tournament WHERE (CURDATE() >= openingTime  AND CURDATE() <= endTime) OR endTime > CURDATE()';
$queryTourName = mysqli_query($conn, $sqlTourName);
$queryeditTourName = mysqli_query($conn, $sqlTourName);
?>
<div class="container-fluid">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">DK</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-4">
            <h2>DK<span class="badge badge-warning" id="countDK"><?php echo $rowtotal; ?></span></h2>
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
                            $.post('searchDK.php', {
                                data: t
                            }, function(data) {
                                if (t == "") //add  t.indexOf("xóa")!=-1
                                {
                                    //r.value="";
                                    phanTrang(1);
                                } else {
                                    $('#listDK').html(data);
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
                        + Add DK
                    </button></div>
                <div class="col-2" style="margin-left: 45%;"><button type="button" class="btn btn-raised btn-info" onclick="location.href='exportDK.php'">Export Data</button></div>
            </div>
        </div>

    </nav>

    <!-- add DK -->
    <div class="collapse" id="collapseExample">
        <nav class="navbar navbar-light bg-white">
            <div class="card card-body" style="background-color: crimson">
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
                            <input type="text" id='dkName' class="form-control" placeholder="DK Name" name="dkName" id="dkName" required="required" />
                        </div>
                        <div class="row mt-3">
                            <select name="belongtoExam" class="form-control" id="belongtoExam">
                                <?php
                                echo "<option value='0'>---</option>";
                                echo "<option value='1'>No</option>";
                                while ($rs = mysqli_fetch_assoc($queryTourName)) {
                                    echo "<option value='" . $rs['tourID'] . "'>" . $rs["tourName"] . "</option>";
                                }

                                ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-5 ml-2 card card-body">
                        <div class="row mt-1">
                            <h6 class="card-title">Description</h6>
                        </div>
                        <div class="row mt-3">
                            <textarea class="ckeditor form-control" cols="80" id="editor1" name="dkDescription" rows="2" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-6" align="right"><button type="button" onclick="addDK();" class="btn btn-success" name="">Save</button></div>
                    <div class="col-6" align="left"><button type="reset" class="btn btn-success" name="">Cancel</button></div>
                </div>
            </div>
        </nav>
    </div>
    <!-- end DK -->
    <!-- load list dk -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body mb-3">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>#</th>
                        <th>DK name</th>
                        <th>Belong to</th>
                        <th>Description</th>
                        <th colspan="4">Action</th>
                    </tr>
                </thead>
                <tbody id="listDK"></tbody>
            </table>
            <div class="row" style="margin-left:78%;">
                <?php
                //$num	=ceil($rowtotal/$pagesize);
                for ($i = 1; $i <= $num; $i++) {
                    echo '<button id="anphantrang" type="button" class="btn btn-raised btn-secondary" onclick="phanTrang(' . $i . ');">' . $i . '</button>&nbsp;&nbsp;&nbsp;';
                }
                ?>
            </div>
        </div>
    </nav>
    <!-- end list dk -->
</div>
<!-- edit dk -->
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit DK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row" style="margin-left:10%">

                        <div class="col-5 card card-body">
                            <div class="row mt-1">
                                <h6 class="card-title">Basic Information</h6>
                            </div>
                            <input type="hidden" id="editdkID">
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="DK Name" id="editdkName" required="required" />
                            </div>
                            <div class="row mt-3">
                                <select name="belongtoExam" class="form-control" id="editbelongtoExam">
                                    <?php
                                    echo "<option value='0'>---</option>";
                                    echo "<option value='1'>No</option>";
                                    while ($rs = mysqli_fetch_assoc($queryeditTourName)) {
                                        echo "<option value='" . $rs['tourID'] . "'>" . $rs["tourName"] . "</option>";
                                    }

                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-5 ml-2 card card-body">
                            <div class="row mt-1">
                                <h6 class="card-title">Description</h6>
                            </div>
                            <div class="row mt-3">
                                <textarea class="ckeditor form-control" cols="80" id="editor2" name="editdkDescription" rows="2" placeholder="Description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-6" align="right"><button type="button" onclick="editDK();" class="btn btn-success" name="">Save</button></div>
                        <div class="col-6" align="left"><button type="button" class="btn btn-success" onclick="clearDK();">Cancel</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end edit dk -->
<!-- view puglist of dk -->
<div class="container-fluid">
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pugilist of <span id="s"></span></h5>
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
                        <tbody class="pugOfDK"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end pugilist of dk -->

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
                scrollTop: 200
            }, 'slow');
        } else {
            $('html, body').animate({
                scrollTop: -10
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
                title: 'Are you sure delete all DK that you chose?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a550',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'deleteMuliDK.php',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $("#countDK").text(data);
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

    function pass(dkID, dkName) {
        $('#s').text(dkName);
        $.ajax({
            url: 'loadDataPuglOfDK.php',
            type: 'POST',
            data: {
                dkID: dkID,
            },
            success: function(response) {
                $('.pugOfDK').html(response);

            }
        })
    }

    function phanTrang(i) {
        $.ajax({
            url: 'loaddk.php',
            type: 'POST',
            data: {
                i: i
            },
            success: function(data) {
                $("#listDK").html(data);
            }
        });
    }

    function addDK() {
        var dkName = $("#dkName").val();
        var belongtoExam = $("#belongtoExam").val();
        var dkDescription = CKEDITOR.instances['editor1'].getData();
        //alert(belongtoExam);
        if (dkName == '' || belongtoExam == '') {
            $("#alertt").fadeIn('slow');
        } else {
            $("#alertt").fadeOut('slow');
            $.ajax({
                url: 'xuLyAddDK.php',
                type: 'POST',
                data: {
                    dkName: dkName,
                    belongtoExam: belongtoExam,
                    dkDescription: dkDescription
                },
                success: function(data) {
                    $("#countDK").text(data);
                    $("#alertSuccess").fadeIn();
                    $("#alertSuccess").html("Add success &nbsp;" + "<span class='font-weight-bold'>" + dkName + "</span>");

                    phanTrang(1);
                    $("#dkName").val('');
                    $("#belongtoExam").val('');
                    CKEDITOR.instances['editor1'].setData('');
                }

            });
        }
    }

    function deletedk(dkID) {
        Swal.fire({
            title: 'Are you sure delete this DK?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00a550',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'deletedk.php',
                    method: 'POST',
                    data: {
                        dkID: dkID
                    },
                    success: function(data) {
                        $("#countDK").text(data);
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

    function passdkID(dkID) {
        //alert(cateID);
        $.ajax({
            url: 'editdk.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                dkID: dkID
            },
            success: function(datas) {
                $("#editdkID").val(datas[0].dkID);
                $("#editdkName").val(datas[0].dkName);
                $("#editbelongtoExam").val(datas[0].belongtoExam);
                CKEDITOR.instances['editor2'].setData(datas[0].dkDescription);

            }
        });
    }

    function editDK() {
        var dkID = $("#editdkID").val();
        var dkName = $("#editdkName").val();
        var belongtoExam = $("#editbelongtoExam").val();
        var dkDescription = CKEDITOR.instances['editor2'].getData();
        $.ajax({
            url: 'xuLyEditdk.php',
            type: 'POST',
            data: {
                dkID: dkID,
                dkName: dkName,
                belongtoExam: belongtoExam,
                dkDescription: dkDescription
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

    function clearDK() {
        $("#editdkName").val('');
        $("#editbelongtoExam").val('');
        CKEDITOR.instances['editor2'].setData('');
    }

    function dosearch() {
        $('#tim').keyup(function() {
            var txt = $('#tim').val();
            $.post('searchDK.php', {
                data: txt
            }, function(data) {
                if (txt == "") {
                    phanTrang(1);
                } else {
                    $('#listDK').html(data);
                }

            })
        })
    };
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php include("masterfooter.php") ?>
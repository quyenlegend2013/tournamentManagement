<?php include 'masterheader.php'; ?>
<?php
$sql        =    "SELECT * FROM tournament";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$num    = ceil($rowtotal / $pagesize);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">Tournament</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-4">
            <h2>Tournament<span class="badge badge-warning" id="countTournament"><?php echo $rowtotal; ?></span></h2>
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
                <div class="col-3">
                    <button class="btn btn-info" type="button" data-toggle="collapse" onclick="stroll();" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        + Add tournament
                    </button></div>
                <div class="col-2" style="margin-left: 45%;"><button type="button" class="btn btn-raised btn-info" onclick="location.href='exportTournament.php'">Export Data</button></div>
            </div>
        </div>
    </nav>
    <!-- add exam  -->
    <div class="collapse" id="collapseExample">
        <nav class="navbar navbar-light bg-white">
            <div class="card card-body" style="background-color: darkcyan">
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
                            <input type="text" class="form-control" placeholder="Tour Name" id="addtourName" name="tourName" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="text" class="form-control" placeholder="Organizers" id="addorganizers" name="organizers" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="text" class="form-control" placeholder="Accusative" id="addaccusative" name="accusative" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="text" class="form-control" placeholder="Role" id="addrole" name="role" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="email" class="form-control" placeholder="Email" id="addemail" name="email" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="number" class="form-control" placeholder="Phone" id="addphone" name="phone" required="required" />
                        </div>
                        <div class="row mt-3">
                            <input type="text" class="form-control" placeholder="Place" id="addplace" name="place" required="required" />
                        </div>

                    </div>
                    <div class="col-5 ml-2 card card-body">

                        <div class="row mt-1">
                            <h6 class="card-title">Object</h6>
                        </div>
                        <div class="row mt-3">
                            <textarea class="ckeditor form-control" cols="80" id="addeditor1" name="object" rows="2"></textarea>
                        </div>

                    </div>
                </div>

                <div class="row mt-2" style="margin-left:10%">

                    <div class="col-5 card card-body">
                        <div class="row mt-1">
                            <h6 class="card-title">Time of tour</h6>
                        </div>
                        <div class="row mt-3">
                            <input type="datetime-local" class="form-control" placeholder="Opening time" id="addopeningTime" name="openingTime" required="required" onchange="checkdateAdd();" />
                        </div>
                        <div class="row mt-3">
                            <input type="datetime-local" class="form-control" placeholder="End time" id="addendTime" name="endTime" required="required" onchange="checkdateAdd();" />
                            <p id="alertdateAdd" style="color: red;"></p>
                        </div>
                        <div class="row mt-3">
                            <input type="text" class="form-control" placeholder="Competition time" id="addcompetitionTime" name="competitionTime" required="required" />
                        </div>
                    </div>
                </div>

                <div class="row mt-2 mb-2">
                    <div class="col-6" align="right"><button type="button" id="addSave" class="btn btn-info" onclick="addExam();">Save</button></div>
                    <div class="col-6" align="left"><button type="reset" class="btn btn-info" name="">Cancel</button></div>
                </div>

            </div>
        </nav>
    </div>
    <!-- end add -->

    <!-- load list exam -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>#</th>
                        <th>Tour name</th>
                        <th>Organnizers</th>
                        <th>Accusative</th>
                        <th colspan="4">Active</th>
                        <th>Status</th>
                        
                    </tr>
                </thead>
                <tbody class="danhsach"></tbody>
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
    <!-- end list exam -->
</div>
<!-- view infor exam -->
<div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pugilist of this tournament <span class="badge badge-warning" id='countTour'></span> </h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body">

                    <p id="tourName" class=" h2 text-center"></p>
                    <p><span class='font-weight-bold'>Object</span> :<span id="object"></span></p>
                    <p><span class='font-weight-bold'>Organizers</span>:<span id='organizers'></span></p>
                    <p><span class='font-weight-bold'>Accusative</span>:<span id="accusative"></span></p>
                    <p><span class='font-weight-bold'>Role</span>:<span id="role"></span></p>
                    <p><span class='font-weight-bold'>Place</span>:<span id="place"></span></p>
                    <p><span class='font-weight-bold'>Email</span>:<span id="email"></span></p>
                    <p><span class='font-weight-bold'>Phone</span>:<span id="phone"></span></p>
                    <p><span class='font-weight-bold'>Times</span>:<span id="times"></span></p>
                    <p><span class='font-weight-bold'>Time Fisnish</span>:<span id="timeFisnish"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end view infor -->

<!-- edit exam -->
<div class="container-fluid">

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">View</h5>
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
                            <input type="hidden" name="tourID" id="edittourID" />
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Tour Name" name="tourName" id="edittourName" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Organizers" name="organizers" id="editorganizers" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Accusative" name="accusative" id="editaccusative" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Role" name="role" id="editrole" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Place" name="place" id="editplace" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" id="editemail" required="required" />
                            </div>
                            <div class="row mt-3">
                                <input type="number" class="form-control" placeholder="Phone" name="phone" id="editphone" required="required" />
                            </div>

                        </div>
                        <div class="col-5 ml-2 card card-body">

                            <div class="row mt-1">
                                <h6 class="card-title">Object</h6>
                            </div>
                            <div class="row mt-3">
                                <textarea class="ckeditor form-control" cols="80" id="editor2" name="object" rows="2"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="row mt-2" style="margin-left:10%">

                        <div class="col-5 card card-body">
                            <div class="row mt-1">
                                <h6 class="card-title">Time of tour</h6>
                            </div>
                            <div class="row mt-3">
                                <input type="datetime-local" class="form-control" placeholder="Opening time" name="openingTime" id="editopeningTime" required="required" onchange="checkdateedit();" />
                            </div>
                            <div class="row mt-3">
                                <input type="datetime-local" class="form-control" placeholder="end time" name="endTime" id="editendTime" required="required" onchange="checkdateedit();" />
                                <p id="alertdate"></p>
                            </div>
                            <div class="row mt-3">
                                <input type="text" class="form-control" placeholder="Competition time" name="competitionTime" id="editcompetition" required="required" />
                            </div>

                        </div>
                    </div>

                    <div class="row mt-2 mb-2">
                        <div class="col-6" align="right"><button type="button" id="editSave" class="btn btn-info" onclick="editTournament();">Save</button></div>
                        <div class="col-6" align="left"><button type="button" class="btn btn-info" onclick="clearExam();">Cancel</button></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end edit exam -->

<script type="text/javascript">
    $(document).ready(function() {
        phanTrang(1);
        $("#alertt").hide();
        $("#alertSuccess").hide();
    });
    var dem = 1;

    // cuon trang and tournamnet
    function stroll() {
        if (dem % 2 != 0) {
            $('html, body').animate({
                scrollTop: 300
            }, 'slow');
        } else {
            $('html, body').animate({
                scrollTop: -10
            }, 'slow');

        }
        dem++;

    }
    // end cuon trang and tournamnet

    // thong bao khi ngươi dung  click vao button  enable
    function errorSetting() {
        alertify.error('You can\'t setting this tour when it was the end');
        // end thong bao khi ngươi dung  click vao button enable
    }
    // thong bao khi ngươi dung  click vao button sua enable
    function errorEdit() {
        alertify.error('You can\'t Edit this tour when it was the end');
    }
    // end thong bao khi ngươi dung  click vao button sua enable

    // load data 
    function phanTrang(i) {
        $.ajax({
            url: 'loadTournament.php?i=' + i,
            type: 'POST',
            success: function(response) {
                $('.danhsach').html(response);
                //$("#delete").attr("disabled", true);
                //$("#edit").attr("disabled", true);

            }
        })
    }
    // end load data

    function deleteTournament(tourID) {


        Swal.fire({
            title: 'Are you sure delete this tour?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00a550',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'deleteTournament.php?tourID=' + tourID,
                    method: 'POST',
                    success: function(data) {
                        $("#countTournament").text(data);

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


    function pass(tourID) {
        $.ajax({
            url: 'loadDataViewOfTournament.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                tourID: tourID,
            },
            success: function(response) {
                var obj = response[0].object;
                var cutheader = obj.replace("<p>", "");
                var cutfooter = cutheader.replace("</p>", "");
                //alert( moment().format('MMM D, YYYY'));
                $('#tourName').text(response[0].tourName);
                $('#organizers').text(' ' + response[0].organizers);
                $('#object').html(' ' + cutfooter);
                $('#role').text('   ' + response[0].role);
                $('#place').text('  ' + response[0].place);
                $('#email').text('  ' + response[0].email);
                $('#phone').text('  ' + response[0].phone);
                $('#accusative').text(' ' + response[0].accusative);
                $('#times').text('  ' + response[0].openingTime + " - " + response[0].endTime);
                $('#timeFisnish').text('    ' + response[0].competitionTime);

            }
        });

        $.ajax({
            url: 'getCountpugTour.php',
            type: 'POST',
            data: {
                tourID: tourID
            },
            success: function(data) {
                //alert(data);
                $('#countTour').css("font-size", "25px");
                $('#countTour').text(data);

            }
        });

    }

    function addExam() {

        var tourName = $("#addtourName").val();
        var organizers = $("#addorganizers").val();
        var accusative = $("#addaccusative").val();
        var role = $("#addrole").val();
        var email = $("#addemail").val();
        var phone = $("#addphone").val();
        var place = $("#addplace").val();
        var openingTime = $("#addopeningTime").val();
        var endTime = $("#addendTime").val();
        var competitionTime = $("#addcompetitionTime").val();
        var object = CKEDITOR.instances['addeditor1'].getData();
        // alert(openingTime+"-"+endTime);
        if (tourName == '' || organizers == '' || accusative == '' || email == '' || object == '' || openingTime == '' || endTime == '') {
            $("#alertt").fadeIn('slow');
        } else {
            $("#alertt").fadeOut('slow');
            $.ajax({
                url: 'xuLyAddTournament.php',
                type: 'POST',
                data: {
                    tourName: tourName,
                    organizers: organizers,
                    accusative: accusative,
                    role: role,
                    email: email,
                    phone: phone,
                    place: place,
                    openingTime: openingTime,
                    endTime: endTime,
                    competitionTime: competitionTime,
                    object: object

                },
                success: function(data) {
                    $("#countTournament").text(data);
                    $("#alertSuccess").fadeIn();
                    $("#alertSuccess").html("Add success &nbsp;" + "<span class='font-weight-bold'>" + tourName + "</span>");
                    // Swal.fire({
                    //     position: 'top',
                    //     icon: 'success',
                    //     //title: 'Your work has been saved',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })
                    phanTrang(1);

                }

            });
        }
    }

    function passtourID(tourID) {
        //alert(tourID);
        $.ajax({
            url: 'editTournament.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                tourID: tourID
            },
            success: function(datas) {
                $("#edittourID").val(datas[0].tourID);
                $("#edittourName").val(datas[0].tourName);
                $("#editaccusative").val(datas[0].accusative);
                $("#editorganizers").val(datas[0].organizers);
                $("#editrole").val(datas[0].role);
                $("#editplace").val(datas[0].place);
                $("#editphone").val(datas[0].phone);
                $("#editemail").val(datas[0].email);
                $("#editcompetition").val(datas[0].competitionTime);
                CKEDITOR.instances['editor2'].setData(datas[0].object);
                $("#editendTime").val(moment(datas[0].endTime).format('YYYY-MM-DDTHH:mm'));
                $("#editopeningTime").val(moment(datas[0].openingTime).format('YYYY-MM-DDTHH:mm'));

            }
        });
    }

    function editTournament() {
        var tourID = $("#edittourID").val();
        var tourName = $("#edittourName").val();
        var accusative = $("#editaccusative").val();
        var organizers = $("#editorganizers").val();
        var role = $("#editrole").val();
        var place = $("#editplace").val();
        var phone = $("#editphone").val();
        var email = $("#editemail").val();
        var competitionTime = $("#editcompetition").val();
        var object = CKEDITOR.instances['editor2'].getData();
        var endTime = $("#editendTime").val();
        var openingTime = $("#editopeningTime").val();
        // alert(endTime+"-"+openingTime);
        $.ajax({
            url: 'xuLyEditTournament.php',
            type: 'POST',
            data: {
                tourID: tourID,
                tourName: tourName,
                accusative: accusative,
                organizers: organizers,
                role: role,
                place: place,
                phone: phone,
                email: email,
                competitionTime: competitionTime,
                object: object,
                endTime: endTime,
                openingTime: openingTime

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

    function clearExam() {
        $("#edittourID").val('');
        $("#edittourName").val('');
        $("#editaccusative").val('');
        $("#editorganizers").val('');
        $("#editrole").val('');
        $("#editplace").val('');
        $("#editphone").val('');
        $("#editemail").val('');
        $("#editcompetition").val('');
        CKEDITOR.instances['editor2'].setData('');
        $("#editendTime").val('');
        $("#editopeningTime").val('');
    }

    function checkdateedit() {
        var start = $("#editopeningTime").val();
        var end = $("#editendTime").val();
        var startDate = new Date(start);
        var endDate = new Date(end);
        startDate.setHours(0, 0, 0, 0);
        endDate.setHours(0, 0, 0, 0);

        if (endDate < startDate) {

            $("#editSave").attr("disabled", true);
            $("#alertdate").text("Date start is greater than date end!!!");
            $("#alertdate").css('color', 'red');
            $("#alertdate").show();

        } else {
            $("#editSave").attr("disabled", false);
            $("#alertdate").hide();

        }

    }
    function checkdateAdd() {
        var start = $("#addopeningTime").val();
        var end = $("#addendTime").val();

        var startDate = new Date(start);
        var endDate = new Date(end);
        startDate.setHours(0, 0, 0, 0);
        endDate.setHours(0, 0, 0, 0);

        if (endDate < startDate) {

            $("#addSave").attr("disabled", true);
            $("#alertdateAdd").text("Date start is greater than date end!!!");
            $("#alertdateAdd").show();

        } else {
            $("#addSave").attr("disabled", false);
            $("#alertdateAdd").hide();

        }
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
                title: 'Are you sure delete all exam that you chose?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a550',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'deleteMuliexam.php',
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $("#countTournament").text(data);
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
            $.post('searchExam.php', {
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
</script>
<style type="text/css">
    a.disabled {
        pointer-events: none;
        color: #ccc;
    }
</style>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/moment-with-locales.min.js"></script>
<?php include 'masterfooter.php'; ?>
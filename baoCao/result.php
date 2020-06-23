<?php include 'masterheader.php'; ?>
<?php
$sql        =    "SELECT * FROM result";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$num    = ceil($rowtotal / $pagesize);
?>
<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">Result</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-4" style="margin-left:60%;">
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
                            $.post('searchResult.php', {
                                data: t
                            }, function(data) {
                                if (t == "") //add  t.indexOf("xóa")!=-1
                                {
                                    //r.value="";
                                    phanTrang(1);
                                } else {
                                    $('.listResult').html(data);
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
    <!-- load list -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>Tour Name</th>
                        <th>Opening time</th>
                        <th>End time</th>
                        <th>Compettion time</th>
                        <th colspan="1">Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class='listResult'>
                </tbody>
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
</div>
<!-- end load list -->
<!-- modal pug of result -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> <span id='tourName'></span></h5>
                <form method="POST" action="exportResultPug.php">
                    <input type="hidden" name="popuptourID" id="popuptourID">
                    
                    <button type="submit" class="btn btn-info">Export Data</button>
                </form>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pug Name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id='views'></tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- end modal pug of result  -->

<script>
    $(document).ready(function() {
        phanTrang(1);
    });

    function phanTrang(i) {
        $.ajax({
            url: 'loadDataListResult.php?i=' + i,
            type: 'POST',
            success: function(response) {
                $('.listResult').html(response);
               

            }
        })
    }

    function exportResultPug() {
        var tourID = $('#popuptourID').val();
        //alert(tourID);
        $.ajax({
            url: 'exportResultPug.php',
            type: 'POST',
            data: {
                tourID: tourID
            },
            success: function(data) {
                //alert("thanh cong")

            }
        });
    }

    function passModel(tourID, tourName) {
        $('#tourName').text(tourName);
        $('#popuptourID').val(tourID);

        $.ajax({
            url: 'viewListPugOfResult.php',
            type: 'POST',
            data: {
                tourID: tourID
            },
            success: function(data) {

                var da = $.parseJSON(data);
                var htm = '';
                var stt = 1;
                $.each(da, function(key, item) {
                    htm += '<tr>';
                    htm += '<td>' + stt + '</td>';
                    htm += '<td>' + item.pugName + '</td>';
                    htm += '<td>' + item.total + '</td>';
                    htm += '</tr>';
                    stt++;
                });
                $('#views').html(htm);
            }

        });
    }

    function dosearch() {
        $('#tim').keyup(function() {
            var txt = $('#tim').val();
            $.post('searchResult.php', {
                data: txt
            }, function(data) {
                if (txt == "") {
                    phanTrang(1);
                } else {
                    $('.listResult').html(data);
                }

            })
        })
    };
</script>
<?php include 'masterfooter.php'; ?>
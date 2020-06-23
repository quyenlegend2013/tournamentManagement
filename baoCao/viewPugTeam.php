<?php include 'masterheader.php'; ?>
<?php
$tourteamID = $_GET["tourteamID"];
$teamID = $_GET["teamID"];
$tourID = $_GET['tourID'];
$sqlteamName = "SELECT teamName FROM team WHERE teamID='$teamID'";
$queryteamName = mysqli_query($conn, $sqlteamName);
$revalTeamName = mysqli_fetch_array($queryteamName);
?>

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="exam.php">Tournament</a></li>
            <li class="breadcrumb-item"><a href="detailTour.php?tourID=<?php echo $tourID; ?>">Detail tournament</a></li>
            <li class="breadcrumb-item active" aria-current="page">Insert pugilist of team</li>
        </ol>
    </nav>
    <div class="container-fluid">
        <!-- <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" id="progBar" role="progressbar" style="width: 100%" aria-valuemin="0" aria-valuemax="100"></div>
        </div> -->
    </div>
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <div class="row">
                <div class="col-7">
                    <h3>List pugilist of <?php echo $revalTeamName["teamName"]; ?></h3>
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-2" style="margin-left: 2%;"><button class="btn btn-warning" name="btn_insert" id="btn_insert">Insert</button></div>
                <div class="col-5" style="margin-left: 35%;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." id="tim" onClick="searchPug();" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                </div>

            </div>
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>#</th>
                        <th>Pug name</th>
                        <th>Team name</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody class="listShowPugTeam"></tbody>
            </table>
        </div>

    </nav>

    <nav class="navbar navbar-light bg-white">

        <div class="card card-body">
            <div class="row">
                <div class="col-7">
                    <h3>List pugilist added</h3>
                </div>
                <div class="col-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." id="timAdded" onClick="searchPugAdded();">
                    </div>
                </div>

            </div>

            <table class="table" style="text-align:center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pug name</th>
                        <th>Team name</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody class="listShowPugTeamAdded"></tbody>
            </table>
        </div>

    </nav>
    <div class="row mt-2 mb-2" style="margin-left:85%;">
        <button type="button" class="btn btn-primary" onclick="location.href='detailTour.php?tourID=<?php echo $tourID; ?>'"><i class="fas fa-caret-square-left"></i></button>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        listShowPugTeam();
        listShowPugTeamAdded();

    });

    $('#checkAll').click(function() {
        if ($("#checkAll").is(":checked")) {
            // do something if the checkbox is NOT checked
            $('input:checkbox').prop('checked', this.checked)
            //$("#btn_delete").show();
        } else {
            $('input:checkbox').prop('checked', false)
        }

    });

    $('#btn_insert').click(function() {
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
                text: 'Please Select one checkbox to insert',
                //footer: '<a href>Why do I have this issue?</a>'
            })

        }
        //alert(JSON.stringify(id));
        else {
            var tourteamID = '<?php echo $tourteamID; ?>'
            $.ajax({
                url: 'insertMuliPugTeam.php',
                method: 'POST',
                data: {
                    id: id,
                    tourteamID: tourteamID
                },
                success: function(data) {
                    listShowPugTeam();
                    listShowPugTeamAdded();
                    //alert(data);
                    //$("#countContent").text(data);
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        //title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            });

        }
    })

    function listShowPugTeam() {
        var tourteamID = "<?php echo $tourteamID ?>";
        var teamID = "<?php echo $teamID ?>";
        var tourID = "<?php echo $tourID ?>";

        $.ajax({
            url: 'showTourPugTeam.php',
            type: 'POST',
            data: {
                tourteamID: tourteamID,
                teamID: teamID,
                tourID: tourID
            },
            success: function(response) {
                $('.listShowPugTeam').html(response);
                listShowPugTeamAdded();

            }
        })
    }

    function listShowPugTeamAdded() {
        var tourteamID = "<?php echo $tourteamID ?>";

        $.ajax({
            url: 'showTourPugTeamAdded.php',
            type: 'POST',
            data: {
                tourteamID: tourteamID,
            },
            success: function(response) {
                $('.listShowPugTeamAdded').html(response);

            }
        })
    }

    function error() {
        alertify.error('You added this pugilist');
    }

    function deletePugAdded(pugID, tourteamID) {
        //alert(pugID+"-"+tourteamID);
        Swal.fire({
            title: 'Are you sure delete this it?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#00a550',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'deletePugTeamAdded.php',
                    method: 'POST',
                    data: {
                        pugID: pugID,
                        tourteamID: tourteamID
                    },
                    success: function(data) {

                        listShowPugTeamAdded();
                        listShowPugTeam();
                    },

                });
                Swal.fire(
                    'Deleted!',
                    'success'
                )
            }
        })
    }

    function insertTourPugTeam(pugID, tourteamID) {
        //alert(tourteamID+'-'+pugID);
        $.ajax({
            url: 'xulyViewPugTour.php',
            type: 'POST',
            data: {
                tourteamID: tourteamID,
                pugID: pugID
            },
            success: function(data) {
                listShowPugTeam();
                alertify.success('Add Success');


            }
        });

    }

    function searchPug() {
        var tourteamID = "<?php echo $tourteamID ?>";
        var teamID = "<?php echo $teamID ?>";
        var tourID = "<?php echo $tourID ?>";
        $("#tim").keyup(function() {
            var txt = $("#tim").val();
            $.post('searchPugOfTeam.php', {
                data: txt,
                tourteamID: tourteamID,
                teamID: teamID,
                tourID: tourID
            }, function(data) {
                if (txt == "") {
                    listShowPugTeam();
                } else {
                    $('.listShowPugTeam').html(data);
                }

            })
        })

    }

    function searchPugAdded() {
        var tourteamID = "<?php echo $tourteamID; ?>";
        $("#timAdded").keyup(function() {
            var txt = $("#timAdded").val();
            $.post('searchPugOfTeamAdded.php', {
                data: txt,
                tourteamID: tourteamID
            }, function(data) {
                if (txt == "") {
                    listShowPugTeamAdded();
                } else {
                    $('.listShowPugTeamAdded').html(data);
                }

            })
        })
    }
</script>

<?php include 'masterfooter.php'; ?>
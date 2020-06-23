<?php include 'masterheader.php'; ?>
<?php
$tourID = $_GET["tourID"];

$sql        =    "SELECT * FROM team";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    5;
$num    = ceil($rowtotal / $pagesize);

$sqlCate        =    "SELECT * FROM categories";
$rsCate            =    mysqli_query($conn, $sqlCate);
$rowtotalCate    =    mysqli_num_rows($rsCate);
$pagesizeCate    =    5;
$numCate    = ceil($rowtotalCate / $pagesizeCate);
?>
<div class="container-fluid mb-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item"><a href="exam.php">Tournament</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail tournament</li>
        </ol>
    </nav>
    <!-- load tour team -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <h3 style="color: blue;">Team of tournament</h3>
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>Team</th>
                        <th>Leader</th>
                        <th>Decription</th>
                        <th colspan="2">Active</th>
                    </tr>
                </thead>
                <tbody class="danhsach"></tbody>
            </table>
            <div class="row mt-2" style="margin-left:85%;">
                <!-- <button type="button" class="btn btn-success" onclick="location.href='viewTeamTour.php?tourID=<?php //echo $tourID; 
                                                                                                                    ?>'"><i class="fas fa-user-plus"></i></button> -->
                <button type="button" class="btn btn-success" data-toggle="modal" onclick="" data-target=".bd-example-modal-lg"><i class="fas fa-user-plus"></i></button>
            </div>
        </div>
    </nav>
    <!-- end tour team -->
    <!-- tour cate -->
    <nav class="navbar navbar-light bg-white">
        <div class="card card-body">
            <h3 style="color: blue;">Content of tournament</h3>
            <table class="table table-hover table-bordered" style="text-align:center">
                <thead>
                    <tr class="text-white" style="background-color: darkblue;">
                        <th>#</th>
                        <th>Cate Name</th>
                        <th>Decription</th>
                        <th colspan="2">Active</th>
                    </tr>
                </thead>
                <tbody class="listShowContent"></tbody>
            </table>
            <div class="row mt-2" style="margin-left:85%;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter1"><i class="fas fa-user-plus"></i></button>
            </div>

        </div>
    </nav>
    <!-- end tour cate -->

    <!-- modal team -->
    <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Lists</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card card-body">
                            <table class="table" style="text-align:center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Team Name</th>
                                        <th>Decription</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody class="listShowTeam"></tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end moal team -->
    <!-- modal tour cate -->
    <div class="container-fluid">
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Lists</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-body">
                            <table class="table" style="text-align:center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Cate Name</th>
                                        <th>Decription</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody class="listContent"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal tour cate -->
    <script type="text/javascript">
        $(document).ready(function() {
            phanTrangTeam(1);
            phanTrangcate(1);
            //phanTrangDK(1);
            listteam();
            listCate();
            //listpug();

        });

        function phanTrangTeam(i) {
            var tourID = "<?php echo $tourID ?>";

            $.ajax({
                url: 'showTourTeam.php?i=' + i,
                type: 'POST',
                data: {
                    tourID: tourID
                },
                success: function(response) {
                    $('.danhsach').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);

                    // if ($('.danhsach tr').length) {
                    //     $("#progBar").attr("style", "width: 50%");

                    // } else {
                    //     $("#progBar").attr("style", "width: 0%");
                    // }

                }
            })
        }

        function phanTrangcate(i) {
            var tourID = "<?php echo $tourID ?>";
            $.ajax({
                url: 'showTourCate.php?i=' + i,
                type: 'POST',
                data: {
                    tourID: tourID
                },
                success: function(response) {
                    $('.listShowContent').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);
                    // if ($('.listShowContent tr').length) {
                    //     $("#progBarcate").attr("style", "width: 50%");

                    // } else {
                    //     $("#progBarcate").attr("style", "width: 0%");
                    // }

                }
            })
        }

        function error() {
            alertify.error('You added it');
        }

        function deleteTourTeam(teamID, tourID, tourteamID) {

            Swal.fire({
                title: 'Are you sure delete it?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a550',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'deleteTourTeam.php',
                        type: 'GET',
                        data: {
                            teamID: teamID,
                            tourID: tourID,
                            tourteamID: tourteamID
                        },
                        success: function(data) {
                            phanTrangTeam(1);
                            listteam();
                        }

                    });
                    Swal.fire(
                        'Deleted!',
                        'success'
                    )
                }
            })
        }

        function deleteTourCate(tourcateID, tourID) {
            //alert(tourcateID+'-'+tourID);

            Swal.fire({
                title: 'Are you sure delete it?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00a550',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'deleteTourCate.php',
                        type: 'GET',
                        data: {
                            tourID: tourID,
                            tourcateID: tourcateID
                        },
                        success: function(data) {
                            phanTrangcate(1);
                            listCate();
                        }

                    });
                    Swal.fire(
                        'Deleted!',
                        'success'
                    )
                }
            })

        }


        function listteam() {
            var tourID = "<?php echo $tourID ?>";
            $.ajax({
                url: 'loadTeamTour.php',
                type: 'POST',
                data: {
                    tourID: tourID
                },
                success: function(response) {
                    $('.listShowTeam').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);



                }
            })
        }

        function listCate() {
            var tourID = "<?php echo $tourID ?>";
            $.ajax({
                url: 'loadCateTour.php',
                type: 'POST',
                data: {
                    tourID: tourID
                },
                success: function(response) {
                    $('.listContent').html(response);
                    //$("#delete").attr("disabled", true);
                    //$("#edit").attr("disabled", true);

                }
            })
        }

        function insertTourTeam(teamID, tourID) {
            //alert(teamID+'-'+tourID);
            $.ajax({
                url: 'xulyTeamTour.php',
                type: 'GET',
                data: {
                    teamID: teamID,
                    tourID: tourID
                },
                success: function(data) {
                    phanTrangTeam(1);
                    listteam();
                    Swal.fire({
                        position: 'end',
                        icon: 'success',
                        //title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            });

        }

        function insertTourCate(cateID, tourID) {
            //alert(cateID+'-'+tourID);
            $.ajax({
                url: 'xulyCateTour.php',
                type: 'GET',
                data: {
                    cateID: cateID,
                    tourID: tourID
                },
                success: function(data) {
                    phanTrangcate(1);
                    listCate();
                    Swal.fire({
                        position: 'end',
                        icon: 'success',
                        //title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
            });

        }
    </script>
    <?php include 'masterfooter.php'; ?>
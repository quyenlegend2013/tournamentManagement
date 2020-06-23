<?php include 'masterheader.php'; ?>
<?php
$sqlTeam = "SELECT * FROM team";
$sqlPugilist = "SELECT * FROM pugilist";
$sqltour = "SELECT * FROM tournament";
$sqlcate = "SELECT * FROM categories";

$queryTeam = mysqli_query($conn, $sqlTeam);
$queryPugilist = mysqli_query($conn, $sqlPugilist);
$querytour = mysqli_query($conn, $sqltour);
$querycate = mysqli_query($conn, $sqlcate);

$countTeam = mysqli_num_rows($queryTeam);
$countPug = mysqli_num_rows($queryPugilist);
$countTour = mysqli_num_rows($querytour);
$countCate = mysqli_num_rows($querycate);
?>

<div class="container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row mt-2 mb-2">
        <div class="col-xl-3 col-lg-3">
            <div class="card card-stats mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Pugilist</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $countPug;
                                                                    ?></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus" style="color: Lime; font-size: 60px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3">
            <div class="card card-stats mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Team</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $countTeam;
                                                                    ?></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users" style="color: #E67E22; font-size: 60px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3">
            <div class="card card-stats mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Content</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $countCate;
                                                                    ?></span>
                        </div>
                        <div class="col-auto">
                            <i class="far fa-id-badge" style="color: #1223e3; font-size: 60px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3">
            <div class="card card-stats mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Exam</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $countTour;
                                                                    ?></span>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flag-checkered" style="color: #c72404; font-size: 60px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <nav class="navbar navbar-light bg-white">
        <div class="container-fluid">
            <div id="calendar"></div>
        </div>
    </nav>

    <div class="row">
        <div class="col mb-2 mt-3">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <h5>Team of tournament</h5>
                    <div id="chart-container">
                        <canvas id="graphCanvasQuyen"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col mb-2 mt-3">
            <div class="card card-stats ">
                <div class="card-body">
                    <h5>Cate of tournament</h5>
                    <div id="chart-container">
                        <canvas id="chartComment"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col mb-2 mt-3">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <!-- <h5>Categories of tournament</h5> -->
                    <div id="chart-container">
                        <canvas id="graphCanvas"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col mb-2 mt-3">
            <div class="card card-stats ">
                <div class="card-body">
                    <!-- <h5>Team of tournament</h5> -->
                    <div id="chart-container">
                        <canvas id="graphCanvasPoint"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->
<script type="text/javascript" src="fullcalendar/moment.min.js"></script>
<link rel="stylesheet" href="fullcalendar/fullcalendar.css">
<script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        showGraph();
        showGraphQuyen();
        showGraphPoint();
        showGraphComent()
        var calendar = $('#calendar').fullCalendar({
            //editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: 'loadCalendarEvent.php',
            selectable: true,
            selectHelper: true,
            height: 600,
        });
    });

    function showGraph() {
        {
            $.post("chartDataPug.php",
                function(data) {
                    //console.log(data);
                    var name = [];
                    var dem = [];
                    for (var i in data) {
                        name.push(data[i].teamName);
                        dem.push(data[i].dem);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'Pugilist of the team',
                            backgroundColor: ["#e35919", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                            borderWidth: 1,
                            data: dem
                        }]

                    };

                    var graphTarget = $("#graphCanvas");
                    var barGraph = new Chart(graphTarget, {
                        type: 'line', //bar,pie,line,radar...
                        data: chartdata
                    });
                });
        }
    }

    function showGraphQuyen() {
        {
            $.post("chartDataCate.php",
                function(data) {
                    console.log(data);
                    var name = [];
                    var dem = [];
                    for (var i in data) {
                        name.push(data[i].tourName);
                        dem.push(data[i].dem);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'Cate of the tournament',
                            backgroundColor: ["#1abd23", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                            // borderColor: "#80b6f4",
                            // pointBorderColor: "#80b6f4",
                            // pointBackgroundColor: "#80b6f4",
                            // pointHoverBackgroundColor: "#80b6f4",
                            // pointHoverBorderColor: "#80b6f4",
                            // pointBorderWidth: 10,
                            // pointHoverRadius: 10,
                            // pointHoverBorderWidth: 1,
                            // pointRadius: 3,

                            fill: true,
                            borderWidth: 1,
                            data: dem
                        }],
                    };

                    var graphTarget = $("#graphCanvasQuyen");
                    var barGraph = new Chart(graphTarget, {
                        type: 'pie', //bar,pie,line,radar...
                        data: chartdata,
                    });


                });
        }
    }

    function showGraphPoint() {
        {
            $.post("chartDataPoint.php",
                function(data) {
                    console.log(data);
                    var name = [];
                    var dem = [];
                    for (var i in data) {
                        name.push(data[i].total);
                        dem.push(data[i].demPoint);
                    }
                    var chartdata = {
                        labels: name,
                        datasets: [{
                            label: 'Point of the Pugilist',
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                            borderWidth: 1,
                            data: dem
                        }]
                    };

                    var graphTarget = $("#graphCanvasPoint");
                    var barGraph = new Chart(graphTarget, {
                        type: 'bar', //bar,pie,line,radar...
                        data: chartdata
                    });


                });
        }
    }

    function showGraphComent() {
        $.ajax({
            url: 'chartDataComent.php',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                var name = [];
                var dem = [];
                for (var i in data) {
                    name.push(data[i].tourName);
                    dem.push(data[i].dem);
                }
                var chartdata = {
                    labels: name,
                    datasets: [{
                        label: 'categories of the tournament',
                        backgroundColor: ["#e32112", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
                        borderWidth: 1,
                        data: dem
                    }]

                };
                var graphTarget = $("#chartComment");
                var barGraph = new Chart(graphTarget, {
                    type: 'pie', //bar,pie,line,radar...
                    data: chartdata
                });


            }
        })
    }
</script>
<style type="text/css">
    #chart-container {
        width: 90%;
        height: 30%;
        margin-left: 2%;
        margin-top: 2%;
    }

    #chartComment {
        width: 90%;
        height: 30%;
        margin-left: 2%;
        margin-top: 2%;
    }
</style>
<?php include 'masterfooter.php'; ?>
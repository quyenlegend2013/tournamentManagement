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

    <div class="row mt-4">
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
                            <!--<i class="far fa-user" style="color: blue; font-size: 60px;"></i>-->
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
                            <i class="far fa-id-badge" style="color: #E67E22; font-size: 60px;"></i>
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
                            <i class="fas fa-flag-checkered" style="color: #E67E22; font-size: 60px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col mb-3 mt-3">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div id="chart-container">
                        <canvas id="graphCanvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col mb-2 mt-3">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <h5>Categories of tournament</h5>
                    <div id="chart-container">
                        <canvas id="graphCanvasQuyen"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <div class="col mb-2 mt-3">
            <div class="card card-stats ">
                <div class="card-body">
                <h5>Team of tournament</h5>
                    <div id="chart-container">
                        <canvas id="chartComment"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col mb-5 mt-2">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">

                    <div id="chart-container">
                        <canvas id="graphCanvasPoint"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>



<script type="text/javascript">
    $(document).ready(function() {
        showGraph();
        showGraphQuyen();
        showGraphPoint();
        showGraphComent()
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
                            backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
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
                            label: 'team of the tournament',
                           backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
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
                    //var ctx = document.getElementById('graphCanvasQuyen').getContext("2d");
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
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850"],
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
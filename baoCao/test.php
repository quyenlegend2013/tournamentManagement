<?php
require "connect/connect.php";

$sqlcountkt = "SELECT t.teamName,COUNT(t.teamID) AS 'dem' FROM team t INNER JOIN pugilist p ON t.teamID=p.teamID GROUP BY t.teamID";
$result = mysqli_query($conn, $sqlcountkt);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
mysqli_close($conn);

$da = json_encode($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="css/simple-sidebar.css" />
    <script src="js/6631cf4e8b.js"></script>
    <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>Document</title>
    <script>
        $(document).ready(function() {

            var da = '<?php echo $da; ?>';
            var parseDa = JSON.parse(da);
            var names = [];
            var dem = [];
            for (var i in parseDa) {
                names.push(parseDa[i].teamName);
                dem.push(parseDa[i].dem);
            }

            var options = {
                chart: {
                    type: 'line',
                    //fontFamily: 'Times New Roman, Times, serif'

                },
                series: [{
                    name: 'pugilist',
                    data: dem
                }],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {

                    categories: names,
                    text: "team"

                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                noData: {
                    text: 'Loading...'
                },
                title: {
                    text: "quyen map"
                }

            }

            var chart = new ApexCharts(document.querySelector("#chart"), options);

            chart.render();

        })
    </script>
    <style>
        #chart {
            max-width: 50%;
            margin: 0px auto;
        }
    </style>

</head>

<body>
    <div id="chart">
    </div>

    <?php
    $input = "<p>quyền d&agrave;nh cho Nam &lt; <strong>45KG</strong></p>";
    //$a = strip_tags($input);
    $b = strip_tags($input, "<p><em>");
  
    echo $b;
    //echo $c;
    ?>

</body>

</html>
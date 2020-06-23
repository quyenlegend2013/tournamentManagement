<?php
require "connect/connect.php";
$data = array();
$query = "SELECT * FROM tournament ORDER BY tourID";
$retval = mysqli_query($conn, $query);

foreach ($retval as $row) {
    $data[] = array(
        'id'   => $row["tourID"],
        'title'   => $row["tourName"],
        'start'   => $row["openingTime"],
        'end'   => $row["endTime"]
    );
}

echo json_encode($data);

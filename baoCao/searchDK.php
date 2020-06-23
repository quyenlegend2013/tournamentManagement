<?php
require("connect/connect.php");
$data    = $_POST["data"];
$sqlp = "SELECT * FROM dk WHERE dkName LIKE '%$data%'";
$querysql = mysqli_query($conn, $sqlp);
$stt = 1;
while ($row = mysqli_fetch_assoc($querysql)) {
    echo "<tr>";
    echo "<td><input type ='checkbox' id='checkk' value='" . $row["dkID"] . "'/></td>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["dkName"] . "</td>";
    echo "<td>" . $row["belongtoExam"] . "</td>";
    echo "<td>" . $row["dkDescription"] . "</td>";
    echo "<td><a href='detailDK.php?dkID=" . $row["dkID"] . " '><button type='button' class='btn btn-success'><i class='far fa-list-alt'></i></button></a></td>";
    echo '<td><button type="button" class="btn btn-warning" onclick=passdkID(' . $row["dkID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-edit"></i></button></td>';
    echo '<td><button type="button" class="btn btn-danger" onclick="deletedk(' . $row["dkID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
    echo "</tr>";
    $stt++;
}

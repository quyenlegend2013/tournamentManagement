<?php
require("connect/connect.php");
$sql        =    "SELECT * FROM dk";
$rs            =    mysqli_query($conn, $sql);
$rowtotal    =    mysqli_num_rows($rs);
$pagesize    =    10;
$currentpage    = $_POST["i"];
$currentpage1    = ($currentpage - 1) * $pagesize;

$sqlp = "SELECT * FROM dk";
$querysql = mysqli_query($conn, $sqlp);
$stt = 1 + $currentpage1;
while ($row = mysqli_fetch_assoc($querysql)) {

    $sqlCountPug = "SELECT COUNT(p.pugID) as 'count' FROM dkpug d INNER JOIN pugilist p ON p.pugID=d.pugID WHERE d.dkID=" . $row["dkID"];
    $queryCountPug = mysqli_query($conn, $sqlCountPug);
    $revalCountPug = mysqli_fetch_array($queryCountPug);
    echo "<tr>";
    echo "<td><input type ='checkbox' id='checkk' value='" . $row["dkID"] . "'/></td>";
    echo "<td>" . $stt . "</td>";
    echo "<td>" . $row["dkName"] . "</td>";
    if ($row["belongtoExam"] == 0 || $row["belongtoExam"] == 1) {
        echo "<td>No</td>";
    } else {
        $sqltourName  = "SELECT tourName FROM tournament WHERE tourID = " . $row["belongtoExam"];
        $querytourName = mysqli_query($conn, $sqltourName);
        $revalTourName = mysqli_fetch_array($querytourName);
        echo "<td>" . $revalTourName["tourName"] . "</td>";
    }
    echo "<td>" . $row["dkDescription"] . "</td>";
    echo '<td><button type="button" class="btn btn-success" onclick="pass(' . $row["dkID"] . ',\'' . $row["dkName"] . '\');" data-toggle="modal" data-target="#exampleModalCenter1" >' . $revalCountPug["count"] . '</button></td>';
    echo '<td><button type="button" class="btn btn-warning" onclick=passdkID(' . $row["dkID"] . '); data-toggle="modal" data-target=".bd-example-modal-lg" ><i class="fas fa-edit"></i></button></td>';
    echo '<td><button type="button" class="btn btn-danger" onclick="deletedk(' . $row["dkID"] . ');"><i class="fas fa-trash-alt"></i></button></td>';
    echo "<td><a href='detailDK.php?dkID=" . $row["dkID"] . "&tourID=" . $row["belongtoExam"] . " '><button type='button' class='btn btn-dark'><i class='fas fa-cogs'></i></button></a></td>";
    echo "</tr>";
    $stt++;
}

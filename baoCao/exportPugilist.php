<?php

require "php/phpexcel.php";
require "connect/connect.php";
require "php/PHPExcel/IOFactory.php";

$objExcel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$objExcel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$sheet = $objExcel->getActiveSheet()->setTitle('Pugilist');

$objExcel->getDefaultStyle()->getFont()
    ->setName('Time New Romam');
$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);

$rowCount = 1;
$sheet->setCellValue('A' . $rowCount, 'ID pugilist');
$sheet->setCellValue('B' . $rowCount, 'Pug name');
$sheet->setCellValue('C' . $rowCount, 'DOB');
$sheet->setCellValue('D' . $rowCount, 'Gender');
$sheet->setCellValue('E'.$rowCount, 'level');
$sheet->setCellValue('F'.$rowCount, 'Team Name');
// $sheet->setCellValue('G'.$rowCount, 'Feedback');
// $sheet->setCellValue('H'.$rowCount, 'Status');

// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2

$sql = "SELECT * FROM pugilist";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $rowCount++;
    $sheet->setCellValue('A' . $rowCount, $row['pugID']);
    $sheet->setCellValue('B' . $rowCount, $row['pugName']);
    $sheet->setCellValue('C' . $rowCount, $row['dob']);
    $sheet->setCellValue('D' . $rowCount, $row['gender']);
    $sheet->setCellValue('E'.$rowCount,$row['level']);
    $getteamName =mysqli_query($conn,"SELECT teamName FROM team WHERE teamID = ".$row['teamID']);
    $revalteamName = mysqli_fetch_array($getteamName); 
    $sheet->setCellValue('F'.$rowCount,$revalteamName['teamName']);
    // $sheet->setCellValue('G'.$rowCount,$row['feedback']);
    // $sheet->setCellValue('H'.$rowCount,$row['status']);
}
$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$filenames = "reportPugilist.xls";
$objWriter->save($filenames);


// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007
header('Content-Disposition: attachment; filename="' . $filenames . '"');
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Lenght' . filesize($filenames));

header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: no-cache');
readfile($filenames);
return;

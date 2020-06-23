<?php
require "php/phpexcel.php";
require "connect/connect.php";
require "php/PHPExcel/IOFactory.php";

$objExcel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$objExcel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$sheet = $objExcel->getActiveSheet()->setTitle('Tournament');

$objExcel->getDefaultStyle()->getFont()
    ->setName('Time New Romam');
$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("E1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("F1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("G1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("H1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("I1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("J1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("K1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("L1")->getFont()->setBold(true);

$rowCount = 1;
$sheet->setCellValue('A' . $rowCount, 'ID Tour');
$sheet->setCellValue('B' . $rowCount, 'Tour name');
$sheet->setCellValue('C' . $rowCount, 'Organizers');
$sheet->setCellValue('D' . $rowCount, 'Accusative');
$sheet->setCellValue('E' . $rowCount, 'Role');
$sheet->setCellValue('F' . $rowCount, 'Object');
$sheet->setCellValue('G' . $rowCount, 'Place');
$sheet->setCellValue('H' . $rowCount, 'Email');
$sheet->setCellValue('I' . $rowCount, 'Phone');
$sheet->setCellValue('J' . $rowCount, 'Opening Time');
$sheet->setCellValue('K' . $rowCount, 'End Time');
$sheet->setCellValue('L' . $rowCount, 'Competition time');


// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2

$sql = "SELECT * FROM tournament";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $rowCount++;
    $sheet->setCellValue('A' . $rowCount, $row['tourID']);
    $sheet->setCellValue('B' . $rowCount, $row['tourName']);
    $sheet->setCellValue('C' . $rowCount, $row['organizers']);
    $sheet->setCellValue('D' . $rowCount, $row['accusative']);
    $sheet->setCellValue('E' . $rowCount, $row['role']);
    $object1 = strip_tags((html_entity_decode($row['object'])), "<strong>");
    $object = strip_tags($object1, '<p>');
    $sheet->setCellValue('F' . $rowCount, $object);
    $sheet->setCellValue('G' . $rowCount, $row['place']);
    $sheet->setCellValue('H' . $rowCount, $row['email']);
    $sheet->setCellValue('I' . $rowCount, $row['phone']);
    $sheet->setCellValue('J' . $rowCount, $row['openingTime']);
    $sheet->setCellValue('K' . $rowCount, $row['endTime']);
    $sheet->setCellValue('L' . $rowCount, $row['competitionTime']);

}
$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$filenames = "reportTournament.xls";
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

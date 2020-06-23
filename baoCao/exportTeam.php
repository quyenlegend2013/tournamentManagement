<?php
require "php/phpexcel.php";
require "connect/connect.php";
require "php/PHPExcel/IOFactory.php";

$objExcel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$objExcel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$sheet = $objExcel->getActiveSheet()->setTitle('Team');

$objExcel->getDefaultStyle()->getFont()
    ->setName('Time New Romam');
$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);

$rowCount = 1;
$sheet->setCellValue('A' . $rowCount, 'ID team');
$sheet->setCellValue('B' . $rowCount, 'Team name');
$sheet->setCellValue('C' . $rowCount, 'Leader');
$sheet->setCellValue('D' . $rowCount, 'Team description');

// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2

$sql = "SELECT * FROM team";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $rowCount++;
    $sheet->setCellValue('A' . $rowCount, $row['teamID']);
    $sheet->setCellValue('B' . $rowCount, $row['teamName']);
    $sheet->setCellValue('C' . $rowCount, $row['leader']);
    $teamDescription1 = strip_tags((html_entity_decode($row['teamDescription'])), "<strong>");
    $cateDescription = strip_tags($teamDescription1, '<p>');
    $sheet->setCellValue('D' . $rowCount, $cateDescription);

}
$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$filenames = "reportTeam.xls";
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

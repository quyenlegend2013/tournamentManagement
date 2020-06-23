<?php
require "php/phpexcel.php";
require "connect/connect.php";
require "php/PHPExcel/IOFactory.php";

$objExcel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
$objExcel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$sheet = $objExcel->getActiveSheet()->setTitle('DK');

$objExcel->getDefaultStyle()->getFont()
    ->setName('Time New Romam');
$objExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("B1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("C1")->getFont()->setBold(true);
$objExcel->getActiveSheet()->getStyle("D1")->getFont()->setBold(true);

$rowCount = 1;
$sheet->setCellValue('A' . $rowCount, 'ID DK');
$sheet->setCellValue('B' . $rowCount, 'DK name');
$sheet->setCellValue('C' . $rowCount, 'Belong to Exam');
$sheet->setCellValue('D' . $rowCount, 'DK description');

// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2
$sql = "SELECT * FROM dk";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {

    $rowCount++;
    $sheet->setCellValue('A' . $rowCount, $row['dkID']);
    $sheet->setCellValue('B' . $rowCount, $row['dkName']);

    

    $sheet->setCellValue('C' . $rowCount, $row['belongtoExam']);
    $dkDescription1 = strip_tags((html_entity_decode($row['dkDescription'])), "<strong>");
    $dkDescription = strip_tags($dkDescription1, '<p>');
    $sheet->setCellValue('D' . $rowCount, $dkDescription);
}
$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
$filenames = "reportDK.xls";
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

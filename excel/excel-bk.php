<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$data = array(
	array('#1','atul','mail1@mail.com','23/23/2323','1','3','1','3','6','7'),
	array('#2','raj','mail2@mail.com','23/23/2323','3','4','3','4','2','2'),
	array('#3','pankaj','mail3@mail.com','23/23/2323','2','2','5','5','1','1')
);
//print_r($data);


$hubtotal = '';
echo "<pre>";
//print_r($data);
foreach ($data as $key => $value) {
	$hub_total += $value['4'];
	$outlet_total += $value['5'];
	$sensor_total += $value['6'];
	$contol_total += $value['7'];
	$therm_total += $value['8'];
	$camera_total += $value['9'];
}
$data[] = array ('Total','','','',$hub_total,$outlet_total,$sensor_total,$contol_total,$therm_total,$camera_total);  

echo "<br/>".$hubtotal;

$count = count($data);
$lastrow = $count + 2;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Zoho Ticket');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Date');
$sheet->setCellValue('E1', 'HUB');
$sheet->setCellValue('F1', 'Outlets');
$sheet->setCellValue('G1', 'Door Sensor');
$sheet->setCellValue('H1', 'Door controller');
$sheet->setCellValue('I1', 'Thermostat');
$sheet->setCellValue('J1', 'Camera');
$sheet->fromArray($data, NULL, 'A2');     
//$sheet->setCellValue('A'.$lastrow, 'Total');
//$sheet->getCell('E'.$lastrow)->getCalculatedValue();

  /*  // redirect output to client browser
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="myfile.xlsx"');
    header('Cache-Control: max-age=0');*/

$writer = new Xlsx($spreadsheet);
$writer->save('Ordersheet.xlsx');



?>
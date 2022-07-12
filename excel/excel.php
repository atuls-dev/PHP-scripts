<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;

$data = array(
	array('#1','atul','mail1@mail.com','23/23/2323','1','3','','3','6','7'),
	array('#2','raj','mail2@mail.com','23/23/2323','3','','','4','2','2'),
	array('#3','pankaj','mail3@mail.com','23/23/2323','2','2','8','5','1','1')
);

//Total calculation for items Quantity
foreach ($data as $key => $value) {
	$hub_total += $value['4'];
	$outl_total += $value['5'];
	$sens_total += $value['6'];
	$cont_total += $value['7'];
	$ther_total += $value['8'];
	$cam_total += $value['9'];
}
$data[] = array ('Total','','','',$hub_total,$outl_total,$sens_total,$cont_total,$ther_total,$cam_total);  

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
/*$sheet->getColumnDimension('a')->setAutoSize(true);
$sheet->getColumnDimension('b')->setAutoSize(true);
$sheet->getColumnDimension('c')->setAutoSize(true);
$sheet->getColumnDimension('d')->setAutoSize(true);
$sheet->getColumnDimension('e')->setAutoSize(true);
$sheet->getColumnDimension('f')->setAutoSize(true);
$sheet->getColumnDimension('g')->setAutoSize(true);
$sheet->getColumnDimension('h')->setAutoSize(true);
$sheet->getColumnDimension('i')->setAutoSize(true);
$sheet->getColumnDimension('j')->setAutoSize(true);
*/

foreach(range('A','J') as $columnID) {
    $sheet->getColumnDimension($columnID)
        ->setAutoSize(true);
}


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

$streamedResponse = new StreamedResponse();
$streamedResponse->setCallback(function () use ($spreadsheet) {
      // $spreadsheet = //create you spreadsheet here;
      $writer =  new Xlsx($spreadsheet);
      $writer->save('php://output');
});

$streamedResponse->setStatusCode(200);
$streamedResponse->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
$streamedResponse->headers->set('Content-Disposition', 'attachment; filename="Ordersheet2019.xls"');
return $streamedResponse->send();



?>
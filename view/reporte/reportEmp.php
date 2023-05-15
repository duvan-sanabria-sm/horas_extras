<?php

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

require '../../vendor/autoload.php';
require_once('../../controller/Report.controller.php');

$id = '0';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$dataReport = executeReport($id, '', 'reporte_in');
$cols = $dataReport['cols'];
$values = $dataReport['values'];

// Crear una instancia del objeto Spreadsheet
$spreadsheet = new Spreadsheet();

// Obtener la hoja de cálculo activa
$sheet = $spreadsheet->getActiveSheet();

// Establecer el valor de algunas celdas

for ($i = 0; $i < count($cols); $i++) {
    $sheet->setCellValueByColumnAndRow($i + 1, 1, $cols[$i]);
    $sheet->getColumnDimensionByColumn($i + 1)->setWidth(15);
}

if (!empty($values)) {
    for ($i = 0; $i < count($values); $i++) {
        $val = $values[$i];
        for ($j = 0; $j < count($val); $j++) {
            $sheet->setCellValueByColumnAndRow($j + 1, $i + 2, $val[$j]);
        }
    }
}

// Establecer las cabeceras para indicar que el archivo es un archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="myfile.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;

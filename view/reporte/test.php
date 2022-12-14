<?php

require_once('../../controller/Report.controller.php');
$arrayReport = executeReport('2022-06-01', '2022-06-30', 'detalleReporte');

foreach ($arrayReport as $items){
    var_dump($items["id_horaExtra"]);
}


/**
$data = $_POST['data'];
$recargos = json_decode($data['valuesRecargo']);

$ids = array();

foreach ($recargos as $items) {
    foreach ($items as $item){
        $ids[] = $item->codigo;
    }
}
echo json_encode($ids);
**/


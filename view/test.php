<?php

//$data = $_POST['data'];
$datas = $_POST["data"];
echo $datas;
foreach ($datas as $data){
    $obj = json_decode($data);
    echo $obj->to;
}

/*$ids = array();

foreach ($recargos as $items) {
    foreach ($items as $item){
        $ids[] = $item->codigo;
    }
}
echo json_encode($ids);


$data = $_POST['object'];
$value = $data['id'];
$value2 = $data['titulo'];
echo $value2;*/
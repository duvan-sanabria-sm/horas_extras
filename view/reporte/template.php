<?php
header("Pragma: public");
header("Expires: 0");
$fechaActual = date('d-m-Y');
$filename = "RHE_" . $fechaActual . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

require_once('../../controller/Report.controller.php');

$fechaInicio = '';
$fechaFin = '';
$documentoSoporte = 'Plano Horas Extras';
$html = "<table>
        <tbody>";

if (isset($_POST['fechaInicio'])){
    $fechaInicio = $_POST['fechaInicio'];
}

if (isset($_POST['fechaFin'])){
    $fechaFin = $_POST['fechaFin'];
}

try {
    $arrayHE = executeReport($fechaInicio, $fechaFin, 'detalleHoras_2');
    $arrayRecargos = executeReport($fechaInicio, $fechaFin, 'detalleReporte_2');

    foreach ($arrayHE as $items) {
        $html .= "
                <tr>
                <td>".$items["tipo_horaExtra"]."</td>
                <td>".$items["cc"]."</td>
                <td>".date('d-m-Y', strtotime($fechaInicio))."</td>
                <td>".date('d-m-Y', strtotime($fechaFin))."</td>
                <td>".date('d-m-Y', strtotime($fechaFin))."</td>
                <td>".$documentoSoporte."</td>
                <td>0</td>
                <td>4</td>
                <td></td>
                <td></td>";
        $numero = $items["cantidad"];
        $decimal_part = substr(strval($numero), -2);
        $horas = substr(strval($numero), 0, -2);

        if ($decimal_part == '.5'){
            $html .= "
                <td>".$horas."</td>
                <td>30</td>";
        }else{
            $html .= "
                <td>".$horas."</td>
                <td>0</td>";
        }
        $html .= "
                <td>OCASIONAL</td>
                ";

        $html .= "</tr>";
    }

    foreach ($arrayRecargos as $itemsRec){
        $html .= "
                <tr>
                <td>".$itemsRec["tipo_recargo"]."</td>
                <td>".$itemsRec["cc"]."</td>
                <td>".date('d-m-Y', strtotime($fechaInicio))."</td>
                <td>".date('d-m-Y', strtotime($fechaFin))."</td>
                <td>".date('d-m-Y', strtotime($fechaFin))."</td>
                <td>".$documentoSoporte."</td>
                <td>0</td>
                <td>4</td>
                <td></td>
                <td></td>";
        $numero = $itemsRec["cantidad"];
        $decimal_part = substr(strval($numero), -2);
        $horas = substr(strval($numero), 0, -2);

        if ($decimal_part == '.5'){
            $html .= "
                <td>".$horas."</td>
                <td>30</td>";
        }else{
            $html .= "
                <td>".$horas."</td>
                <td>0</td>";
        }
        $html .= "
                <td>OCASIONAL</td>
                ";

        $html .= "</tr>";
    }

}catch (Exception $e){
    $html .= $e;
}

$html .= "</tbody>
            </table>";

?>

<?php echo $html?>
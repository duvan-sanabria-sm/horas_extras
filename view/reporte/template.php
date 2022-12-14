<?php
header("Pragma: public");
header("Expires: 0");
$fechaActual = date('d-m-Y');
$filename = "ReporteHorasExtra_" . $fechaActual . ".xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

require_once('../../controller/Report.controller.php');

$html = "<table>
         <thead>
            <tr>
                <th>documento</th>
                <th>fecha</th>
                <th>novedad</th>
                <th>descuento</th>
                <th>4128545887</th>
                <th>656518788</th>
                <th>7894512</th>
                <th>878513845</th>
                <th>1545778995</th>
                <th>1987456654</th>
            </tr> 
        </thead>
        <tbody>";
$fechaInicio = '';
$fechaFin = '';

if (isset($_POST['fechaInicio'])){
    $fechaInicio = $_POST['fechaInicio'];
}

if (isset($_POST['fechaFin'])){
    $fechaFin = $_POST['fechaFin'];
}

try {
    $arrayHE = executeReport($fechaInicio, $fechaFin, 'detalleHoras');
    $arrayRecargos = executeReport($fechaInicio, $fechaFin, 'detalleReporte');

    foreach ($arrayHE as $items) {
        $html .= "
                <tr>
                <td>".$items["cc"]."</td>
                <td>".$items["fecha"]."</td>
                <td>".$items["novedad"]."</td>
                <td>".$items["descuento"]."</td>
                <td>".$items["4128545887"]."</td>
                <td>".$items["656518788"]."</td>
                <td>".$items["7894512"]."</td>
                <td>".$items["878513845"]."</td>
                ";
        foreach ($arrayRecargos as $itemsRec){
            if ($items["id_horaExtra"] == $itemsRec["id_horaExtra"]){
                $html .= "
                        <td>".$itemsRec["1545778995"]."</td>
                        <td>".$itemsRec["1987456654"]."</td>
                    ";
            }
        }

        $html .= "</tr>";
    }

}catch (Exception $e){
    $html .= $e;
}

$html .= "</tbody>
            </table>";

?>

<?php echo $html?>
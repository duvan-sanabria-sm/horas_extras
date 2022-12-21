<?php

require_once('../config/SendEmail.config.php');

$email = new Email();


switch ($_GET['email']) {
    case 'solicitudEmpleado':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $reporteHE = $_POST['idReporte'];

        $Subject = 'Solicitud revision de Horas Extra para ' . $empleado;
        $body = 'Buen dia, Tiene una solicitud de Horas Extra con el número ' . $reporteHE . ' pendiente por revisar. ' . '. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('soporte@servimeters.net', $to , $from, $Subject, $body);
        echo $result;
        exit();
        break;
    case 'actualizacionHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $reporteHE = $_POST['idReporte'];

        $Subject = 'Actualizacion Horas Extra por ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $reporteHE . ' han sido actualizadas y estan pendiente por revisar. ' . '. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('soporte@servimeters.net', $to, $from, $Subject, $body);
        echo $result;
        exit();
        break;
    case 'reporteNovedad':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $reporteHE = $_POST['idHE'];
        $novedad = $_POST['novedad'];

        $Subject = 'Novedad de Horas Extra por ' . $empleado;
        $body = 'Buen dia, Tiene una novedad sobre las Horas Extra con el número ' . $reporteHE . '. Novedad: ' . $novedad . ' Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('soporte@servimeters.net', $to, $from,  $Subject, $body);
        echo $result;
        exit();

        break;
    case 'rechazoHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        if (isset($_POST['cc'])){
            $cc = $_POST['cc'];
        }else{
            $cc = $from;
        }

        $empleado = $_POST['empleado'];
        $reporteHE = $_POST['idReporte'];
        $motivo = $_POST['motivo'];

        $Subject = 'Rechazo de Horas Extra por ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $reporteHE . ' han sido rechazados. '. $motivo .'. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('soporte@servimeters.net', $to, $cc, $Subject, $body);
        echo $result;
        exit();

        break;
    case 'aprobacionHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $reporteHE = $_POST['idReporte'];

        $Subject = 'Aprobación de Horas Extra para ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $reporteHE . ' han sido aprobadas. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('soporte@servimeters.net', $to, $from, $Subject, $body);
        echo $result;
        exit();
        break;
    default:
        echo '';
        break;
}

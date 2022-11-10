<?php

require_once('../config/SendEmail.config.php');

$email = new Email();


switch ($_GET['email']) {
    case 'solicitudEmpleado':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $solicitudViaticos = $_POST['idHE'];

        $Subject = 'Solicitud revision de Horas Extra para ' . $empleado;
        $body = 'Buen dia, Tiene una solicitud de Horas Extra con el número ' . $solicitudViaticos . ' pendiente por revisar. ' . '. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('william.enciso@servimeters.com', 'bautistawilliam961@gmail.com', $Subject, $body);
        echo $result;
        exit();
        break;
    case 'actualizacionHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $solicitudViaticos = $_POST['idHE'];

        $Subject = 'Actualizacion Horas Extra por ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $solicitudViaticos . ' han sido actualizadas y estan pendiente por revisar. ' . '. Este mensaje ha sido generado automáticamente.';

        $result = $email->sendEmail('william.enciso@servimeters.com', 'bautistawilliam961@gmail.com', $Subject, $body);
        echo $result;
        exit();
        break;
    case 'reporteNovedad':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $solicitudViaticos = $_POST['idHE'];
        $novedad = $_POST['novedad'];

        $Subject = 'Novedad de Horas Extra por ' . $empleado;
        $body = 'Buen dia, Tiene una novedad sobre las Horas Extra con el número ' . $solicitudViaticos . '. Novedad: ' . $novedad . ' Este mensaje ha sido generado automáticamente. Pruebas Sm.';

        $result = $email->sendEmail('william.enciso@servimeters.com', 'bautistawilliam961@gmail.com', $Subject, $body);
        echo $result;
        exit();

        break;
    case 'rechazoHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $solicitudViaticos = $_POST['idHE'];

        $Subject = 'Rechazo de Horas Extra por ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $solicitudViaticos . ' han sido rechazados. Este mensaje ha sido generado automáticamente. Pruebas Sm.';

        $result = $email->sendEmail('william.enciso@servimeters.com', 'bautistawilliam961@gmail.com', $Subject, $body);
        echo $result;
        exit();

        break;
    case 'aprobacionHE':
        $to = $_POST['to'];
        $from = $_POST['from'];

        $empleado = $_POST['empleado'];
        $solicitudViaticos = $_POST['idHE'];

        $Subject = 'Aprobación de Horas Extra para ' . $empleado;
        $body = 'Buen dia, Las Horas Extra con el número ' . $solicitudViaticos . ' han sido aprobadas. Este mensaje ha sido generado automáticamente. Pruebas Sm.';

        $result = $email->sendEmail('william.enciso@servimeters.com', $to, $Subject, $body);
        echo $result;
        exit();
        break;
    default:
        echo '';
        break;
}

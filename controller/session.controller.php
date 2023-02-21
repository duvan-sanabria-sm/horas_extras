<?php

require_once('../config/Session.config.php');

$session = new Sesion();

function validateRole(){
    require_once('../model/Aprobador.model.php');
    session_start();
    $validate = new Aprobador();
    $user = $validate->getPermisos($_SESSION["usuario"]);

    if (!empty($user)) {
        echo $user;
        exit();
    }
}

switch ($_GET['action']) {
    case 'init':
        $isSession = $session->init_session($_POST['user'], $_POST['pass']);
        if ($isSession) {
            echo $isSession;
            exit();
        }
        echo false;
        break;
    case 'finish':
        session_start();
        session_destroy();
        header('Location:http://localhost/HorasExtra/');
        break;
    case 'validateRole':
        validateRole();
        break;
    default:
        echo ''; 
        break;
}

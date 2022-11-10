<?php

class Sesion{

    private $inSession;
    private $ldapResult;

    function __construct(){
        require_once "LDAP.config.php";
    }

    public function init_session($user, $pass){
        $ad = new LDAP();
        $this->ldapResult = $ad->connectAD($user, $pass);

        if ($this->ldapResult == '0' || $this->ldapResult == '' ) {
            $this->inSession = false;
            echo $this->inSession;
            return;
        }

        session_start();
        $this->inSession = true;
        $_SESSION["usuario"] = $this->ldapResult[0]['cn'][0];
        $_SESSION["BuscarArea"] = $this->ldapResult[0]['distinguishedname'][0];
        $_SESSION["email"] = $this->ldapResult[0]['mail'][0];
        $_SESSION["usuarioRegistro"] = $this->ldapResult[0]['samaccountname'][0];
        $_SESSION["infoUsuario"] = $this->ldapResult;
        $_SESSION["estadoAutentica"] = "conectado";
        echo $this->inSession;
        return;
    }
}
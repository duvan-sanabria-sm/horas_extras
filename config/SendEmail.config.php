<?php

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    
    private const HOST = 'smtp.Office365.com';
    private const USERNAME = 'william.enciso@servimeters.com';
    private const PASSWORD = 'We123456*';
    private $correo;

    function __construct(){
        include_once('../config/PhpMailer/Exception.php');
        include_once('../config/PhpMailer/PHPMailer.php');
        include_once('../config/PhpMailer/SMTP.php');
        $this->correo = new PHPMailer();
    }


    public function sendEmail($from, $to, $subject, $body){

        try{
            $this->correo->SMTPDebug=0;
            $this->correo->isSMTP();
            $this->correo->Host= self::HOST;
            $this->correo->SMTPAuth=true;
            $this->correo->Username=self::USERNAME;
            $this->correo->Password= self::PASSWORD;
            $this->correo->SMTPSecure="tls";
            $this->correo->Port=587;
        
            $this->correo->setFrom($from,"Solicitud de Horas Extra");
            $this->correo->addAddress($to);
            $this->correo->addAddress($from);
            $this->correo->isHTML(true);
            $this->correo->Subject=$subject;
            $this->correo->Body=$body;
            $this->correo->CharSet="UTF-8";
            $this->correo->send();
            return true;
        }
        catch (Exception $e){
            return $this->correo->ErrorInfo;
        }

    }
}
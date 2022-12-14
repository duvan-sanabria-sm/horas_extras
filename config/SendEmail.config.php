<?php

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    
    private const HOST = 'smtp.office365.com';
    private const USERNAME = 'soporte@servimeters.net';
    private const PASSWORD = 'Sm123456*';
    private const PORT = 587;
    private $correo;

    function __construct(){
        include_once('../config/PhpMailer/Exception.php');
        include_once('../config/PhpMailer/PHPMailer.php');
        include_once('../config/PhpMailer/SMTP.php');
        $this->correo = new PHPMailer(true);
    }


    public function sendEmail($from, $to, $cc, $subject, $body){

        try{
            $this->correo->SMTPDebug=0;
            $this->correo->isSMTP();
            $this->correo->Host= self::HOST;
            $this->correo->SMTPAuth=true;
            $this->correo->Username=self::USERNAME;
            $this->correo->Password= self::PASSWORD;
            $this->correo->SMTPSecure="tls";
            $this->correo->Port=self::PORT;
        
            $this->correo->setFrom($from,"Solicitud de Horas Extra");
            $this->correo->addAddress($to);
            $this->correo->addAddress($from);
            $this->correo->addCC($cc);
            $this->correo->isHTML(true);
            $this->correo->Subject=$subject;
            $this->correo->Body=$body;
            $this->correo->CharSet="UTF-8";
            $this->correo->send();

            if(!$this->correo->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $this->correo->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            return true;
        }
        catch (Exception $e){
            return $this->correo->ErrorInfo;
        }

    }
}
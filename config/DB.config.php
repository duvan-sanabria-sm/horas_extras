<?php

class DB
{

    private $conexion;
    private $config;

    function __construct()
    {
        require_once "LoadConfig.config.php";
        $this->config = LoadConfig::getConfig();
    }

    function Conectar()
    {

        try {

            $DNS = "sqlsrv:server=" . $this->config->SERVER_DB . ";database=" . $this->config->DATABASE;
            $this->conexion = new PDO($DNS, $this->config->USER_DB, $this->config->PASS_DB);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexion;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

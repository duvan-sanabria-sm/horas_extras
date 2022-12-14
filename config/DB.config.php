<?php

class DB {

    private $conexion;

    function Conectar(){

        try {
            
            $DNS  = "sqlsrv:server=localhost;database=HorasExtraSBv1";
            $this->conexion = new PDO($DNS, 'sa', 'We12345678*');

            return $this->conexion;

        } catch (\Throwable $th) {
            throw $th;
        }
        
    } 
}
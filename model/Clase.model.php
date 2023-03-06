<?php

class Clase{
    private $sql;
    private $result;
    private $connection;
    private $db;

    private $id;
    private $titulo;

    function __construct(){
        require_once "../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function get(){
        $this->sql = 'SELECT * FROM dbo.Clase';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }
}
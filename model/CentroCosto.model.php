<?php

class CentroCosto{

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

    public function insert($object){
        if (!isset($object["titulo"])) {
            return false;
        }

        try {
            if (isset($object["titulo"])) {
                $this->titulo = $object["titulo"];
                $this->sql = "INSERT INTO dbo.CentrosCosto (titulo) VALUES (:titulo)";

                $this->connection->beginTransaction();
                $this->result = $this->connection->prepare($this->sql);
                $this->result->bindParam(':titulo' , $this->titulo);
                $this->result->execute();
                $this->connection->commit();

                echo $this->connection->lastInsertId();
            }
        }catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function delete($object){
        if (!isset($object["id"])) {
            return false;
        }

        try {
            $this->id = $object["id"];
            $this->sql = "DELETE FROM dbo.CentrosCosto WHERE id = :id";
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->id);
            $this->result->execute();

            return true;
        }catch (\Throwable $th) {
            return false;
            throw $th;
        }

    }

    public function update($object){
        if (!isset($object["id"])) {
            return false;
        }

        try {

            $this->id = $object["id"];
            $this->titulo = $object["titulo"];
            $this->sql = "UPDATE dbo.CentrosCosto SET titulo = :titulo WHERE id = :id";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':id' , $this->id);
            $this->result->bindParam(':titulo' , $this->titulo);
            $this->result->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function get(){
        $this->sql = 'SELECT * FROM dbo.CentrosCosto';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($value){
        $this->titulo = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($value){
        $this->id = $value;
    }
}
<?php

class Clase
{
    private $sql;
    private $result;
    private $connection;
    private $db;

    private $id;
    private $titulo;

    function __construct()
    {
        require_once "../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function insert($object)
    {

        try {
            if (!isset($object["titulo"])) {
                return false;
            }
            if (!isset($object["titulo"])) {
                return false;
            }

            $this->titulo = $object["titulo"];
            $this->sql = "INSERT INTO dbo.Clase (titulo) VALUES (:titulo)";

            $this->connection->beginTransaction();
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':titulo', $this->titulo);
            $this->result->execute();
            $this->connection->commit();

            echo $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function get()
    {
        try {
            $this->sql = 'SELECT * FROM dbo.Clase';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->execute();

            return $this->result->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function update($object)
    {

        try {
            if (!isset($object["id"])) {
                return false;
            }
            $this->id = $object["id"];
            $this->titulo = $object["titulo"];
            $this->sql = "UPDATE dbo.Clase SET titulo = :titulo WHERE id = :id";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':id', $this->id);
            $this->result->bindParam(':titulo', $this->titulo);
            $this->result->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }
}

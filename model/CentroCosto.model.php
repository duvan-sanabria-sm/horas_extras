<?php

class CentroCosto
{

    private $sql;
    private $result;
    private $connection;
    private $db;

    private $id;
    private $titulo;
    private $clase;

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
            $this->clase = $object["clase"];
            $this->sql = "INSERT INTO dbo.CentrosCosto (titulo, id_clase) VALUES (:titulo, :clase)";

            $this->connection->beginTransaction();
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':titulo', $this->titulo);
            $this->result->bindParam(':clase', $this->clase);
            $this->result->execute();
            $this->connection->commit();

            echo $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function delete($object)
    {

        try {
            if (!isset($object["id"])) {
                return false;
            }
            $this->id = $object["id"];
            $this->sql = "DELETE FROM dbo.CentrosCosto WHERE id = :id";
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id', $this->id);
            $this->result->execute();

            return true;
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
            $this->clase = $object["clase"];

            $this->sql = "UPDATE dbo.CentrosCosto SET titulo = :titulo, id_clase = :clase WHERE id = :id";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':id', $this->id);
            $this->result->bindParam(':titulo', $this->titulo);
            $this->result->bindParam(':clase', $this->clase);
            $this->result->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function get()
    {
        try {
            $this->sql = 'SELECT * FROM dbo.CentrosCosto';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->execute();

            return $this->result->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($value)
    {
        $this->titulo = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }
}

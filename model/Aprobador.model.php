<?php

class Aprobador{

    private $sql;
    private $result;
    private $connection;
    private $db;

    private $id;
    private $nombre;
    private $correo;
    private $tipo;
    private $gestion;

    function __construct(){
        require_once "../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function insert($object){
        if (isset($object["titulo"])) {
            $this->nombre = $object["nombre"];
            $this->correo = $object["correo"];
            $this->tipo = $object["tipo"];
            $this->sql = "INSERT INTO dbo.Aprobadores (nombre, correo, tipo) VALUES (:nombre, :correo, :tipo)";
            
            $this->connection->beginTransaction();
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':nombre' , $this->nombre);
            $this->result->bindParam(':correo' , $this->correo);
            $this->result->bindParam(':tipo' , $this->tipo);
            $this->result->execute();
            $this->connection->commit();
            
            echo $this->connection->lastInsertId();
        }
        
        return false;
    }

    public function delete(){}

    public function update(){}

    public function get(){
        $this->sql = 'SELECT * FROM dbo.Aprobadores';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPermisos($logUser){
        if (isset($logUser)) {
            $this->nombre = trim($logUser);
            $this->sql = 'SELECT * FROM dbo.Aprobadores WHERE nombre = :nombre';

            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':nombre' , $this->nombre);
            $this->result->execute();

            $user = $this->result->fetchAll(PDO::FETCH_OBJ);

            if (!empty($user)) {
                $_SESSION["rol"] = $user[0]->tipo;
                $_SESSION["gestion"] = $user[0]->gestiona;
                $_SESSION["idAprobador"] = $user[0]->id;
                echo $user[0]->tipo;
            }else{
                echo false;
            }
            
            exit();
        }

        return false;
    }

    public function getAprobadorbyGestion($object){
        try {
            if (!$object["gestion"]) {
                return false;
            }

            $this->gestion = $object["gestion"];

            $this->sql = 'SELECT * FROM dbo.Aprobadores WHERE gestiona = :gestion';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':gestion', $this->gestion);
            $this->result->execute();

            return json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($value){
        $this->nombre = $value;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($value){
        $this->id = $value;
    }
}
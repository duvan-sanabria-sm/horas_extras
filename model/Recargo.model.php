<?php

class Recargo{

    private $sql;
    private $result;
    private $connection;
    private $db;

    private $idHE;
    private $tipoRecargo;
    private $cantidad;

    function __construct(){
        require_once "../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function insert($data){
        $this->id = $data['horaExtra'];
        $recargos = json_decode($data["valuesRecargo"]);

        $this->sql = "INSERT INTO dbo.Recargo (id_horaExtra, tipo_recargo, cantidad) VALUES (:id_horaExtra, :tipo_recargo, :cantidad)";
        $this->result = $this->connection->prepare($this->sql);

        $this->result->bindParam(':id_horaExtra' , $this->id);

        foreach($recargos as $recargo){
            $this->result->bindParam(':tipo_recargo' , $recargo->codigo);
            $this->result->bindParam(':cantidad' , $recargo->value);
            $this->result->execute();
        }

        return true;
    }

    public function delete(){}

    public function update($data){

        if (!isset($data["horaExtra"])) {   
            return false;
        }

        try {
            $this->id = $data['horaExtra'];
            $recargos = json_decode($data["valuesRecargo"]);

            $this->sql = "UPDATE dbo.Recargo SET cantidad = :cantidad WHERE id_horaExtra = :id_horaExtra AND tipo_recargo = :tipo_recargo";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':id_horaExtra' , $this->id);

            foreach($recargos as $recargo){
                $this->result->bindParam(':tipo_recargo' , $recargo->codigo);
                $this->result->bindParam(':cantidad' , $recargo->value);
                $this->result->execute();
            }

            return true;
            
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function get(){
        $this->sql = 'SELECT * FROM dbo.Recargo';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRecargos($object){
        if ($object["id"]) {
            $this->idHE = trim($object["id"]);

            $this->sql = 'SELECT *, T.nombre AS recargo FROM Recargo R INNER JOIN TipoRecargo T ON R.tipo_recargo = T.codigo WHERE id_horaExtra = :id';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->idHE);
            $this->result->execute();
    
            $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
            return $json;
        }

        return false;
    }

    public function gettipoRecargo(){
        return $this->tipoRecargo;
    }

    public function settipoRecargo($value){
        $this->tipoRecargo = $value;
    }

    public function getIdHE(){
        return $this->idHE;
    }

    public function setIdHE($value){
        $this->idHE = $value;
    }
}
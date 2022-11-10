<?php

class HoraExtra{

    private $sql;
    private $result;
    private $connection;
    private $db;

    private $id;
    private $cc;
    private $empleado;
    private $correoEmpleado;
    private $fechaReporte;
    private $novedad;
    private $fechaInicio;
    private $fechaFin;
    private $descuento;
    private $total;
    private $ceco;
    private $aprobador;
    private $estado;

    function __construct(){
        require_once "../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function insert($object){
        if (isset($object["cc"])) {
            $this->cc = $object["cc"];
            $this->empleado = $object["empleado"];
            $this->correoEmpleado = $object["correoEmpleado"];
            $this->fechaReporte = $object["fechareporte"];
            $this->novedad = $object["novedad"];
            $this->fechaInicio = $object["fechaInicio"];
            $this->fechaFin = $object["fechaFin"];
            $this->descuento = $object["descuento"];
            $this->total = $object["total"];
            $this->ceco = $object["ceco"];
            $this->aprobador = $object["aprobador"];
            $this->estado = $object["estado"];
            $this->sql = "INSERT INTO dbo.HoraExtra (cc, empleado, correoEmpleado, fechaReporte, novedad, fechaInicio, fechaFin, descuento, total, ceco, aprobador, estado) VALUES (:cc, :empleado, :correoEmpleado, :fechaReporte, :novedad, :fechaInicio, :fechaFin, :descuento, :total, :ceco, :aprobador, :estado)";
            
            $this->connection->beginTransaction();
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':cc' , $this->cc);
            $this->result->bindParam(':empleado' , $this->empleado);
            $this->result->bindParam(':correoEmpleado' , $this->correoEmpleado);
            $this->result->bindParam(':fechaReporte' , $this->fechaReporte);
            $this->result->bindParam(':novedad' , $this->novedad);
            $this->result->bindParam(':fechaInicio' , $this->fechaInicio);
            $this->result->bindParam(':fechaFin' , $this->fechaFin);
            $this->result->bindParam(':descuento' , $this->descuento);
            $this->result->bindParam(':total' , $this->total);
            $this->result->bindParam(':ceco' , $this->ceco);
            $this->result->bindParam(':aprobador' , $this->aprobador);
            $this->result->bindParam(':estado' , $this->estado);

            $this->result->execute();
            $this->connection->commit();
            
            echo $this->connection->lastInsertId();
        }
        
        return false;
    }

    public function insertHoras($data){

        $this->id = $data['horaExtra'];
        $horasExtra = json_decode($data["valuesHE"]);

        $this->sql = "INSERT INTO dbo.DetalleHoraExtra (id_horaExtra, tipo_horaExtra, cantidad) VALUES (:id_horaExtra, :tipo_horaExtra, :cantidad)";
        $this->result = $this->connection->prepare($this->sql);

        $this->result->bindParam(':id_horaExtra' , $this->id);

        foreach($horasExtra as $horaExtra){
            $this->result->bindParam(':tipo_horaExtra' , $horaExtra->codigo);
            $this->result->bindParam(':cantidad' , $horaExtra->value);
            $this->result->execute();
        }

        return true;
    }

    public function delete(){}

    public function update($object){
        
        if (!isset($object["id"])) {
            
            return false;
        }

        try {
            $this->id = $object["id"];
            $this->cc = $object["cc"];
            $this->empleado = $object["empleado"];
            $this->correoEmpleado = $object["correoEmpleado"];
            $this->fechaReporte = $object["fechareporte"];
            $this->novedad = $object["novedad"];
            $this->fechaInicio = $object["fechaInicio"];
            $this->fechaFin = $object["fechaFin"];
            $this->descuento = $object["descuento"];
            $this->total = $object["total"];
            $this->ceco = $object["ceco"];
            $this->aprobador = $object["aprobador"];
            $this->estado = $object["estado"];
            $this->sql = "UPDATE dbo.HoraExtra SET cc = :cc, empleado = :empleado, correoEmpleado = :correoEmpleado, fechaReporte = :fechaReporte, novedad = :novedad, fechaInicio = :fechaInicio, fechaFin = :fechaFin, descuento = :descuento, total = :total, ceco = :ceco, aprobador = :aprobador, estado = :estado WHERE id = :id";
            
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->id);
            $this->result->bindParam(':cc' , $this->cc);
            $this->result->bindParam(':empleado' , $this->empleado);
            $this->result->bindParam(':correoEmpleado' , $this->correoEmpleado);
            $this->result->bindParam(':fechaReporte' , $this->fechaReporte);
            $this->result->bindParam(':novedad' , $this->novedad);
            $this->result->bindParam(':fechaInicio' , $this->fechaInicio);
            $this->result->bindParam(':fechaFin' , $this->fechaFin);
            $this->result->bindParam(':descuento' , $this->descuento);
            $this->result->bindParam(':total' , $this->total);
            $this->result->bindParam(':ceco' , $this->ceco);
            $this->result->bindParam(':aprobador' , $this->aprobador);
            $this->result->bindParam(':estado' , $this->estado);

            $this->result->execute();
            
            return true;
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function updateHoras($data){

        if (!isset($data["horaExtra"])) {
            
            return false;
        }

        try {
            $this->id = $data['horaExtra'];
            $horasExtra = json_decode($data["valuesHE"]);
            
            $this->sql = "UPDATE dbo.DetalleHoraExtra SET cantidad = :cantidad WHERE id_horaExtra = :id_horaExtra AND tipo_horaExtra = :tipo_horaExtra";
            $this->result = $this->connection->prepare($this->sql);
            
            $this->result->bindParam(':id_horaExtra' , $this->id);
            
            foreach($horasExtra as $horaExtra){
                $this->result->bindParam(':tipo_horaExtra' , $horaExtra->codigo);
                $this->result->bindParam(':cantidad' , $horaExtra->value);
                $this->result->execute();
            }
        
            return true;

        } catch (\Throwable $th) {
            return false;
            throw $th;
        }
    }

    public function get(){
        $this->sql = 'SELECT * FROM dbo.HoraExtra';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getListado($object){
        if ($object["empleado"]) {
            $this->empleado = trim($object["empleado"]);

            $this->sql = 'SELECT H.*, A.nombre AS aprobadorNombre, A.tipo AS aprobadorTipo, A.correo AS correoAprobador, E.nombre AS estadoNombre FROM dbo.HoraExtra H INNER JOIN dbo.Aprobador A ON H.aprobador = A.id INNER JOIN dbo.estado E ON H.estado = E.id WHERE H.empleado LIKE :empleado';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':empleado' , $this->empleado);
            $this->result->execute();
    
            $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
            return $json;
        }

        return false;
    }

    public function getDetalleHora($object){
        if ($object["id"]) {
            $this->id = trim($object["id"]);

            $this->sql = 'SELECT *, T.nombre AS horaExtra FROM dbo.DetalleHoraExtra D INNER JOIN dbo.TipoHE T ON D.tipo_horaExtra = T.codigo WHERE id_horaExtra = :id';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->id);
            $this->result->execute();
    
            $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
            return $json;
        }

        return false;
    }

    public function getListHEGestionAprobador($object){
        if (!$object["aprobador"]) {
            return false;
        }

        $this->aprobador = trim($object["aprobador"]);

        $this->sql = 'SELECT H.*, A.nombre AS aprobadorNombre, A.tipo AS aprobadorTipo, A.correo AS correoJefe, E.nombre AS estadoNombre, C.titulo As cecoName FROM dbo.HoraExtra H INNER JOIN dbo.Aprobador A ON H.aprobador = A.id INNER JOIN dbo.estado E ON H.estado = E.id INNER JOIN dbo.Centro_Costos C ON H.ceco = C.id WHERE H.aprobador = :aprobador AND H.estado IN (1002, 1003)';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->bindParam(':aprobador' , $this->aprobador);
        $this->result->execute();

        $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
        return $json;
    }

    public function getListHEGestionRH($object){

        $this->sql = 'SELECT H.*, A.nombre AS aprobadorNombre, A.tipo AS aprobadorTipo, A.correo AS correoJefe, E.nombre AS estadoNombre, C.titulo As cecoName FROM dbo.HoraExtra H INNER JOIN dbo.Aprobador A ON H.aprobador = A.id INNER JOIN dbo.estado E ON H.estado = E.id INNER JOIN dbo.Centro_Costos C ON H.ceco = C.id WHERE H.estado IN (1004)';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
        return $json;
    }

    public function getListHEGestionContable($object){

        $this->sql = 'SELECT H.*, A.nombre AS aprobadorNombre, A.tipo AS aprobadorTipo, A.correo AS correoJefe, E.nombre AS estadoNombre, C.titulo As cecoName FROM dbo.HoraExtra H INNER JOIN dbo.Aprobador A ON H.aprobador = A.id INNER JOIN dbo.estado E ON H.estado = E.id INNER JOIN dbo.Centro_Costos C ON H.ceco = C.id WHERE H.estado IN (1005)';
        $this->result = $this->connection->prepare($this->sql);
        $this->result->execute();

        $json = json_encode($this->result->fetchAll(PDO::FETCH_OBJ));
        return $json;
    }

    public function updateEstado($object){

        try {
            if (!$object["he"]) {
                return false;
            }

            $this->id = $object["he"];
            $this->aprobador = trim($object["aprobador"]);
            $this->estado = $object["estado"];

            $this->sql = 'UPDATE HoraExtra SET estado = :estado, aprobador = :aprobador WHERE id = :id';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->id);
            $this->result->bindParam(':aprobador' , $this->aprobador);
            $this->result->bindParam(':estado' , $this->estado);
            $this->result->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }

    }

    public function rejectEstado($object){

        try {
            if (!$object["he"]) {
                return false;
            }

            $this->id = $object["he"];
            $this->estado = $object["estado"];

            $this->sql = 'UPDATE HoraExtra SET estado = :estado WHERE id = :id';
            $this->result = $this->connection->prepare($this->sql);
            $this->result->bindParam(':id' , $this->id);
            $this->result->bindParam(':estado' , $this->estado);
            $this->result->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
            throw $th;
        }

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
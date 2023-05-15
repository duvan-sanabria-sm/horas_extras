<?php

class TemplateReport
{
    private $sql;
    private $result;
    private $connection;
    private $db;

    private $fechaInicio;
    private $fechaFin;
    private $id;

    function __construct()
    {
        require_once "../../config/DB.config.php";
        $this->db = new DB();
        $this->connection = $this->db->Conectar();
    }

    public function detalleHoras($fechaInicio, $fechaFin)
    {

        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;

        $this->sql = "EXEC DETALLEHORAS :fechaInicio, :fechaFin";
        $this->result = $this->connection->prepare($this->sql);

        $this->result->bindParam(':fechaInicio', $this->fechaInicio, PDO::PARAM_STR);
        $this->result->bindParam(':fechaFin', $this->fechaFin, PDO::PARAM_STR);

        $this->result->execute();
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalleHoras_2($fechaInicio, $fechaFin)
    {
        try {
            $this->fechaInicio = $fechaInicio;
            $this->fechaFin = $fechaFin;

            $this->sql = "EXEC DETALLEHORAS_2 :fechaInicio, :fechaFin";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':fechaInicio', $this->fechaInicio, PDO::PARAM_STR);
            $this->result->bindParam(':fechaFin', $this->fechaFin, PDO::PARAM_STR);

            $this->result->execute();
            return $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function detalleReporte($fechaInicio, $fechaFin)
    {

        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;

        $this->sql = "EXEC DETALLERECARGOS :fechaInicio, :fechaFin";
        $this->result = $this->connection->prepare($this->sql);

        $this->result->bindParam(':fechaInicio', $this->fechaInicio, PDO::PARAM_STR);
        $this->result->bindParam(':fechaFin', $this->fechaFin, PDO::PARAM_STR);

        $this->result->execute();
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalleReporte_2($fechaInicio, $fechaFin)
    {
        try {
            $this->fechaInicio = $fechaInicio;
            $this->fechaFin = $fechaFin;

            $this->sql = "EXEC DETALLERECARGOS_2 :fechaInicio, :fechaFin";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':fechaInicio', $this->fechaInicio, PDO::PARAM_STR);
            $this->result->bindParam(':fechaFin', $this->fechaFin, PDO::PARAM_STR);

            $this->result->execute();
            return $this->result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }

    public function reporte_in($id, $none)
    {
        try {
            $this->id = $id;
            $this->sql = "EXEC REPORTE_EMP_IN :id";
            $this->result = $this->connection->prepare($this->sql);

            $this->result->bindParam(':id', $this->id, PDO::PARAM_STR);

            $this->result->execute();

            $columnas = array();
            $num_col = $this->result->columnCount();
            for ($i = 0; $i < $num_col; $i++) {
                $columna = $this->result->getColumnMeta($i);
                $columnas[] = $columna['name'];
            }

            $arrayValues = array('cols' => $columnas, 'values' => $this->result->fetchAll(PDO::FETCH_NUM));
            return $arrayValues;
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }
    }
}

<?php
require_once(__DIR__ . '/Connection.php');

class Query extends Connection
{

    //Variable
    private $pdo, $con;

    //Constructor 
    public function __construct()
    {
        $this->pdo = new Connection();
        $this->con = $this->pdo->conectDb();
    }

    //funcion para obtener un registro
    public function selectRecord($sql, $array)
    {
        $result = $this->con->prepare($sql);
        $result->execute($array);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    //funcion para obtener todos los registro
    public function selectRecords($sql)
    {
        $result = $this->con->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    //funcion para insertar un registro
    public function insertRecord($sql, $array)
    {
        echo "<script>console.log('Consulta SQL: " . $sql . "');</script>";
        echo "<script>console.log('Valores enlazados: " . implode(", ", $array) . "');</script>";
        $result = $this->con->prepare($sql);
        if (!$result) {
            $errorInfo = $this->con->errorInfo();
            echo "<script>console.error('Error en la preparación: " . $errorInfo[2] . "');</script>";
            return 0;
        }
        $data = $result->execute($array);
        if (!$data) {
            $errorInfo = $result->errorInfo();
            echo "<script>console.error('Error al ejecutar la consulta: " . $errorInfo[2] . "');</script>";
            return 0;
        }
        echo "<script>console.log('Valor de \$data: " . ($data ? "Éxito" : "Fracaso") . "');</script>";
        if ($data) {
            $answer = $this->con->lastInsertId();
        } else {
            $answer = 0;
        }
        return $answer;
    }

    //funcion para salvar un registro
    public function saveRecord($sql, $array)
    {
        $result = $this->con->prepare($sql);
        $data = $result->execute($array);
        if ($data) {
            $answer = 1;
        } else {
            $answer = 0;
        }
        return $answer;
    }
}

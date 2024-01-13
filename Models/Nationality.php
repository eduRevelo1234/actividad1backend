<?php
require_once(__DIR__ . '/../Config/App/Querys.php');

class Nationalities extends Query
{
    private $id;
    private $name;
    // Propiedad para almacenar la conexión PDO

    public function __construct( $id , $name )
    {
        parent::__construct();
        $this->id=$id;
        $this->name=$name;
    }
    // Métodos GET y SET
    public function getId()
    {
        return $this->id;
    }
        
    public function setId($id)
    {
        $this->id = $id;
    }
        
    public function getName()
    {
        return $this->name;
    }
        
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNationalities()
    {
        $sql = "SELECT * FROM nationalities";
        $data = $this->selectRecords($sql);
        $listData = [];

        foreach ($data as $item) {
            $itemObject = new Nationalities( $item['id'], $item['name']);
            array_push($listData, $itemObject);
        }

        return $listData;
    }
    public function getNationalityByTerm($searchTerm)
    {
        $sql = "SELECT * FROM nationalities WHERE name LIKE ?";
        $array = array("%$searchTerm%");
        $result = $this->selectRecords($sql, $array);
        return $result;
    }

    public function getNationality()
    {
        $sql = "SELECT id, name FROM nationalities WHERE id = ?";
        $array = array($this->id);
        $result = $this->selectRecord($sql, $array);
        return $result;
    }

    public function getNationalityByName()
    {
        $sql = "SELECT name FROM nationalities WHERE name = ?";
        $array = array($this->getName());
        $result = $this->selectRecord($sql, $array);
        return $result;
    }

    public function saveNationality()
    {
        if ($this->getId() > 0) {
            // Actualizar la nacionalidad existente
            $sql = "UPDATE nationalities SET name = ? WHERE id = ?";
            $array = array($this->getName(), $this->getId());
            $result = $this->updateRecord($sql, $array);
        } else {
            // Crear nueva nacionalidad
            $sql = "INSERT INTO nationalities (name) VALUES (?)";
            $array = array($this->getName());
            $result = $this->insertRecord($sql, $array);
        }
        return $result;
    }
    

    public function updateNationality()
    {
       $sql = "UPDATE nationalities SET name = ? WHERE id = ?";
       $array = array( $this->name, $this->id);
        $result = $this->saveRecord($sql, $array);
      
        return $result;
    }

    public function deleteNationality()
    {
        $sql = "DELETE FROM nationalities WHERE id = ?";
        $array = array($this->id);
        try {
            $result = $this->saveRecord($sql, $array);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage(); // Imprimir mensaje de error
            return false; // Retorna false para indicar que hubo un error
        }
    }
    
    public function updateRecord($sql, $array) {
        try	{
        // Implementación para actualizar un registro en la base de datos
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute($array);
        $data =  $result->fetch(PDO::FETCH_ASSOC);
        return  $data;

            } catch (Exception $e) {
        error_log("Error in listSeries function: " . $e->getMessage());
        return [];
        }
    }

    public function deleteRecord($query, $params = array()) {
        $stmt = $this->pdo->prepare($query);
        $success = $stmt->execute($params);
        return $success; // Devuelve true si se eliminó correctamente, false si falló
    }
}




?>

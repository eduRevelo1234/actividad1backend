<?php
require_once(__DIR__ . '/../Config/App/Querys.php');

class Person extends Query
{
    private $id;
    private $name;
    private $last_name;
    private $code;
    private $date_birth;
    private $id_nationalities;

    // Constructor para operaciones solo de lista, no tiene conexion a base
  /*  public function __construct($id=null, $name, $last_name, $code, $date_birth, $id_nationalities)
    {  	
	    $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->code= $code;
        $this->date_birth = $date_birth;
        $this->id_nationalities = $id_nationalities;
    }*/
	
	//COnstructor para operaciones con base de datos
    public function __construct($pdo, $id=null, $name=null, $last_name=null, $code=null, $date_birth=null, $id_nationalities=null)
    {
		//////////////////////////IOO
        parent::__construct();
        $this->pdo = $pdo;       
        
		
	   $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->code= $code;
        $this->date_birth = $date_birth;
        $this->id_nationalities = $id_nationalities;
    }

    // Métodos GET y SET para las propiedades

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

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setcode($code)
    {
        $this->code = $code;
    }

    public function getDateOfBirth()
    {
        return $this->date_birth;
    }

    public function setDateOfBirth($date_birth)
    {
        $this->date_birth = $date_birth;
    }

    public function getIdNationalities()
    {
        return $this->id_nationalities;
    }

    public function setIdNationalities($id_nationalities)
    {
        $this->id_nationalities = $id_nationalities;
    }
    public function getPeople()
    {
        $sql = "SELECT * FROM peoples ORDER BY last_name";
        $data = $this->selectRecords($sql);
        $listData = [];
    
        foreach ($data as $item) {
            $itemObject = new Person(null, 
                $item['id'],
                $item['name'],
                $item['last_name'],
                $item['code'],
                $item['date_birth'],
                $item['id_nationalities']
            );
            array_push($listData, $itemObject);
        }
    
        return $listData;
    }

    public function getPersonById($id)
    {
        $query = "SELECT * FROM peoples WHERE id = :id";
        $params = array(':id' => $id);

        try {
            $personData = $this->selectRecord($query, $params);

            if ($personData) {
                return new Person(
                    $personData['id'],
                    $personData['name'],
                    $personData['last_name'],
                    $personData['code'],
                    $personData['date_birth'],
                    $personData['id_nationalities']
                );
            } else {
                return null;
            }
        } catch (PDOException $e) {
            throw new Exception("Error retrieving person by ID: " . $e->getMessage());
        }
    }

    public function savePerson()
    {
        $query = "INSERT INTO peoples (name, last_name, code, date_birth, id_nationalities) 
                  VALUES (:name, :last_name, :code, :date_birth, :id_nationalities)";
        $params = array(
            ':name' => $this->name,
            ':last_name' => $this->last_name,
            ':code' => $this->code,
            ':date_birth' => $this->date_birth,
            ':id_nationalities' => $this->id_nationalities
        );

        try {
            $result = $this->saveRecord($query, $params);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error saving person: " . $e->getMessage());
        }
    }

    public function savePersonFull($name = null, $last_name = null, $code = null, $date_birth = null, $id_nationalities = null)
    {
        // Verificar si la persona ya existe antes de intentar guardar
        if (!$this->isPersonExists($name, $last_name, $code, $date_birth, $id_nationalities)) {
            // La persona no existe, entonces procedemos a guardarla
            $query = "INSERT INTO peoples (name, last_name, code, date_birth, id_nationalities) 
                      VALUES (:name, :last_name, :code, :date_birth, :id_nationalities)";
            echo "People: savePersonFull: intentando guardar datos con consulta: " . $query . " <br/>";
            $params = array(
                ':name' => $name,
                ':last_name' => $last_name,
                ':code' => $code,
                ':date_birth' => $date_birth,
                ':id_nationalities' => $id_nationalities
            );
    
            try {
                $result = $this->saveRecord($query, $params);
                return $result;
            } catch (PDOException $e) {
                throw new Exception("Error saving person: " . $e->getMessage());
            }
        } else {
            // La persona ya existe, devolver un indicador de error
            return false;
        }
    }
    
    // Método para verificar si una persona con la misma combinación de datos ya existe
    private function isPersonExists($name, $last_name, $code, $date_birth, $id_nationalities)
    {
        $query = "SELECT COUNT(*) AS count FROM peoples 
                  WHERE name = :name AND last_name = :last_name AND code = :code 
                  AND date_birth = :date_birth AND id_nationalities = :id_nationalities";
    
        $params = array(
            ':name' => $name,
            ':last_name' => $last_name,
            ':code' => $code,
            ':date_birth' => $date_birth,
            ':id_nationalities' => $id_nationalities
        );
    
        $result = $this->selectRecord($query, $params);
    
        return $result['count'] > 0;
    }
    
    public function editPerson()
    {
        $query = "UPDATE peoples 
                  SET name = :name, last_name = :last_name, code = :code, 
                      date_birth = :date_birth, id_nationalities = :id_nationalities
                  WHERE id = :id";
        
        $params = array(
            ':id' => $this->id,
            ':name' => $this->name,
            ':last_name' => $this->last_name,
            ':code' => $this->code,
            ':date_birth' => $this->date_birth,
            ':id_nationalities' => $this->id_nationalities
        );
    
        try {
            $result = $this->saveRecord($query, $params);
            return $result;
        } catch (PDOException $e) {
            throw new Exception("Error editing person: " . $e->getMessage());
        }
    }
    
    public function deletePersonById($id)
    {
        $query = "DELETE FROM peoples WHERE id = :id";
        $params = array(':id' => $id);
    
        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);
            return true; // O puedes devolver $stmt->rowCount() > 0; si deseas verificar la cantidad de filas afectadas
        } catch (PDOException $e) {
            throw new Exception("Error deleting person by ID: " . $e->getMessage());
        }
    }
    
    
}
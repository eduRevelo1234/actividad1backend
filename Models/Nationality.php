<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Nationality extends Query
    {
        //Variables
        private $id;
        private $name;
        
        //Constructor
        public function __construct( $idNationality , $nameNationality )
        {
            parent::__construct();
            $this->id=$idNationality;
            $this->name=$nameNationality;
            parent::__construct();
        }
        
        //funcion para leer de base de datos el id 
        public function getId()
        {
            return $this->id;
        }
        
        //funcion para insertar en base de datos el id 
        public function setId($id)
        {
            $this->id = $id;
        }
        
        //funcion para leer de base de datos el nombre 
        public function getName()
        {
            return $this->name;
        }
        
        //funcion para insertar en base de datos el nombre
        public function setName($name)
        {
            $this->name = $name;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getNationalities()
        {
            $sql = "SELECT * FROM nationalities";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Nationality( $item['id'], $item['name']);
                array_push($listData, $itemObject);
            }

            return $listData;
        }

        //funcion para leer de base de datos un registro mal
        public function getNationalityByTerm($searchTerm)
        {
            $sql = "SELECT * FROM nationalities WHERE name LIKE ?";
            $array = array("%$searchTerm%");
            $result = $this->selectRecords($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos un registro 
        public function getNationality()
        {
            $sql = "SELECT * FROM nationalities WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getNationalityName()
        {
            $sql = "SELECT name FROM nationalities WHERE name = ?";
            $array = array($this->name);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }
        //funcion para guardar el registro
        public function saveNationality()
        {
            $sql = "INSERT INTO nationalities (name) VALUES (?)";
            $array = array($this->name);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }
        
        //funcion para actualizar el registro
        public function updateNationality()
        {
            $nationalityUpdate = false;

            $sql = "UPDATE nationalities SET name=? WHERE id = ?";
            $array = array($this->name,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $nationalityUpdate = true;
            }
            return $nationalityUpdate;
        }

        //funcion para eliminar el registro
        public function eliminateNationality()
        {
            $nationalityEliminate = false;

            $sql = "DELETE FROM nationalities WHERE id = ?";
            $array = array($this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $nationalityEliminate = true;
            }
            return $nationalityEliminate;
        }
    }
?>

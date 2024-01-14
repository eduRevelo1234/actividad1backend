<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Platform extends Query
    {
        //Variables
        private $id;
        private $name;
        private $status;
        
        //Constructor
        public function __construct($idPlatform, $namePlatform, $statusPlatform)
        {
            $this->id = $idPlatform;
            $this->name = $namePlatform;
            $this->status = $statusPlatform;
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

        //funcion para leer de base de datos el nombre 
        public function getStatus()
        {
            return $this->status;
        }
        
        //funcion para insertar en base de datos el nombre
        public function setStatus($status)
        {
            $this->status = $status;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getPlatforms()
        {
            $sql = "SELECT * FROM platforms";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Platform($item['id'], $item['name'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para obtener de base de datos todos los registros Activos
        public function getPlatformsActive()
        {
            $sql = "SELECT * FROM platforms WHERE status = 'Activa'";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Platform($item['id'], $item['name'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }

        //funcion para leer de base de datos un registro 
        public function getPlatform()
        {
            $sql = "SELECT * FROM platforms WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getPlatformName()
        {
            $sql = "SELECT name FROM platforms WHERE name = ?";
            $array = array($this->name);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function savePlatform()
        {
            $sql = "INSERT INTO platforms (name,status) VALUES (?,?)";
            $array = array($this->name,$this->status);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updatePlatform()
        {
            $platformUpdate = false;

            $sql = "UPDATE platforms SET name=? WHERE id = ?";
            $array = array($this->name,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $platformUpdate = true;
            }
            return $platformUpdate;
        }

        //funcion para actualizar el registro
        public function activatePlatform()
        {
            
            $platformUpdate = false;

            $sql = "UPDATE platforms SET name=?,status=? WHERE id = ?";
            $array = array($this->name,$this->status,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $platformUpdate = true;
            }
            return $platformUpdate;
        }
        
    }

 ?>
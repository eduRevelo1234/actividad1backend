<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Director extends Query
    {
        //Variables
        private $id;
        private $idperson;
        private $code;
        private $status;
        
        //Constructor
        public function __construct($idDirector, $idpersonDirector, $codeDirector, $statusDirector)
        {
            $this->id = $idDirector;
            $this->idperson = $idpersonDirector;
            $this->code = $codeDirector;
            $this->status = $statusDirector;
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
        
        //funcion para leer de base de datos el id de persona 
        public function getIdperson()
        {
            return $this->idperson;
        }
        
        //funcion para insertar en base de datos el id de persona
        public function setName($idperson)
        {
            $this->idperson = $idperson;
        }

        //funcion para leer de base de datos el nombre 
        public function getCode()
        {
            return $this->code;
        }
        
        //funcion para insertar en base de datos el nombre
        public function setCode($code)
        {
            $this->code = $code;
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
        public function getDirectors()
        {
            $sql = "SELECT * FROM directors";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Director($item['id'], $item['idperson'], $item['code'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getDirector()
        {
            $sql = "SELECT * FROM directors WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el codigo
        public function getDirectorCode()
        {
            $sql = "SELECT code FROM directors WHERE code = ?";
            $array = array($this->code);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveDirector()
        {
            $sql = "INSERT INTO directors (idperson,code,status) VALUES (?,?,?)";
            $array = array($this->idperson,$this->code,$this->status);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateDirector()
        {
            $directorUpdate = false;

            $sql = "UPDATE directors SET idperson=?, code=? WHERE id = ?";
            $array = array($this->idperson,$this->code,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $directorUpdate = true;
            }
            return $directorUpdate;
        }

        //funcion para actualizar el registro
        public function activateDirector()
        {
            
            $directorUpdate = false;

            $sql = "UPDATE directors SET status=? WHERE id = ?";
            $array = array($this->status,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $directorUpdate = true;
            }
            return $directorUpdate;
        }
        
    }

 ?>
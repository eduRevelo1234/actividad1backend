<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Actor extends Query
    {
        //Variables
        private $id;
        private $idperson;
        private $code;
        private $status;
        
        //Constructor
        public function __construct($idActor, $idpersonActor, $codeActor, $statusActor)
        {
            $this->id = $idActor;
            $this->idperson = $idpersonActor;
            $this->code = $codeActor;
            $this->status = $statusActor;
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
        public function getActors()
        {
            $sql = "SELECT * FROM actors";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Actor($item['id'], $item['idperson'], $item['code'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }

        //funcion para obtener de base de datos todos los registros Activos
        public function getActorsActive()
        {
            $sql = "SELECT * FROM actors WHERE status = 'Activa'";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Actor($item['id'], $item['idperson'], $item['code'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getActor()
        {
            $sql = "SELECT * FROM actors WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el codigo
        public function getActorCode()
        {
            $sql = "SELECT code FROM actors WHERE code = ?";
            $array = array($this->code);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveActor()
        {
            $sql = "INSERT INTO actors (idperson,code,status) VALUES (?,?,?)";
            $array = array($this->idperson,$this->code,$this->status);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateActor()
        {
            $actorUpdate = false;

            $sql = "UPDATE actors SET idperson=?, code=? WHERE id = ?";
            $array = array($this->idperson,$this->code,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $actorUpdate = true;
            }
            return $actorUpdate;
        }

        //funcion para actualizar el registro
        public function activateActor()
        {
            
            $actorUpdate = false;

            $sql = "UPDATE actors SET status=? WHERE id = ?";
            $array = array($this->status,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $actorUpdate = true;
            }
            return $actorUpdate;
        }

        //funcion para actualizar el registro
        public function activateActorPerson()
        {
            
            $actorUpdate = false;

            $sql = "UPDATE actors SET status=? WHERE idperson = ?";
            $array = array($this->status,$this->idperson);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $actorUpdate = true;
            }
            return $actorUpdate;
        }
    }

 ?>
<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailActorSerie extends Query
    {
        //Variables
        private $id;
        private $idactor;
        private $idserie;
        
        //Constructor
        public function __construct($idActorSerie, $idactorActorSerie,$idserieActorSerie)
        {
            $this->id = $idActorSerie;
            $this->idactor = $idactorActorSerie;
            $this->idserie = $idserieActorSerie;
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
        
        //funcion para leer de base de datos el idserie 
        public function getIdactor()
        {
            return $this->idactor;
        }
        
        //funcion para insertar en base de datos el idserie
        public function setIdactor($idactor)
        {
            $this->idactor = $idactor;
        }

        //funcion para leer de base de datos el idlanguaje 
        public function getIdserie()
        {
            return $this->idserie;
        }
        
        //funcion para insertar en base de datos el idlanguaje
        public function setIdserie($idserie)
        {
            $this->idserie = $idserie;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getActorSeries()
        {
            $sql = "SELECT * FROM actor_serie_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Serie($item['id'], $item['idactor'], $item['idserie']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer los registros que tenga el actor y la pelicula
        public function getActorSerie()
        {
            $sql = "SELECT * FROM actor_serie_detail WHERE idactor = ? and idserie = ?";
            $array = array($this->idactor,$this->idserie);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveActorSerie()
        {
            
            $sql = "INSERT INTO actor_serie_detail (idactor,idserie) VALUES (?,?)";
            $array = array($this->idactor,$this->idserie);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateActorSerie()
        {
            $serieUpdate = false;

            $sql = "DELETE FROM actor_serie_detail WHERE idserie = ?";
            $array = array($this->idserie);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $serieUpdate = true;
            }
            return $serieUpdate;
        }
        
    }

 ?>
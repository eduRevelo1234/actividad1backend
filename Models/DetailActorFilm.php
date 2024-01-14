<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailActorFilm extends Query
    {
        //Variables
        private $id;
        private $idactor;
        private $idfilm;
        
        //Constructor
        public function __construct($idActorFilm, $idactorActorFilm,$idfilmActorFilm)
        {
            $this->id = $idActorFilm;
            $this->idactor = $idactorActorFilm;
            $this->idfilm = $idfilmActorFilm;
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
        
        //funcion para leer de base de datos el idfilm 
        public function getIdactor()
        {
            return $this->idactor;
        }
        
        //funcion para insertar en base de datos el idfilm
        public function setIdactor($idactor)
        {
            $this->idactor = $idactor;
        }

        //funcion para leer de base de datos el idlanguaje 
        public function getIdfilm()
        {
            return $this->idfilm;
        }
        
        //funcion para insertar en base de datos el idlanguaje
        public function setIdfilm($idfilm)
        {
            $this->idfilm = $idfilm;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getActorFilms()
        {
            $sql = "SELECT * FROM actor_film_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Film($item['id'], $item['idactor'], $item['idfilm']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer los registros que tenga el actor y la pelicula
        public function getActorFilm()
        {
            $sql = "SELECT * FROM actor_film_detail WHERE idactor = ? and idfilm = ?";
            $array = array($this->idactor,$this->idfilm);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveActorFilm()
        {
            
            $sql = "INSERT INTO actor_film_detail (idactor,idfilm) VALUES (?,?)";
            $array = array($this->idactor,$this->idfilm);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateActorFilm()
        {
            $filmUpdate = false;

            $sql = "DELETE FROM actor_film_detail WHERE idfilm = ?";
            $array = array($this->idfilm);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $filmUpdate = true;
            }
            return $filmUpdate;
        }
        
    }

 ?>
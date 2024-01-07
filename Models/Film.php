<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Film extends Query
    {
        //Variables
        private $id;
        private $title;
        private $idplatform;
        private $iddirector;
        private $premiereyear;
        
        //Constructor
        public function __construct($idFilm, $titleFilm, $idplatformFilm,$iddirectorFilm,$premiereyearFilm)
        {
            $this->id = $idFilm;
            $this->title = $titleFilm;
            $this->idplatform = $idplatformFilm;
            $this->iddirector = $iddirectorFilm;
            $this->premiereyear = $premiereyearFilm;
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
        
        //funcion para leer de base de datos el titulo 
        public function getTitle()
        {
            return $this->title;
        }
        
        //funcion para insertar en base de datos el titulo
        public function setTitle($title)
        {
            $this->title = $title;
        }

        //funcion para leer de base de datos la plataforma 
        public function getIdplatform()
        {
            return $this->idplatform;
        }
        
        //funcion para insertar en base de datos la plataforma
        public function setIdplatform($idplatform)
        {
            $this->idplatform = $idplatform;
        }

        //funcion para leer de base de datos el id director
        public function getIddirector()
        {
            return $this->iddirector;
        }
        
        //funcion para insertar en base de datos el id director
        public function setIddirector($iddirector)
        {
            $this->iddirector = $iddirector;
        }
        
        //funcion para leer de base de datos el año 
        public function getPremiereyear()
        {
            return $this->premiereyear;
        }
        
        //funcion para insertar en base de datos el año
        public function setPremiereyear($premiereyear)
        {
            $this->premiereyear = $premiereyear;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getFilms()
        {
            $sql = "SELECT * FROM films";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Film($item['id'], $item['title'], $item['idplatform'], $item['iddirector'], $item['premiereyear']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getFilm()
        {
            $sql = "SELECT * FROM films WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getFilmTitle()
        {
            $sql = "SELECT title FROM films WHERE title = ?";
            $array = array($this->title);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveFilm()
        {
            
            $sql = "INSERT INTO films (title,idplatform,iddirector,premiereyear) VALUES (?,?,?,?)";
            $array = array($this->title,$this->idplatform,$this->iddirector,$this->premiereyear);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateFilm()
        {
            $filmUpdate = false;

            $sql = "UPDATE films SET title=?, idplatform=?, iddirector=?, premiereyear=? WHERE id = ?";
            $array = array($this->title,$this->idplatform,$this->iddirector,$this->premiereyear,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $filmUpdate = true;
            }
            return $filmUpdate;
        }

        //funcion para actualizar el registro
        public function eliminateFilm()
        {
            $filmUpdate = false;

            $sql = "DELETE FROM films WHERE id = ?";
            $array = array($this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $filmUpdate = true;
            }
            return $filmUpdate;
        }
        
    }

 ?>
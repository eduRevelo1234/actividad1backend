<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailCaptionFilm extends Query
    {
        //Variables
        private $id;
        private $idcaptionfilm;
        private $idcaptionlanguage;
        
        //Constructor
        public function __construct($idCaptionFilm, $idfilmCaptionFilm,$idlanguageCaptionFilm)
        {
            $this->id = $idCaptionFilm;
            $this->idcaptionfilm = $idfilmCaptionFilm;
            $this->idcaptionlanguage = $idlanguageCaptionFilm;
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
        public function getIdCaptionFilm()
        {
            return $this->idcaptionfilm;
        }
        
        //funcion para insertar en base de datos el idfilm
        public function setIdCaptionFilm($idcaptionfilm)
        {
            $this->idcaptionfilm = $idcaptionfilm;
        }

        //funcion para leer de base de datos el idlanguaje 
        public function getIdCaptionLanguage()
        {
            return $this->idcaptionlanguage;
        }
        
        //funcion para insertar en base de datos el idlanguaje
        public function setIdCaptionLanguage($idcaptionlanguage)
        {
            $this->idcaptionlanguage = $idcaptionlanguage;
        }
        
        //funcion para obtener de base de datos todos los registros 
        public function getCaptionFilms()
        {
            $sql = "SELECT * FROM languagecaption_film_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Film($item['id'], $item['idfilm'], $item['idlanguage']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }

        //funcion para leer de base de datos un registro 
        public function getCaptionFilm()
        {
            $sql = "SELECT * FROM languagecaption_film_detail WHERE idfilm = ? and idlanguage = ?";
            $array = array($this->idcaptionfilm,$this->idcaptionlanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveCaptionFilm()
        {
            $sql = "INSERT INTO languagecaption_film_detail (idfilm,idlanguage) VALUES (?,?)";
            $array = array($this->idcaptionfilm,$this->idcaptionlanguage);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateCaptionFilm()
        {
            $filmUpdate = false;

            $sql = "DELETE FROM languagecaption_film_detail WHERE idfilm = ?";
            $array = array($this->idcaptionfilm);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $filmUpdate = true;
            }
            return $filmUpdate;
        }
    }
?>
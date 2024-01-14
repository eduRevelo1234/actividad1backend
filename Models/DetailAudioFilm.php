<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailAudioFilm extends Query
    {
        //Variables
        private $id;
        private $idaudiofilm;
        private $idaudiolanguage;
        
        //Constructor
        public function __construct($idAudioFilm, $idfilmAudioFilm,$idlanguageAudioFilm)
        {
            $this->id = $idAudioFilm;
            $this->idaudiofilm = $idfilmAudioFilm;
            $this->idaudiolanguage = $idlanguageAudioFilm;
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
        public function getIdAudioFilm()
        {
            return $this->idaudiofilm;
        }
        
        //funcion para insertar en base de datos el idfilm
        public function setIdAudioFilm($idaudiofilm)
        {
            $this->idaudiofilm = $idaudiofilm;
        }

        //funcion para leer de base de datos el idlanguaje 
        public function getIdAudioLanguage()
        {
            return $this->idaudiolanguage;
        }
        
        //funcion para insertar en base de datos el idlanguaje
        public function setIdAudioLanguage($idaudiolanguage)
        {
            $this->idaudiolanguage = $idaudiolanguage;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getAudioFilms()
        {
            $sql = "SELECT * FROM languageaudio_film_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Film($item['id'], $item['idfilm'], $item['idlanguage']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer los registros que tenga la pelicula y el idioma
        public function getAudioFilm()
        {
            $sql = "SELECT * FROM languageaudio_film_detail WHERE idfilm = ? and idlanguage = ?";
            $array = array($this->idaudiofilm,$this->idaudiolanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos los registros que contiene un lenguaje
        public function getFilmLanguajeAudio()
        {
            $sql = "SELECT idfilm FROM languageaudio_film_detail WHERE idlanguage = ?";
            $array = array($this->idaudiolanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveAudioFilm()
        {
            
            $sql = "INSERT INTO languageaudio_film_detail (idfilm,idlanguage) VALUES (?,?)";
            $array = array($this->idaudiofilm,$this->idaudiolanguage);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateAudioFilm()
        {
            $filmUpdate = false;

            $sql = "DELETE FROM languageaudio_film_detail WHERE idfilm = ?";
            $array = array($this->idaudiofilm);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $filmUpdate = true;
            }
            return $filmUpdate;
        }
        
    }

 ?>
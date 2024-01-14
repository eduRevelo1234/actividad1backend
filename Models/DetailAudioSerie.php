<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailAudioSerie extends Query
    {
        //Variables
        private $id;
        private $idaudioserie;
        private $idaudiolanguage;
        
        //Constructor
        public function __construct($idAudioSerie, $idserieAudioSerie,$idlanguageAudioSerie)
        {
            $this->id = $idAudioSerie;
            $this->idaudioserie = $idserieAudioSerie;
            $this->idaudiolanguage = $idlanguageAudioSerie;
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
        public function getIdAudioSerie()
        {
            return $this->idaudioserie;
        }
        
        //funcion para insertar en base de datos el idserie
        public function setIdAudioSerie($idaudioserie)
        {
            $this->idaudioserie = $idaudioserie;
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
        public function getAudioSeries()
        {
            $sql = "SELECT * FROM languageaudio_serie_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Serie($item['id'], $item['idserie'], $item['idlanguage']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer los registros que tenga la pelicula y el idioma
        public function getAudioSerie()
        {
            $sql = "SELECT * FROM languageaudio_serie_detail WHERE idserie = ? and idlanguage = ?";
            $array = array($this->idaudioserie,$this->idaudiolanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos los registros que contiene un lenguaje
        public function getSerieLanguajeAudio()
        {
            $sql = "SELECT idserie FROM languageaudio_serie_detail WHERE idlanguage = ?";
            $array = array($this->idaudiolanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveAudioSerie()
        {
            
            $sql = "INSERT INTO languageaudio_serie_detail (idserie,idlanguage) VALUES (?,?)";
            $array = array($this->idaudioserie,$this->idaudiolanguage);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateAudioSerie()
        {
            $serieUpdate = false;

            $sql = "DELETE FROM languageaudio_serie_detail WHERE idserie = ?";
            $array = array($this->idaudioserie);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $serieUpdate = true;
            }
            return $serieUpdate;
        }
        
    }

 ?>
<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class DetailCaptionSerie extends Query
    {
        //Variables
        private $id;
        private $idcaptionserie;
        private $idcaptionlanguage;
        
        //Constructor
        public function __construct($idCaptionSerie, $idserieCaptionSerie,$idlanguageCaptionSerie)
        {
            $this->id = $idCaptionSerie;
            $this->idcaptionserie = $idserieCaptionSerie;
            $this->idcaptionlanguage = $idlanguageCaptionSerie;
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
        public function getIdCaptionSerie()
        {
            return $this->idcaptionserie;
        }
        
        //funcion para insertar en base de datos el idserie
        public function setIdCaptionSerie($idcaptionserie)
        {
            $this->idcaptionserie = $idcaptionserie;
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
        public function getCaptionSeries()
        {
            $sql = "SELECT * FROM languagecaption_serie_detail";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Serie($item['id'], $item['idserie'], $item['idlanguage']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }

        //funcion para leer de base de datos un registro 
        public function getCaptionSerie()
        {
            $sql = "SELECT * FROM languagecaption_serie_detail WHERE idserie = ? and idlanguage = ?";
            $array = array($this->idcaptionserie,$this->idcaptionlanguage);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveCaptionSerie()
        {
            $sql = "INSERT INTO languagecaption_serie_detail (idserie,idlanguage) VALUES (?,?)";
            $array = array($this->idcaptionserie,$this->idcaptionlanguage);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para eliminar el registro
        public function eliminateCaptionSerie()
        {
            $serieUpdate = false;

            $sql = "DELETE FROM languagecaption_serie_detail WHERE idserie = ?";
            $array = array($this->idcaptionserie);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $serieUpdate = true;
            }
            return $serieUpdate;
        }
    }
?>
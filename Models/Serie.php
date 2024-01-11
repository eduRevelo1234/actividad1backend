<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Serie extends Query
    {
        //Variables
        private $id;
        private $title;
        private $idplatform;
        private $iddirector;
        private $premiereyear;
        
        //Constructor
        public function __construct($idSerie, $titleSerie, $idplatformSerie,$iddirectorSerie,$premiereyearSerie)
        {
            $this->id = $idSerie;
            $this->title = $titleSerie;
            $this->idplatform = $idplatformSerie;
            $this->iddirector = $iddirectorSerie;
            $this->premiereyear = $premiereyearSerie;
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
        public function getSeries()
        {
            $sql = "SELECT * FROM series";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Serie($item['id'], $item['title'], $item['idplatform'], $item['iddirector'], $item['premiereyear']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getSerie()
        {
            $sql = "SELECT * FROM series WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getSerieTitle()
        {
            $sql = "SELECT title FROM series WHERE title = ?";
            $array = array($this->title);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveSerie()
        {
            
            $sql = "INSERT INTO series (title,idplatform,iddirector,premiereyear) VALUES (?,?,?,?)";
            $array = array($this->title,$this->idplatform,$this->iddirector,$this->premiereyear);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateSerie()
        {
            $serieUpdate = false;

            $sql = "UPDATE series SET title=?, idplatform=?, iddirector=?, premiereyear=? WHERE id = ?";
            $array = array($this->title,$this->idplatform,$this->iddirector,$this->premiereyear,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $serieUpdate = true;
            }
            return $serieUpdate;
        }

        //funcion para borrar el registro
        public function eliminateSerie()
        {
            $serieUpdate = false;

            $sql = "DELETE FROM series WHERE id = ?";
            $array = array($this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $serieUpdate = true;
            }
            return $serieUpdate;
        }
        
        //funcion para obtener el id del ultimo registro
        public function getendSerie()
        {
            $sql = "SELECT MAX( id ) AS maxid FROM series
            
            ;";
            $array = null;
            $result = $this->selectRecord($sql, $array);
            return $result;
        }
    }

 ?>
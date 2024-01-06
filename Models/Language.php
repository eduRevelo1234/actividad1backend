<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Language extends Query
    {
        //Variables
        private $id;
        private $name;
        private $isocode;
        
        //Constructor
        public function __construct($idLanguage, $nameLanguage, $isocodeLanguage)
        {
            $this->id = $idLanguage;
            $this->name = $nameLanguage;
            $this->isocode = $isocodeLanguage;
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
        
        //funcion para leer de base de datos el nombre 
        public function getName()
        {
            return $this->name;
        }
        
        //funcion para insertar en base de datos el nombre
        public function setName($name)
        {
            $this->name = $name;
        }

        //funcion para leer de base de datos el nombre 
        public function getIsocode()
        {
            return $this->isocode;
        }
        
        //funcion para insertar en base de datos el nombre
        public function setIsocode($isocode)
        {
            $this->isocode = $isocode;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getLanguages()
        {
            $sql = "SELECT * FROM languages";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Language($item['id'], $item['name'], $item['isocode']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getLanguage()
        {
            $sql = "SELECT * FROM languages WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getLanguageName()
        {
            $sql = "SELECT name FROM languages WHERE name = ?";
            $array = array($this->name);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el ISO code
        public function getLanguageISOCode()
        {
            $sql = "SELECT name FROM languages WHERE isocode = ?";
            $array = array($this->isocode);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function saveLanguage()
        {
            $sql = "INSERT INTO languages (name,isocode) VALUES (?,?)";
            $array = array($this->name,$this->isocode);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateLanguage()
        {
            $languageUpdate = false;

            $sql = "UPDATE languages SET name=?, isocode=? WHERE id = ?";
            $array = array($this->name,$this->isocode,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $languageUpdate = true;
            }
            return $languageUpdate;
        }

        //funcion para actualizar el registro
        public function eliminateLanguage()
        {
            $languageUpdate = false;

            $sql = "DELETE FROM languages WHERE id = ?";
            $array = array($this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $languageUpdate = true;
            }
            return $languageUpdate;
        }
        
    }

 ?>
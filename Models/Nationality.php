<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');



    class Nationalities extends Query
    {
        //Variables
        private $id;
        private $name;

        public function __construct($idNationalities, $nameNationalities)
        {
            $this->id = $idNationalities;
            $this->name = $nameNationalities;
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

 //funcion para obtener de base de datos todos los registros 

 public function getNationalities()
        {
            $sql = "SELECT * FROM nationalities";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Nationalities($item['id'], $item['name']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
//funcion para leer de base de datos un registro 
public function getNationalitie() {
            $sql = "SELECT * FROM nationalities";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Platform($item['id'], $item['name']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }

    }

    ?>
        
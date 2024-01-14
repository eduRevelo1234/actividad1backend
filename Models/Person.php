<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Person extends Query
    {
        //Variables
        private $id;
        private $name;
        private $lastname;
        private $code;
        private $datebirth;
        private $idnationality;
        private $status;
        
        //Constructor
        public function __construct($idPerson, $namePerson, $lastnamePerson,$codePerson,$datebirthPerson,$idnationalityPerson,$statusPerson)
        {
            $this->id = $idPerson;
            $this->name = $namePerson;
            $this->lastname = $lastnamePerson;
            $this->code = $codePerson;
            $this->datebirth = $datebirthPerson;
            $this->idnationality = $idnationalityPerson;
            $this->status = $statusPerson;
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

        //funcion para leer de base de datos del apellido 
        public function getLastname()
        {
            return $this->lastname;
        }
        
        //funcion para insertar en base de datos del apellido
        public function setLastname($lastname)
        {
            $this->lastname = $lastname;
        }

        //funcion para leer de base de datos del codigo personal
        public function getCode()
        {
            return $this->code;
        }
        
        //funcion para insertar en base de datos del codigo personal
        public function setCode($code)
        {
            $this->code = $code;
        }
        
        //funcion para leer de base de datos la fecha de nacimiento 
        public function getDatebirth()
        {
            return $this->datebirth;
        }
        
        //funcion para insertar en base de datos la fecha de nacimiento
        public function setDatebirth($datebirth)
        {
            $this->datebirth = $datebirth;
        }

        //funcion para leer de base de datos el id de la nacionalidad 
        public function getIdnacionality()
        {
            return $this->idnationality;
        }
        
        //funcion para insertar en base de datos el id de la nacionalidad
        public function setIdnacionality($idnationality)
        {
            $this->idnationality = $idnationality;
        }

        //funcion para leer de base de datos el estado 
        public function getStatus()
        {
            return $this->status;
        }
        
        //funcion para insertar en base de datos el estado
        public function setStatus($status)
        {
            $this->status = $status;
        }

        //funcion para obtener de base de datos todos los registros 
        public function getPersons()
        {
            $sql = "SELECT * FROM persons";
            $data = $this->selectRecords($sql);
            $listData = [];

            foreach ($data as $item) {
                $itemObject = new Person($item['id'], $item['name'], $item['lastname'], $item['code'], $item['datebirth'], $item['idnationality'], $item['status']);
                array_push($listData,$itemObject);
            }
            
            return $listData;
        }
        
        //funcion para leer de base de datos un registro 
        public function getPerson()
        {
            $sql = "SELECT * FROM persons WHERE id = ?";
            $array = array($this->id);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getPersonName()
        {
            $sql = "SELECT name FROM persons WHERE name = ?";
            $array = array($this->name);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getPersonCode()
        {
            $sql = "SELECT name FROM persons WHERE code = ?";
            $array = array($this->code);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para leer de base de datos el registro que contiene el nombre
        public function getPersonNationality()
        {
            $sql = "SELECT name FROM persons WHERE idnationality = ?";
            $array = array($this->idnationality);
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para guardar el registro
        public function savePerson()
        {
            
            $sql = "INSERT INTO persons (name,lastname,code,datebirth,idnationality) VALUES (?,?,?,?,?)";
            $array = array($this->name,$this->lastname,$this->code,$this->datebirth,$this->idnationality,);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updatePerson()
        {
            $personUpdate = false;

            $sql = "UPDATE persons SET name=?, lastname=?, code=?, datebirth=?, idnationality=? WHERE id = ?";
            $array = array($this->name,$this->lastname,$this->code,$this->datebirth,$this->idnationality,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $personUpdate = true;
            }
            return $personUpdate;
        }

        //funcion para borrar el registro
        public function eliminatePerson()
        {
            $personDelete = false;

            $sql = "DELETE FROM persons WHERE id = ?";
            $array = array($this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $personDelete = true;
            }
            
            return $personDelete;
        }
        
        //funcion para obtener el id del ultimo registro
        public function getendPerson()
        {
            $sql = "SELECT MAX( id ) AS maxid FROM persons
            
            ;";
            $array = null;
            $result = $this->selectRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function activatePerson()
        {
            $personUpdate = false;

            $sql = "UPDATE persons SET status=? WHERE id = ?";
            $array = array($this->status,$this->id);
            $data = $this->saveRecord($sql, $array);
            
            if($data){
                $personUpdate = true;
            }
            return $personUpdate;
        }
    }

 ?>
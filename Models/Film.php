<?php
    require_once(__DIR__ . '/../Config/App/Querys.php');

    class Film extends Query
    {
        //Variables
        private $id;
        private $title;
        private $idplatform;
        private $iddirector;
        private $actors;
        private $languagesaudio;
        private $languagescaption;
        private $premiereyear;
        
        //Constructor
        public function __construct($idFilm, $titleFilm, $idplatformFilm,$iddirectorFilm,$actorsFilm,$languagesaudioFilm,$languagescaptionFilm,$premiereyearFilm)
        {
            $this->id = $idFilm;
            $this->title = $titleFilm;
            $this->idplatform = $idplatformFilm;
            $this->iddirector = $iddirectorFilm;
            $this->actors = $actorsFilm;
            $this->languagesaudio = $languagesaudioFilm;
            $this->languagescaption = $languagescaptionFilm;
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
        public function setId($iddirector)
        {
            $this->iddirector = $iddirector;
        }
        
        //funcion para leer de base de datos los actores
        public function getActors()
        {
            return $this->actors;
        }
        
        //funcion para insertar en base de datos los actores
        public function setTitle($actors)
        {
            $this->actors = $actors;
        }

        //funcion para leer de base de datos los lenguajes de audio 
        public function getLanguagesaudio()
        {
            return $this->languagesaudio;
        }
        
        //funcion para insertar en base de datos los lenguajes de audio
        public function setLanguagesaudio($languagesaudio)
        {
            $this->languagesaudio = $languagesaudio;
        }

        //funcion para leer de base de datos los lenguajes de subtitulos 
        public function getLanguagescaption()
        {
            return $this->languagescaption;
        }
        
        //funcion para insertar en base de datos los lenguajes de subtitulos 
        public function setLanguagescaption($languagescaption)
        {
            $this->languagescaption = $languagescaption;
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
                $itemObject = new Film($item['id'], $item['title'], $item['idplatform'], $item['iddirectorFilm'], $item['actorsFilm'], $item['languagesaudioFilm'], $item['languagescaptionFilm'], $item['premiereyearFilm']);
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
            $sql = "INSERT INTO films (title,id_platform,id_director,actors,languages_audio,languages_caption,premiere_year) VALUES (?,?,?,?,?,?,?)";
            $array = array($this->title,$this->id_platform,$this->id_director,$this->actors,$this->languages_audio,$this->languages_caption,$this->premiere_year);
            $result = $this->insertRecord($sql, $array);
            return $result;
        }

        //funcion para actualizar el registro
        public function updateFilm()
        {
            $filmUpdate = false;

            $sql = "UPDATE films SET title=?, id_platform=?, id_director=?, actors=?, languages_audio=?, languages_caption=?, premiere_year=? WHERE id = ?";
            $array = array($this->title,$this->id_platform,$this->id_director,$this->actors,$this->languages_audio,$this->languages_caption,$this->premiere_year,$this->id);
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
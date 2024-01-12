<?php
class SerieLanguage {
    private $id;
    private $idSerie;
    private $idLanguage;

    function __construct($id, $idSerie, $idLanguage) {
        $this->id = $id;
        $this->idSerie = $idSerie;
        $this->idLanguage = $idLanguage;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdSerie() {
        return $this->idSerie;
    }

    public function setIdSerie($idSerie) {
        $this->idSerie = $idSerie;
    }
    
    public function getIdLanguage() {
        return $this->idLanguage;
    }
}

?>
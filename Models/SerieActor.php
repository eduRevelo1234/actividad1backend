<?php
class SerieActor
{
    private $id;
    private $idActor;
    private $idSerie;

    function __construct($id, $idActor, $idSerie)
    {
        $this->id = $id;
        $this->idActor = $idActor;
        $this->idSerie = $idSerie;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdActor()
    {
        return $this->idActor;
    }

    public function getIdSerie()
    {
        return $this->idSerie;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdSerie($idSerie)
    {
        $this->idSerie = $idSerie;
    }

    public function setIdActor($idActor)
    {
        $this->idActor = $idActor;
    }

}

?>
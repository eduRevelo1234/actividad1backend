<?php
class Season
{
    private $id;
    private $number;
    private $idSerie;
    public function __construct(
        $id,
        $number,
        $idSerie
    ) {
        $this->id = $id;
        $this->$number = $number;
        $this->$idSerie = $idSerie;
    }

    /**
     * @return mixed 
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function getIdSerie()
    {
        return $this->idSerie;
    }

    public function setIdSerie($idSerie)
    {
        $this->idSerie = $idSerie;
    }

}
?>
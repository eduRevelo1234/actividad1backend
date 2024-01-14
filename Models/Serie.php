<?php
class Serie
{
    private $id;
    private $title;
    private $idPlatform;
    private $idDirector;
    private $premierYear;

    public function __construct(
        $id,
        $title,
        $idPlatform,
        $idDirector,
        $premierYear
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->idPlatform = $idPlatform;
        $this->idDirector = $idDirector;
        $this->premierYear = $premierYear;
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

    public function title()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIdPlatform()
    {
        return $this->idPlatform;
    }

    public function setIdPlatform($idPlatform)
    {
        $this->idPlatform = $idPlatform;
    }

    public function getIdDirector()
    {
        return $this->idDirector;
    }

    public function setIdDirector($idDirector)
    {
        $this->idDirector = $idDirector;
    }
    public function getPremierYear()
    {
        return $this->premierYear;
    }
    public function setPremierYear($premierYear)
    {
        $this->premierYear = $premierYear;
    }
}
?>
<?php
class Chapter
{
    private $id;
    private $number;
    private $title;
    private $duration;
    private $idSeason;
    public function __construct(
        $id,
        $number,
        $title,
        $duration,
        $idSeason
    ) {
        $this->id = $id;
        $this->number = $number;
        $this->title = $title;
        $this->duration = $duration;
        $this->idSeason = $idSeason;
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

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getIdSeason()
    {
        return $this->idSeason;
    }

    public function setIdSerie($idSeason)
    {
        $this->idSeason = $idSeason;
    }

}
?>
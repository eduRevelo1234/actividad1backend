<?php
    require_once('../../Models/DetailActorFilm.php');

    //funcion para listar todos los registros 
    function listActorFilms()
    {
        $model = new DetailActorFilm(null, null, null);
        $filmList = $model->getActorFilms();
        return $filmList;
    }

    //funcion para leer los registros que tenga la pelicula y el idioma
    function listActorFilm($actorfilmIdactor,$actorfilmIdfilm)
    {
        $model = new DetailActorFilm(null, $actorfilmIdactor, $actorfilmIdfilm);
        $filmObject = $model->getActorFilm();
        return $filmObject;
    }

    //funcion para guardar el registro
    function burnActorFilm($actorfilmIdactor, $actorfilmIdfilm)
    {
        $model = new DetailActorFilm(null,$actorfilmIdactor, $actorfilmIdfilm);        
        $result = $model->saveActorFilm(); 
        if ($result > 0) {
            $message = 'ok';
        } else {
            $message = 'error';
        }   
        return $message;
    }

    //funcion para borrar el estado del registro
    function eraseActorFilm($filmId)
    {
        $model = new DetailActorFilm(null, null, $filmId);
        $result = $model->eliminateActorFilm();
        if ($result == 1) {
            $message = 'erased';
        } else {
            $message = 'errorrerased';
        }           
        return $message;
    }

?>
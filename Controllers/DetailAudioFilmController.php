<?php
    require_once('../../Models/DetailAudioFilm.php');

    //funcion para listar todos los registros 
    function listAudioFilms()
    {
        $model = new DetailAudioFilm(null, null, null);
        $filmList = $model->getAudioFilms();
        return $filmList;
    }

    //funcion para leer los registros que tenga la pelicula y el idioma
    function listAudioFilm($audiofilmIdfilm,$audiofilmIdlanguage)
    {
        $model = new DetailAudioFilm(null, $audiofilmIdfilm, $audiofilmIdlanguage);
        $filmObject = $model->getAudioFilm();
        return $filmObject;
    }

    //funcion para guardar el registro
    function burnAudioFilm($audiofilmIdfilm, $audiofilmIdlanguage)
    {
        $model = new DetailAudioFilm(null,$audiofilmIdfilm, $audiofilmIdlanguage);        
        $result = $model->saveAudioFilm(); 
        if ($result > 0) {
            $message = 'ok';
        } else {
            $message = 'error';
        }   
        return $message;
    }

    //funcion para borrar el estado del registro
    function eraseAudioFilm($filmId)
    {
        $model = new DetailAudioFilm(null, $filmId, null);
        $result = $model->eliminateAudioFilm();
        if ($result == 1) {
            $message = 'erased';
        } else {
            $message = 'errorrerased';
        }           
        return $message;
    }

?>
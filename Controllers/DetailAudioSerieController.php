<?php
    require_once('../../Models/DetailAudioSerie.php');

    //funcion para listar todos los registros 
    function listAudioSeries()
    {
        $model = new DetailAudioSerie(null, null, null);
        $serieList = $model->getAudioSeries();
        return $serieList;
    }

    //funcion para leer los registros que tenga la pelicula y el idioma
    function listAudioSerie($audioserieIdserie,$audioserieIdlanguage)
    {
        $model = new DetailAudioSerie(null, $audioserieIdserie, $audioserieIdlanguage);
        $serieObject = $model->getAudioSerie();
        return $serieObject;
    }

    //funcion para guardar el registro
    function burnAudioSerie($audioserieIdserie, $audioserieIdlanguage)
    {
        $model = new DetailAudioSerie(null,$audioserieIdserie, $audioserieIdlanguage);        
        $result = $model->saveAudioSerie(); 
        if ($result > 0) {
            $message = 'ok';
        } else {
            $message = 'error';
        }   
        return $message;
    }

    //funcion para borrar el estado del registro
    function eraseAudioSerie($serieId)
    {
        $model = new DetailAudioSerie(null, $serieId, null);
        $result = $model->eliminateAudioSerie();
        if ($result == 1) {
            $message = 'erased';
        } else {
            $message = 'errorrerased';
        }           
        return $message;
    }

?>
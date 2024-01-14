<?php
    require_once('../../Models/DetailActorSerie.php');

    //funcion para listar todos los registros 
    function listActorSeries()
    {
        $model = new DetailActorSerie(null, null, null);
        $serieList = $model->getActorSeries();
        return $serieList;
    }

    //funcion para leer los registros que tenga la pelicula y el idioma
    function listActorSerie($actorserieIdactor,$actorserieIdserie)
    {
        $model = new DetailActorSerie(null, $actorserieIdactor, $actorserieIdserie);
        $serieObject = $model->getActorSerie();
        return $serieObject;
    }

    //funcion para guardar el registro
    function burnActorSerie($actorserieIdactor, $actorserieIdserie)
    {
        $model = new DetailActorSerie(null,$actorserieIdactor, $actorserieIdserie);        
        $result = $model->saveActorSerie(); 
        if ($result > 0) {
            $message = 'ok';
        } else {
            $message = 'error';
        }   
        return $message;
    }

    //funcion para borrar el estado del registro
    function eraseActorSerie($serieId)
    {
        $model = new DetailActorSerie(null, null, $serieId);
        $result = $model->eliminateActorSerie();
        if ($result == 1) {
            $message = 'erased';
        } else {
            $message = 'errorrerased';
        }           
        return $message;
    }

?>
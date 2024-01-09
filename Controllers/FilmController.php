<?php
require_once('../../Models/Film.php');

//funcion para listar todos los registros 
function listFilms()
{
    $model = new Film(null, null, null, null, null);
    $filmList = $model->getFilms();
    return $filmList;
}

//funcion para leer un registro
function listFilm($filmId)
{
    $model = new Film($filmId, null, null, null, null);
    $filmObject = $model->getFilm();
    return $filmObject;
}

//funcion para leer el id del ultimo registro insertado
function endFilm()
{
    $model = new Film(null, null, null, null, null);
    $filmObject = $model->getendFilm();
    return $filmObject;
}

//funcion para guardar el registro

function burnFilm($filmId,$filmTitle, $filmIdplatform,$filmIddirector,$filmPremiereyear,$filmTitleCurrent)
{
    $error=[];
    //Validacion del titulo
    if (empty($filmTitle)) {
        $message = 'errortitulovacio';
        $error[0] = 'error';
    } else if (!preg_match("/^(.|\s)*\S(.|\s)*$/", $filmTitle)) {
        $message = 'errortitulovacio';
        $error[0] = 'error';
    } else {
        $error[0] = 'ok';
    }
    
    //Validacion del plataforma
    if ($filmIdplatform == 0) {
        $message = 'errorplataformavacio';
        $error[1] = 'error';
    } else {
        $error[1] = 'ok';
    }
    
    //Validacion del director
    if ($filmIddirector == 0) {
        $message = 'errordirectorvacio';
        $error[2] = 'error';
    } else {
        $error[2] = 'ok';
    }

    //Validacion del año
    if (empty($filmPremiereyear)) {
        $message = 'erroranovacio';
        $error[3] = 'error';
    } else if (!preg_match("/^[0-9]{4}$/", $filmPremiereyear)) {
        $message = 'erroranoformat';
        $error[3] = 'error';
    } else {
        $error[3] = 'ok';
    }
        
    //No existe error en las entradas
    if ($error[0] == 'ok' && $error[1] == 'ok' && $error[2] == 'ok' && $error[3] == 'ok')
    {
        
        $model = new Film($filmId,$filmTitle, $filmIdplatform,$filmIddirector,$filmPremiereyear);
        
        if ($filmId > 0 )
        {   
            //Editar Pelicula
            if ($filmTitle == $filmTitleCurrent )
            {
                $message = 'sametitle'; 
            }else
            {
                //Verificamos si el nombre de la pelicula no existe en la base 
                $resultFilm = $model->getFilmTitle();
                if (empty($resultFilm))
                {
                    $model = new Film($filmId,$filmTitle, $filmIdplatform,$filmIddirector,$filmPremiereyear);
                    $result = $model->updateFilm();
                    if ($result == 1) {
                        $message = 'edited';
                    } else 
                    {
                        $message = 'errorredited';
                    }
                }else
                {
                    $message = 'errortitle';
                }
            }
        }else
        {
            //Crear Pelicula
                    
            //Verificamos si el nombre de la pelicula no existe en la base 
            $resultFilm = $model->getFilmTitle();

            if (empty($resultFilm))
            {
                $result = $model->saveFilm(); 
                if ($result > 0) {
                    $message = 'registered';
                } else {
                    $message = 'errorregistered';
                }
            }else
            {
                $message = 'errortitle';
            }
        }
    }  
     
    return $message;
}

//funcion para borrar el estado del registro
function eraseFilm($filmId)
{
    $model = new Film($filmId, null, null,null,null);
    $result = $model->eliminateFilm();
    if ($result == 1) {
        $message = 'erased';
    } else {
        $message = 'errorrerased';
    }           
    return $message;
}

?>
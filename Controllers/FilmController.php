<?php
require_once('../../Models/Film.php');

//funcion para listar todos los registros 
function listFilms()
{
    $model = new Film(null, null, null, null, null, null, null, null);
    $filmList = $model->getFilms();
    return $filmList;
}

//funcion para leer un registro
function listFilm($filmId)
{
    $model = new Film($filmId, null, null, null, null, null, null, null);
    $filmObject = $model->getFilm();
    return $filmObject;
}

//funcion para guardar el registro
function saveFilm($filmTitle, $filmIdplatform,$filmIddirector,$filmActors,$filmLanguagesaudio,$filmLanguagescaption,$filmPremiereyear,$filmTitleCurrent)
{
    //Validacion del nombre
    if (empty($filmTitle)) {
        $message = 'errorvacio';
    } else if (!preg_match("/^[\s]*$/", $filmTitle)) {
        $message = 'errorformat';
    } else {
        $message = 'ok';
    }
    
    //No existe error en las entradas
    if ($message == 'ok')
    {
        $model = new Film($filmTitle, $filmIdplatform,$filmIddirector,$filmActors,$filmLanguagesaudio,$filmLanguagescaption,$filmPremiereyear);
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
                    $model = new Film($filmTitle, $filmIdplatform,$filmIddirector,$filmActors,$filmLanguagesaudio,$filmLanguagescaption,$filmPremiereyear);
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
                $model = new Film($filmTitle, $filmIdplatform,$filmIddirector,$filmActors,$filmLanguagesaudio,$filmLanguagescaption,$filmPremiereyear);
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
    $model = new Film($filmId, null, null);
    $result = $model->eliminateFilm();
    if ($result == 1) {
        $message = 'erased';
    } else {
        $message = 'errorrerased';
    }           
    return $message;
}
?>
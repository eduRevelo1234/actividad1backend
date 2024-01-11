<?php
require_once('../../Models/Serie.php');

//funcion para listar todos los registros 
function listSeries()
{
    $model = new Serie(null, null, null, null, null);
    $serieList = $model->getSeries();
    return $serieList;
}

//funcion para leer un registro
function listSerie($serieId)
{
    $model = new Serie($serieId, null, null, null, null);
    $serieObject = $model->getSerie();
    return $serieObject;
}

//funcion para leer el id del ultimo registro insertado
function endSerie()
{
    $model = new Serie(null, null, null, null, null);
    $serieObject = $model->getendSerie();
    return $serieObject;
}

//funcion para guardar el registro

function burnSerie($serieId,$serieTitle, $serieIdplatform,$serieIddirector,$seriePremiereyear,$serieTitleCurrent)
{
    $error=[];
    //Validacion del titulo
    if (empty($serieTitle)) {
        $message = 'errortitulovacio';
        $error[0] = 'error';
    } else if (!preg_match("/^(.|\s)*\S(.|\s)*$/", $serieTitle)) {
        $message = 'errortitulovacio';
        $error[0] = 'error';
    } else {
        $error[0] = 'ok';
    }
    
    //Validacion del plataforma
    if ($serieIdplatform == 0) {
        $message = 'errorplataformavacio';
        $error[1] = 'error';
    } else {
        $error[1] = 'ok';
    }
    
    //Validacion del director
    if ($serieIddirector == 0) {
        $message = 'errordirectorvacio';
        $error[2] = 'error';
    } else {
        $error[2] = 'ok';
    }

    //Validacion del año
    if (empty($seriePremiereyear)) {
        $message = 'erroranovacio';
        $error[3] = 'error';
    } else if (!preg_match("/^[0-9]{4}$/", $seriePremiereyear)) {
        $message = 'erroranoformat';
        $error[3] = 'error';
    } else {
        $error[3] = 'ok';
    }
        
    //No existe error en las entradas
    if ($error[0] == 'ok' && $error[1] == 'ok' && $error[2] == 'ok' && $error[3] == 'ok')
    {
        
        $model = new Serie($serieId,$serieTitle, $serieIdplatform,$serieIddirector,$seriePremiereyear);
        
        //Editar Pelicula
        if ($serieId > 0 )
        {   
            //Buscamos el nombre de la pelicula actual en la base 
            $resultSerie = $model->getSerieTitle();
            //Si no existe el nombre en la base o el nombre se mantiene el mismo
            if (empty($resultSerie) or ($serieTitle == $serieTitleCurrent))
            {
                $model = new Serie($serieId,$serieTitle, $serieIdplatform,$serieIddirector,$seriePremiereyear);
                $result = $model->updateSerie();
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
        }else
        {
            //Crear Pelicula
                    
            //Verificamos si el nombre de la pelicula no existe en la base 
            $resultSerie = $model->getSerieTitle();

            if (empty($resultSerie))
            {
                $result = $model->saveSerie(); 
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
function eraseSerie($serieId)
{
    $model = new Serie($serieId, null, null,null,null);
    $result = $model->eliminateSerie();
    if ($result == 1) {
        $message = 'erased';
    } else {
        $message = 'errorrerased';
    }           
    return $message;
}

?>
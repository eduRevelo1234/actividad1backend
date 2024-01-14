<?php
require_once('../../Models/Director.php');

//funcion para listar todos los registros 
function listDirectors()
{
    $model = new Director(null, null, null,null);
    $directorList = $model->getDirectors();
    return $directorList;
}

//funcion para listar todos los registros activos
function listDirectorsActive()
{
    $model = new Director(null, null, null,null);
    $directorList = $model->getDirectorsActive();
    return $directorList;
}

//funcion para leer un registro
function listDirector($directorId)
{
    $model = new Director($directorId, null, null,null);
    $directorObject = $model->getDirector();
    return $directorObject;
}

//funcion para guardar el registro
function burnDirector($directorId, $directorIdperson,$directorCode, $directorCodeCurrent)
{
    //Validacion del codigo
    if (empty($directorCode)) {
        $message = 'errorcodevacio';
        $error[1] = 'error';
    } else {
        $error[1] = 'ok';
    }

    //Validacion de la persona
    if ($directorIdperson == 0) {
        $message = 'errorpersonvacio';
        $error[0] = 'error';
    } else {
        $error[0] = 'ok';
    }
    
    //No existe error en las entradas
    if ($error[0] == 'ok' && $error[1] == 'ok')
    {
        $model = new Director(null, null, $directorCode, null);
        if ($directorId > 0 )
        {
            //Editar Plataforma
            if ($directorCode == $directorCodeCurrent )
            {
                $message = 'samecode'; 
            }else
            {
                //Verificamos si el codigo del director no existe en la base 
                $resultDirector = $model->getDirectorCode();
                if (empty($resultDirector))
                {
                    $model = new Director($directorId, $directorIdperson, $directorCode, null);
                    $result = $model->updateDirector();
                    if ($result == 1) {
                        $message = 'edited';
                    } else {
                        $message = 'errorredited';
                    }
                }else
                {
                    $message = 'errorcode';
                }
            }
        }else
        {
            //Crear Plataforma
                    
            //Verificamos si el nombre de la plataforma no existe en la base 
            $resultDirector = $model->getDirectorCode();
            if (empty($resultDirector))
            {
                $model = new Director(null, $directorIdperson, $directorCode, 'Activa');
                $result = $model->saveDirector();
                if ($result > 0) {
                    $message = 'registered';
                } else {
                    $message = 'errorregistered';
                }
            }else
            {
                $message = 'errorcode';
            }
        }
    } 
     
    return $message;
}

//funcion para activar el estado del registro
function activeDirector($directorId, $directorStatus)
{
    $model = new Director($directorId, null, null, $directorStatus);
    $result = $model->activateDirector();
    if($directorStatus == 'Activa') 
    {
        if ($result == 1) {
            $message = 'actived';
        } else {
            $message = 'errorractived';
        }                
    }else
    {
        if ($result == 1) {
            $message = 'inactive';
        } else {
            $message = 'errorrinactive';
        }           
    }  
    return $message;
}
?>
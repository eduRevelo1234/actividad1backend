<?php
require_once('../../Models/Platform.php');

//funcion para listar todos los registros 
function listPlatforms()
{
    $model = new Platform(null, null, null);
    $platformList = $model->getPlatforms();
    return $platformList;
}

//funcion para listar todos los registros activos
function listPlatformsActive()
{
    $model = new Platform(null, null, null);
    $platformList = $model->getPlatformsActive();
    return $platformList;
}

//funcion para leer un registro
function listPlatform($platformId)
{
    $model = new Platform($platformId, null, null);
    $platformObject = $model->getPlatform();
    return $platformObject;
}

//funcion para guardar el registro
function burnPlatform($platformId, $platformName, $platformNameCurrent)
{
    //Validacion del nombre
    if (empty($platformName)) {
        $message = 'errorvacio';
    } else if (!preg_match("/^[a-zA-Zñ]+$/", $platformName)) {
        $message = 'errorformat';
    } else {
        $message = 'ok';
    }
    
    //No existe error en las entradas
    if ($message == 'ok')
    {
        $model = new Platform(null, $platformName, null);
        if ($platformId > 0 )
        {
            //Editar Plataforma
            if ($platformName == $platformNameCurrent )
            {
                $message = 'samename'; 
            }else
            {
                //Verificamos si el nombre del idioma no existe en la base 
                $resultPlatform = $model->getPlatformName();
                if (empty($resultPlatform))
                {
                    $model = new Platform($platformId, $platformName, null);
                    $result = $model->updatePlatform();
                    if ($result == 1) {
                        $message = 'edited';
                    } else {
                        $message = 'errorredited';
                    }
                }else
                {
                    $message = 'errorname';
                }
            }
        }else
        {
            //Crear Plataforma
                    
            //Verificamos si el nombre de la plataforma no existe en la base 
            $resultPlatform = $model->getPlatformName();
            if (empty($resultPlatform))
            {
                $model = new Platform($platformId, $platformName, 'Activa');
                $result = $model->savePlatform();
                if ($result > 0) {
                    $message = 'registered';
                } else {
                    $message = 'errorregistered';
                }
            }else
            {
                $message = 'errorname';
            }
        }
    }  
    return $message;
}

//funcion para activar el estado del registro
function activePlatform($platformId, $platformName, $platformStatus)
{
    $model = new Platform($platformId, $platformName, $platformStatus);
    $result = $model->activatePlatform();
    if($platformStatus == 'Activa') 
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
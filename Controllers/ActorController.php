<?php
require_once('../../Models/Actor.php');

//funcion para listar todos los registros 
function listActors()
{
    $model = new Actor(null, null, null,null);
    $actorList = $model->getActors();
    return $actorList;
}

//funcion para listar todos los registros Activos
function listActorsActive()
{
    $model = new Actor(null, null, null,null);
    $actorList = $model->getActorsActive();
    return $actorList;
}

//funcion para leer un registro
function listActor($actorId)
{
    $model = new Actor($actorId, null, null,null);
    $actorObject = $model->getActor();
    return $actorObject;
}

//funcion para guardar el registro
function burnActor($actorId, $actorIdperson,$actorCode, $actorCodeCurrent)
{
    //Validacion del codigo
    if (empty($actorCode)) {
        $message = 'errorcodevacio';
        $error[1] = 'error';
    } else {
        $error[1] = 'ok';
    }

    //Validacion de la persona
    if ($actorIdperson == 0) {
        $message = 'errorpersonvacio';
        $error[0] = 'error';
    } else {
        $error[0] = 'ok';
    }
    
    //No existe error en las entradas
    if ($error[0] == 'ok' && $error[1] == 'ok')
    {
        $model = new Actor(null, null, $actorCode, null);
        if ($actorId > 0 )
        {
            //Editar Plataforma
            if ($actorCode == $actorCodeCurrent )
            {
                $message = 'samecode'; 
            }else
            {
                //Verificamos si el codigo del actor no existe en la base 
                $resultActor = $model->getActorCode();
                if (empty($resultActor))
                {
                    $model = new Actor($actorId, $actorIdperson, $actorCode, null);
                    $result = $model->updateActor();
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
            $resultActor = $model->getActorCode();
            if (empty($resultActor))
            {
                $model = new Actor(null, $actorIdperson, $actorCode, 'Activa');
                $result = $model->saveActor();
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
function activeActor($actorId, $actorStatus)
{
    $model = new Actor($actorId, null, null, $actorStatus);
    $result = $model->activateActor();
    if($actorStatus == 'Activa') 
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
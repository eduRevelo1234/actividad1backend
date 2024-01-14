<?php
require_once('../../Models/Person.php');

//funcion para listar todos los registros 
function listPersons()
{
    $model = new Person(null, null, null, null, null, null, null);
    $personList = $model->getPersons();
    return $personList;
}

//funcion para listar todos los registros activos
function listPersonsActive()
{
    $model = new Person(null, null, null, null, null, null, null);
    $platformList = $model->getPersonsActive();
    return $platformList;
}

//funcion para leer un registro
function listPerson($personId)
{
    $model = new Person($personId, null, null, null, null, null, null);
    $personObject = $model->getPerson();
    return $personObject;
}

//funcion para leer el id del ultimo registro insertado
function endPerson()
{
    $model = new Person(null, null, null, null, null, null, null);
    $personObject = $model->getendPerson();
    return $personObject;
}

//funcion para guardar el registro

function burnPerson($personId,$personName, $personLastname,$personCode,$personDatebirth,$personIdnationality,$personNameCurrent,$personCodeCurrent)
{

    $error=[];
    
    //Validacion de la nacionalidad
    if ($personIdnationality == 0) 
    {
        $message = 'errornationalityvacio';
        $error[4] = 'error';
    } else 
    {
        $error[4] = 'ok';
    }
    
    //Validacion de la fecha de nacimiento
    if (empty($personDatebirth)) 
    {
        $message = 'errordatevacio';
        $error[3] = 'error';
    } else if (!preg_match('/^([0-2][0-9]|3[0-1])(\/|-)(0[1-9]|1[0-2])\2(\d{4})$/', trim($personDatebirth))) 
    {
        $message = 'errordateformat';
        $error[3] = 'error';
    } else 
    {
        $error[3] = 'ok';
    }

    //Validacion del codigo
    if (empty($personCode)) 
    {
        $message = 'errorcodevacio';
        $error[2] = 'error';
    } else if (!preg_match('/^[a-zA-Z0-9\-]+$/', trim($personCode))) 
    {
        $message = 'errorcodeformat';
        $error[2] = 'error';
    } else 
    {
        $error[2] = 'ok';
    }

    //Validacion del Apellido
    if (empty($personLastname)) 
    {
        $message = 'errorlastvacio';
        $error[1] = 'error';
    } else if (!preg_match("/^(.|\s)*\S(.|\s)*$/", $personLastname)) 
    {
        $message = 'errorlastformat';
        $error[1] = 'error';
    } else 
    {
        $error[1] = 'ok';
    }

    //Validacion del Nombre
    if (empty($personName)) 
    {
        $message = 'errornamevacio';
        $error[0] = 'error';
    } else if (!preg_match("/^(.|\s)*\S(.|\s)*$/", $personName)) 
    {
        $message = 'errornameformat';
        $error[0] = 'error';
    } else 
    {
        $error[0] = 'ok';
    }

    //Cambio de formato de la fecha a aaaa/mm/dd
    $tempDate = str_replace('/', '-', $personDatebirth);
    $newDate= date('Y-m-d', strtotime($tempDate));
    
    //No existe error en las entradas
    if ($error[0] == 'ok' && $error[1] == 'ok' && $error[2] == 'ok' && $error[3] == 'ok' && $error[4] == 'ok')
    {
        $model = new Person($personId,$personName, $personLastname,$personCode,$newDate,$personIdnationality,null);
        
        //Editar Pelicula
        if ($personId > 0 )
        {   
            
                //Buscamos el codigo personal en la base 
                $resultCodePerson = $model->getPersonCode();
                //Si no existe el codigo en la base o el codigo se mantiene el mismo
                if (empty($resultCodePerson) or ($personCode == $personCodeCurrent))
                {
                    $model = new Person($personId,$personName, $personLastname,$personCode,$newDate,$personIdnationality,null);
                    $result = $model->updatePerson();
                    if ($result == 1) {
                        $message = 'edited';
                    } else 
                    {
                        $message = 'errorredited';
                    }
                }else
                {
                    $message = 'errorcode';
                }
        
        }else
        {
            //Crear Pelicula
                    
              
                //Buscamos el codigo personal en la base 
                $resultCodePerson = $model->getPersonCode();
                //Si no existe el codigo en la base o el codigo se mantiene el mismo
                if (empty($resultCodePerson) or ($personCode == $personCodeCurrent))
                {
                    $result = $model->savePerson(); 
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
function activePerson($personId, $personStatus)
{
    $model = new Person($personId, null, null, null, null, null, $personStatus);
    $result = $model->activatePerson();
    if($personStatus == 'Activa') 
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

//funcion para leer un registro q tengo una nacionalidad
function listPersonNationality($personIdnationality)
{
    $model = new Person(null, null, null, null, null, $personIdnationality, null);
    $personObject = $model->getPersonNationality();
    return $personObject;
}
?>
<?php
    require_once('../../Models/Nationality.php');

    //Funcion para listar todos los registros 
    function listNationalities()
    {
        $model = new Nationality(null, null);
        $nationalityList = $model->getNationalities();
        return $nationalityList;
    }

    //funcion para leer un registro
    function listNationality($nationalityId)
    {
        $model = new Nationality($nationalityId, null);
        $nationalityObject = $model->getNationality();
        return $nationalityObject;
    }

    //funcion para guardar el registro
    function burnNationality($nationalityId, $nationalityName, $nationalityNameCurrent)
    {
        //Validacion del nombre
        if (empty($nationalityName)) {
            $message = 'errorvacio';
        } else if (!preg_match("/^[a-zA-Zñ]+$/", $nationalityName)) {
            $message = 'errorformat';
        } else {
            $message = 'ok';
        }
        
        //No existe error en las entradas
        if ($message == 'ok')
        {
            $model = new Nationality($nationalityId, $nationalityName);
            
            if ($nationalityId > 0 )
            {
                //Editar Naionalidad
                if ($nationalityName == $nationalityNameCurrent )
                {
                    $message = 'samename'; 
                }else
                {
                    //Verificamos si el nombre de la nacionalidad no existe en la base 
                    $resultNationality = $model->getNationalityName();
                    if (empty($resultNationality))
                    {
                        $model = new Nationality($nationalityId, $nationalityName);
                        $result = $model->updateNationality();
                        if ($result == 1) {
                            $message = 'edited';
                        } else 
                        {
                            $message = 'errorredited';
                        }
                    }else
                    {
                        $message = 'errorname';
                    }
                }
            }else
            {
                //Crear Nacionalidad
                        
                //Verificamos si el nombre de la nacionalidad no existe en la base 
                $resultNationality = $model->getNationalityName();
                
                if (empty($resultNationality))
                {       
                    $model = new Nationality($nationalityId, $nationalityName);
                    $result = $model->saveNationality();
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

    //funcion para borrar el registro
    function eraseNationality($nationalityId)
    {
        $model = new Nationality($nationalityId, null);
        $result = $model->eliminateNationality();
        if ($result == 1) {
            $message = 'erased';
        } else {
            $message = 'errorrerased';
        }           
        return $message;
    }
?>

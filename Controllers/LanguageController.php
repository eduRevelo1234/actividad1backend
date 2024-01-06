<?php
require_once('../../Models/Language.php');

//funcion para listar todos los registros 
function listLanguages()
{
    $model = new Language(null, null, null);
    $languageList = $model->getLanguages();
    return $languageList;
}

//funcion para leer un registro
function listLanguage($languageId)
{
    $model = new Language($languageId, null, null);
    $languageObject = $model->getLanguage();
    return $languageObject;
}

//funcion para guardar el registro
function saveLanguage($languageId, $languageName, $languageIsocode, $languageNameCurrent, $languageIsocodeCurrent)
{
    //Validacion del nombre
    if (empty($languageName)) {
        $message = 'errorvacio';
    } else if (!preg_match("/^[a-zA-Zñ]+$/", $languageName)) {
        $message = 'errorformat';
    } else {
        $message = 'ok';
    }

    //Validacion del ISO code
    if (empty($languageIsocode)) {
        $message = 'errorvacio';
    } else if (!preg_match("/^[a-zA-Z]{2}$/", $languageIsocode)) {
        $message = 'errorformat';
    } else {
        $message = 'ok';
    }
    
    //No existe error en las entradas
    if ($message == 'ok')
    {
        $model = new Language($languageId, $languageName, $languageIsocode);
        if ($languageId > 0 )
        {
            //Editar Idioma
            if ($languageName == $languageNameCurrent )
            {
                $message = 'samename'; 
            }else if ($languageIsocode == $languageIsocodeCurrent )
            {
                $message = 'sameisocode'; 
            }else
            {
                //Verificamos si el nombre del idioma no existe en la base 
                $resultLanguage = $model->getLanguageName();
                if (empty($resultLanguage))
                {
                    //Verificamos si el ISO Code del idioma no existe en la base 
                    $resultLanguage = $model->getLanguageISOCode();
                    if (empty($resultLanguage))
                    {
                        $model = new Language($languageId, $languageName, $languageIsocode);
                        $result = $model->updateLanguage();
                        if ($result == 1) {
                            $message = 'edited';
                        } else 
                        {
                            $message = 'errorredited';
                        }
                    }else
                    {
                        $message = 'errorisocode';
                    }
                }else
                {
                    $message = 'errorname';
                }
            }
        }else
        {
            //Crear Idioma
                    
            //Verificamos si el nombre del idioma no existe en la base 
            $resultLanguage = $model->getLanguageName();
            
            if (empty($resultLanguage))
            {
                //Verificamos si el ISO Code del idioma no existe en la base 
                $resultLanguage = $model->getLanguageISOCode();
                if (empty($resultLanguage))
                {         
                    $model = new Language($languageId, $languageName, $languageIsocode);
                    $result = $model->saveLanguage();
                    if ($result > 0) {
                        $message = 'registered';
                    } else {
                        $message = 'errorregistered';
                    }
                }else
                {          
                    $message = 'errorisocode';
                }
            }else
            {
                $message = 'errorname';
            }
        }
    }  
     
    return $message;
}

//funcion para borrar el estado del registro
function eraseLanguage($languageId)
{
    $model = new Language($languageId, null, null);
    $result = $model->eliminateLanguage();
    if ($result == 1) {
        $message = 'erased';
    } else {
        $message = 'errorrerased';
    }           
    return $message;
}
?>
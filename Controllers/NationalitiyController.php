<?php
require_once(__DIR__ . '../../Models/Nationalities.php');
// Función para listar todos los registros de nacionalidades
function listNationalities()
{
    $model = new Nationalities(null, null);
    $nationalityList = $model->getNationalities();
    return $nationalityList;
}

// Función para leer un registro de nacionalidad por su ID
function getNationality($nationalityId)
{
    $model = new Nationalities($nationalityId, null);
    $nationalityObject = $model->getNationality();
    return $nationalityObject;
}

// Función para guardar o actualizar el registro de nacionalidad
function saveNationality($nationalityId, $nationalityName)
{
    // Validación del nombre de la nacionalidad
   if (empty($nationalityName)) {
      $message = 'errorvacio';
    } else {
      $model = new Nationalities($nationalityId, $nationalityName);
        if ($nationalityId > 0) {
            //Editar Nacionalidad
          $result = $model->updateNationality();
           $message = $result ? 'edited' : 'errorredited';
        } else {
            // Crear Nacionalidad
           $result = $model->saveNationality();
            $message = $result ? 'registered' : 'errorregistered';
        }
   }
  //$message = $nationalityId;
    return $message;
}

// Lógica para editar una nacionalidad
if(isset($_POST['editNationality'])) {
    if (isset($_POST['editNationalityId']) && isset($_POST['editNationalityName'])) {
        $editedNationalityId = $_POST['editNationalityId'];
        $editedNationalityName = $_POST['editNationalityName'];

        // Validar si la nacionalidad existe antes de intentar editarla
        $existingNationality = getNationality($editedNationalityId);
        if ($existingNationality) {
            $model = new Nationalities($editedNationalityId, $editedNationalityName);
            $edited = $model->updateNationality();

            if ($edited) {
                $editResult = 'edited'; // Éxito al editar la nacionalidad
            } else {
                $editResult = 'errorredited'; // Error al editar la nacionalidad
            }
        } else {
            $editResult = 'errornotfound'; // La nacionalidad no existe
        }
        // Manejo del resultado (mensaje de éxito o error)
    }
}
function eraseNationality($nationalityId)
{

  
    $model = new Nationalities($nationalityId, null);
    $result = $model->deleteNationality();
    echo "Entro a eraseNationality<br>";
    if ($result == 1) {
        
        $message = 'erased';
    } else {
        $message = 'errorrerased';
        echo "Entro a eraseNationality<br>";
    }           
    return $message;
}

// Lógica para eliminar una nacionalidad
if (isset($_POST['deleteNationality'])) {
    $deletedNationalityId = $_POST['deleteNationalityId'];
    $deleteResult = eraseNationality($deletedNationalityId);
    // Manejo del resultado (mensaje de éxito o error)
}
?>

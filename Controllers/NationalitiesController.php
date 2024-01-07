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
            // Editar Nacionalidad
            $result = $model->updateNationality($nationalityName);
            $message = $result ? 'edited' : 'errorredited';
        } else {
            // Crear Nacionalidad
            $result = $model->saveNationality();
            $message = $result ? 'registered' : 'errorregistered';
        }
    }
    
    return $message;
}

// Función para borrar el registro de nacionalidad
function eraseNationality($nationalityId)
{
    $model = new Nationalities($nationalityId, null);
    $result = $model->deleteNationality();
    $message = $result ? 'erased' : 'errorerased';
    return $message;
}

// Lógica para editar una nacionalidad
if(isset($_POST['editNationality'])) {
    if (isset($_POST['editNationalityId']) && isset($_POST['editNationalityName'])) {
        $editedNationalityId = $_POST['editNationalityId'];
        $editedNationalityName = $_POST['editNationalityName'];

        $editResult = saveNationality($editedNationalityId, $editedNationalityName);
        // Manejo del resultado (mensaje de éxito o error)
    }
}

// Lógica para eliminar una nacionalidad
if (isset($_POST['deleteNationality'])) {
    $deletedNationalityId = $_POST['deleteNationalityId'];
    $deleteResult = eraseNationality($deletedNationalityId);
    // Manejo del resultado (mensaje de éxito o error)
}
?>

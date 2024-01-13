<?php

require_once(__DIR__ .'../../Models/Person.php');

function listPeople()
{
    $personModel = new Person(null,null,null,null,null,null);
    $peopleList = $personModel->getPeople();
    return $peopleList;
}
function addPerson($name, $last_name, $code, $date_birth, $id_nationalities)
{
    try {
        // Validar los datos antes de crear una nueva persona
        validatePersonData($name, $last_name, $code, $date_birth, $id_nationalities);

        $personModel = new Person(null, $name, $last_name, $code, $date_birth, $id_nationalities);
        $added = $personModel->savePerson();

        if ($added) {
            return 'added';
        } else {
            return 'erroradding';
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
function validatePersonData($name, $last_name, $code, $date_birth, $id_nationalities)
{
    // Realizar validaciones según tus necesidades
    if (empty($name) || empty($last_name) || empty($code) || empty($date_birth) || empty($id_nationalities)) {
        throw new Exception('errormissingdata');
    }

    // Puedes agregar más validaciones según sea necesario
}
function editPerson($id, $name, $last_name, $code, $date_birth, $id_nationalities, $db)
{
    $personModel = new Person($id, $name, $last_name, $code, $date_birth, $id_nationalities);
    $edited = $personModel->savePerson();
    return $edited;
}

function deletePerson($id, $db)
{
    $personModel = new Person($id, null, null, null, null, null);
    $deleted = $personModel->deletePersonById($id);
    return $deleted;
}
// Otras funciones para manejar las operaciones de las personas
?>
<?php
require_once(__DIR__ . '/../../Models/Person.php');

// Verificar si se proporciona un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $personIdToDelete = $_GET['id'];

    // Crear una instancia de la clase Person
    $db = (new Query())->conectDb();
    $personInstance = new Person($db);

    try {
        // Llamar a la función para eliminar la persona
        $result = $personInstance->deletePersonById($personIdToDelete);


        if ($result) {
            echo "La persona se eliminó correctamente.";
        } else {
            echo "Hubo un error al eliminar la persona.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de persona no proporcionado o no válido.";
}
?>

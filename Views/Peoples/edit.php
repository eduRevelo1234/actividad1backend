<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');
require_once(__DIR__ . '/../../Models/Nationality.php');
require_once(__DIR__ . '/../../Models/Person.php');

// Verificar si se proporciona un ID válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $personId = $_GET['id'];

    // Crear una instancia de la clase Person
    $db = (new Query())->conectDb();
    $personInstance = new Person($db);

    // Obtener los detalles de la persona por ID
    $person = $personInstance->getPersonById($personId);

    // Verificar si la persona existe
    if ($person) {
        // Lógica para actualizar los datos de la persona si se envía el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $name = $_POST['nombre'];
            $last_name = $_POST['apellido'];
            $code = $_POST['code'];
            $date_birth = $_POST['fecha_nacimiento'];
            $id_nationalities = $_POST['id_nacionalidad'];

            // Actualizar los datos de la persona
            $person->setName($name);
            $person->setLastName($last_name);
            $person->setcode($code);
            $person->setDateOfBirth($date_birth);
            $person->setIdNationalities($id_nationalities);

            // Guardar los cambios en la base de datos
            $result = $personInstance->savePerson();

            if ($result) {
                echo "Los detalles de la persona se actualizaron correctamente.";
            } else {
                echo "Hubo un error al actualizar los detalles de la persona.";
            }
        }
    } else {
        echo "No se encontró ninguna persona con el ID proporcionado.";
    }
} else {
    echo "ID de persona no proporcionado o no válido.";
}
?>

<!-- Agregar el formulario para editar los detalles de la persona -->
<div style="border: 1px solid #ccc; padding: 20px; margin-top: 20px; background-color: #f9f9f9;">
    <h2>Editar Detalles de la Persona</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $personId; ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $person->getName(); ?>" required>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $person->getLastName(); ?>" required>
        <label for="code">Código:</label>
        <input type="text" id="code" name="code" value="<?php echo $person->getCode(); ?>" required>
        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $person->getDateOfBirth(); ?>" required>

        <!-- Agregar la lista desplegable con las opciones de nacionalidades -->
        <label for="id_nacionalidad">Seleccionar Nacionalidad:</label>
        <select id="id_nacionalidad" name="id_nacionalidad">
            <?php
            $nationalitiesController = new Nationalities($dd, null);
            $searchResults = $nationalitiesController->getNationalities();
            
            if (!empty($searchResults)) {
                foreach ($searchResults as $nationality) {
                    $selected = ($nationality->getId() == $person->getIdNationalities()) ? 'selected' : '';
            ?>
                    <option value="<?php echo $nationality->getId(); ?>" <?php echo $selected; ?>><?php echo $nationality->getName(); ?></option>
            <?php
                }
            } else {
                echo "<option value=''>No hay nacionalidades disponibles</option>";
            }
            ?>
        </select>

        <button type="submit">Actualizar Detalles</button>
    </form>
</div>
<?php
include_once(__DIR__ . '/../Templates/Footer.php');
?>

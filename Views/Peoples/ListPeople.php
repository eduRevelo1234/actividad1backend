<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');
require_once(__DIR__ . '/../../Models/Nationality.php');
require_once(__DIR__ . '/../../Models/Person.php');
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

//echo "ListPeople: creando objeto Query <br/>";
$querys = new Query();
/*if( is_null($querys) ){
	echo "ListPeople: Objeto querys vacio <br/>";
}else{
	echo "ListPeople: Objeto querys listo <br/>";	
}*/

//echo "ListPeople: creando objeto db <br/>";
$db = $querys->conectDb(); // Obtener la conexión existente
/*if( is_null($db) ){
	echo "ListPeople: Objeto db vacio <br/>";
}else{
	echo "ListPeople: Objeto db listo <br/>";	
}*/

//echo "ListPeople: creando objeto Nacionalities <br/>";
$nationalitiesInstance = new Nationalities($db, null); // Reemplaza $db con tu conexión a la base de datos
/*if( is_null($nationalitiesInstance) ){
	echo "ListPeople: Objeto nationalitiesInstance vacio <br/>";
}else{
	echo "ListPeople: Objeto nationalitiesInstance listo <br/>";	
}*/
$personIntance = new Person($db);
/*if( is_null($personIntance) ){
	echo "ListPeople: Objeto personIntance vacio <br/>";
}else{
	echo "ListPeople: Objeto personIntance listo <br/>";	
}*/
$peopleList = $personIntance->getPeople();


// Lógica para agregar una nueva persona
//echo "ListPeople: tipo de request: ".$_SERVER["REQUEST_METHOD"]." <br/>";
//echo "Datos recibidos: ".$_POST['nombre'].$_POST['apellido'].", ".$_POST['code'].", ".$_POST['fecha_nacimiento'].", ".$_POST['id_nacionalidad']." <br/>";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre'], $_POST['apellido'], $_POST['code'], $_POST['fecha_nacimiento'], $_POST['id_nacionalidad'])) {
	//echo "ListPeople: intentando guardar datos nuevos";
    $name = $_POST['nombre'];
    $last_name = $_POST['apellido'];
    $code= $_POST['code'];
    $date_birth = $_POST['fecha_nacimiento'];
    $id_nationalities = $_POST['id_nacionalidad'];
	//echo "intento agregar datos de ".$_POST['nombre'];
    //$added = addPerson($name, $last_name, $code, $date_birth, $id_nationalities);
	$added = $personIntance->savePersonFull($name, $last_name, $code, $date_birth, $id_nationalities);
    if ($added) {
        echo "La persona se agregó correctamente.";
        // Redireccionar a la misma página para actualizar la lista de personas
        //header("Location: {$_SERVER['REQUEST_URI']}");
        //exit();
    } else {
        echo "Hubo un error al agregar la persona.";
    }
}
	//echo "ListPeople: intentando cargar lista";


// Obtener la lista de nacionalidades
$searchResults = $nationalitiesInstance->getNationalities();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lista de Personas</title>
    <!-- Agregar enlaces a CSS, Bootstrap, etc. -->
</head>

<body>
    <h1 style="color: white;">Lista de Personas</h1>

    <!-- Contenedor para el formulario de agregar nueva persona -->
    <div style="border: 1px solid #ccc; padding: 20px; margin-top: 20px; background-color: #f9f9f9;">
        <h2>Agregar Nueva Persona</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <label for="code">Código:</label>
            <input type="text" id="code" name="code" required>
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>

            <label for="id_nacionalidad">Seleccionar Nacionalidad:</label>
            <select id="id_nacionalidad" name="id_nacionalidad">
                <?php if (!empty($searchResults)) {
                    foreach ($searchResults as $nationality) { ?>
                        <option value="<?php echo $nationality->getId(); ?>"><?php echo $nationality->getName(); ?></option>
                <?php }
                } else {
                    echo "<option value=''>No hay nacionalidades disponibles</option>";
                } ?>
            </select>

            <button type="submit">Agregar Persona</button>
        </form>
    </div>

    <!-- Tabla que mostrará la lista de personas -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Código</th>
                <th>Fecha de Nacimiento</th>
                <th>ID Nacionalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peopleList as $person) { ?>
                <tr>
                    <td><?php echo $person->getId(); ?></td>
                    <td><?php echo $person->getName(); ?></td>
                    <td><?php echo $person->getLastName(); ?></td>
                    <td><?php echo $person->getCode(); ?></td>
                    <td><?php echo $person->getDateOfBirth(); ?></td>
                    <td><?php echo $person->getIdNationalities(); ?></td>
                    <td>
                        <a href="Edit.php?id=<?php echo $person->getId(); ?>">Editar</a>
                        &nbsp;
                        <a href="Delete.php?id=<?php echo $person->getId(); ?>">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>

</html>
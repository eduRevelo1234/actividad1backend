<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');

/// Instanciar la clase Nationalities para manejar la lógica de la base de datos
$nationalitiesInstance = new Nationalities(null, null);



// Lógica para agregar una nueva nacionalidad
if(isset($_POST['addNationality'])) {
    $newNationalityName = $_POST['newNationalityName'];

    // Verificar si la nacionalidad ya existe
    $nationalitiesInstance->setName($newNationalityName);
    $existingNationality = $nationalitiesInstance->getNationalityByName();

    if ($existingNationality) {
        // La nacionalidad ya existe, mostrar mensaje o redirigir con error
        $addMessage = 'La nacionalidad ya existe en la base de datos.';
        // Puedes redirigir o mostrar un mensaje de error aquí
        // header("Location: {$_SERVER['REQUEST_URI']}");
        // exit();
    } else {
        // La nacionalidad no existe, proceder a agregarla
        $nationalitiesInstance->setName($newNationalityName);
        $added = $nationalitiesInstance->saveNationality();

        // Mensaje de éxito o error
        $addMessage = $added ? '¡Nueva nacionalidad agregada correctamente!' : 'Error al agregar la nacionalidad.';
        // Redireccionar a la misma página para actualizar el listado
        //header("Location: {$_SERVER['REQUEST_URI']}");
        //exit();
    }
}

// Lógica para editar una nacionalidad
if(isset($_POST['editNationality'])) {
    $editedNationalityId = $_POST['editNationalityId'];
    $editedNationalityName = $_POST['editNationalityName'];

    // Procesar la edición aquí utilizando los datos recibidos
    $nationalitiesInstance->setId($editedNationalityId);
    $nationalitiesInstance->setName($editedNationalityName);
    $edited = $nationalitiesInstance->saveNationality();

    // Mensaje de éxito o error
    $editMessage = $edited ? '¡Nacionalidad editada correctamente!' : 'Error al editar la nacionalidad.';
    //header("Location: {$_SERVER['REQUEST_URI']}");
    //exit();
}


// Lógica para eliminar una nacionalidad
if(isset($_POST['deleteNationality'])) {
    $deletedNationalityId = $_POST['deleteNationalityId'];
    $nationalitiesInstance->setId($deletedNationalityId);
    $deleted = $nationalitiesInstance->deleteNationality();
    

    // Mensaje de éxito o error
    $deleteMessage = $deleted ? '¡Nacionalidad eliminada correctamente!' : 'Error al eliminar la nacionalidad.';
    
    // Redireccionar a la misma página para actualizar el listado
    //header("Location: {$_SERVER['PHP_SELF']}");
    //exit();
}
// Lógica para la búsqueda
$searchResults = array();
if(isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
    echo "Término de búsqueda: " . $searchTerm . "<br>";

    $nationalityList = $nationalitiesInstance->getNationality();
    foreach ($nationalityList as $nationality) {
        if (stristr($nationality->getName(), $searchTerm) !== false) {
            $searchResults[] = $nationality;
            echo "Coincidencia encontrada: " . $nationality->getName() . "<br>";
        }
    }
} else {
    // Si no se realiza una búsqueda, mostrar todas las nacionalidades
    $searchResults = $nationalitiesInstance->getNationalities();
}
?>


?>

<!-- HTML para mostrar el listado y la opción de búsqueda -->
<!-- Incluir estilos CSS y estructura de la página -->

<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE NACIONALIDADES</h1>
            <p>Se muestran las nacionalidades de series y películas</p>
        </div>
        <div class="card-body">
           
            <!-- Mensajes de éxito o error -->
            <?php if (!empty($addMessage)) { ?>
                <div class="alert <?php echo ($added ? 'alert-success' : 'alert-danger'); ?> mt-3" role="alert">
                    <?php echo $addMessage; ?>
                </div>
            <?php } ?>

            <?php if (!empty($editMessage)) { ?>
                <div class="alert <?php echo ($edited ? 'alert-info' : 'alert-danger'); ?> mt-3" role="alert">
                    <?php echo $editMessage; ?>
                </div>
            <?php } ?>

            <?php if (!empty($deleteMessage)) { ?>
                <div class="alert <?php echo ($deleted ? 'alert-danger' : 'alert-danger'); ?> mt-3" role="alert">
                    <?php echo $deleteMessage; ?>
                </div>
            <?php } ?>

            <!-- Formulario para agregar una nueva nacionalidad -->
            <div class="mt-4">
                <h2>Agregar Nueva Nacionalidad</h2>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="newNationalityName" class="form-label">Nombre de la Nacionalidad:</label>
                        <input type="text" class="form-control" id="newNationalityName" name="newNationalityName" placeholder="Ingrese el nombre" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="addNationality">Agregar</button>
                </form>
            </div>

            <hr>
            <h2>Listado de Nacionalidades</h2>
            <form method="post" action="">
				<div class="mb-3">
					<label for="searchTerm" class="form-label">Buscar Nacionalidad:</label>
					<input type="text" class="form-control" id="searchTerm" name="searchTerm" placeholder="Ingrese un país" required>
				</div>
				<button type="submit" class="btn btn-primary" name="search">Buscar</button>
			</form>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th> <!-- Columna para las acciones -->
        </tr>
    </thead>
    <tbody>
    <?php foreach ($searchResults as $nationality) { ?>
        <tr>
            <!-- Mostrar detalles de la nacionalidad -->
            <td><?php echo $nationality->getId(); ?></td>
            <td><?php echo $nationality->getName(); ?></td>
            <td>
                <!-- Enlace para editar -->
                <a class="btn btn-primary" href="ediNatio.php?id=<?php echo $nationality->getId(); ?>"> Editar</a>
                <!-- Enlace para eliminar -->
                <a class="btn btn-danger" href="eraseNatio.php?id=<?php echo $nationality->getId(); ?>">Eliminar</a>

            </td>
        </tr>
    <?php } ?>
</tbody>
</table>
        </div>
    </div>
</div>

<?php
include_once(__DIR__ . '/../Templates/Footer.php');
?>
<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalitiesController.php');


// Obtener el ID de la nacionalidad desde la URL si está presente y no está vacío
$idNationality = $_GET['id'] ?? null;

// Inicializar la instancia de la nacionalidad como null
$nationalityInstance = null;

// Variable para manejar el envío de datos y la eliminación
$sendData = false;
$nationalityResult = '';

var_dump($idNationality); // Verifica el valor de $idNationality obtenido de la URL

$nationalityInstance = getNationality($idNationality);
var_dump($nationalityInstance); // Verifica la instancia de nacionalidad recuperada

// Habilitar la notificación de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($idNationality !== null) {
    // Obtener la instancia de la nacionalidad por su ID
    $nationalityInstance = getNationality($idNationality);

    // Verificar si se envió el formulario para borrar
    if (isset($_POST['eraseBtn'])) {
        $sendData = true;

        // Si se envió el formulario, eliminar la nacionalidad por su ID
        $nationalityResult = eraseNationality($idNationality);
    }
}
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php if ($nationalityInstance !== null) : ?>
        <?php if (!$sendData) : ?>
            <div class="card">
                <div class="card-header text-center">
                    <h1>BORRAR UNA NACIONALIDAD</h1>
                </div>
                <div class="card-body">
                    <form name="delete_nationality" action="" method="POST">
                        <h3 class="text-center">
                            ¿Está seguro de borrar la nacionalidad <?php echo $nationalityInstance['name']; ?>?
                        </h3>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="submit" value="Borrar" class="btn btn-success" name="eraseBtn">
                            <br>
                            <a class="btn btn-danger" href="ListNationalities.php">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        <?php else : ?>
            <?php if ($nationalityResult === 'erased') : ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    ¡La nacionalidad se borró exitosamente!
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="ListNationalities.php">
                            Regresar
                        </a>
                    </div>
                </div>
            <?php else : ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    ¡Hubo un error al borrar la nacionalidad!
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="ListNationalities.php">
                            Regresar
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-danger" role="alert">
            ¡No se encontró la nacionalidad!
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-primary" href="ListNationalities.php">
                    Regresar
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

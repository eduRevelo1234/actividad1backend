<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');



// Obtener el objeto de nacionalidad
$nationalityObject = getNationality($nationalityId);

// Procesar el borrado si se envían datos
if (isset($_POST['eraseBtn'])) {
    try {
        // Intentar eliminar la nacionalidad
        $nationalityResult = eraseNationality($nationalityId);

        // Mostrar mensajes de depuración
        echo "ID de Nacionalidad: " . $nationalityObject->getId() . "<br>";
        echo "Resultado del borrado: " . $nationalityResult . "<br>";
    } catch (Exception $e) {
        echo "Error al intentar eliminar la Nacionalidad: " . $e->getMessage();
    }
}
?>

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>BORRAR UNA NACIONALIDAD</h1>
        </div>
        <div class="card-body">
            <?php if (!isset($_POST['eraseBtn'])) { ?>
                <form name="eraseNatio" action="" method="POST">
                    <h3 class="text-center">
                        ¿Desea borrar la Nacionalidad
                    </h3>

                    <h3 class="text-center">
                        <?php if ($nationalityObject instanceof Nationalities) echo $nationalityObject->getName(); ?>?
                    </h3>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="submit" value="Borrar" class="btn btn-success" name="eraseBtn">
                        <br>
                        <a class="btn btn-danger" href="ListNationalities.php">Regresar</a>
                    </div>
                </form>
            <?php } else { ?>
                <?php switch ($nationalityResult) {
                    case 'erased': ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Nacionalidad fue borrada exitosamente!
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="ListNationalities.php">
                                    Regresar
                                </a>
                            </div>
                        </div>
                    <?php break;
                    case 'errorerased': ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Hubo un error en el borrado de la Nacionalidad!
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="ListNationalities.php">
                                    Regresar
                                </a>
                            </div>
                        </div>
                    <?php break;
                } ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php
include_once(__DIR__ . '/../Templates/Footer.php');
?>

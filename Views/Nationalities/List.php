<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');

// Instanciar la clase Nationality para manejar la lógica de la base de datos
$nationalitiesInstance = new Nationality(null, null);
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

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE NACIONALIDADES</h1>
            <p>Se podra crear, actualizar o borrar/suspender una nacionalidad</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="View.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $nationalityList = listNationalities();
            if (count($nationalityList) > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($nationalityList as $nationality) {
                        ?>
                            <tr>
                                <td><?php echo $nationality->getId(); ?> </td>
                                <td><?php echo $nationality->getName(); ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="View.php?id=<?php echo $nationality->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="Erase.php?id=<?php echo $nationality->getId(); ?>">
                                            Borrar
                                        </a>
                                    </div>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    No existen registros
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Fin Contenido -->

<?php
    
    include_once(__DIR__ . '/../Templates/Footer.php');
?>

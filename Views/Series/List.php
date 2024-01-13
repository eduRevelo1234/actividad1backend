<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SerieController.php');
require_once('../../Controllers/PlatformController.php');
?>

<!-- Contenido -->
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE SERIES</h1>
            <p>Se podra crear, actualizar o borrar series</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="NewSerie.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $serieList = listSeries();
            if (count($serieList) > 0) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Plataforma</th>
                            <th>Director</th>
                            <th>Año de lanzamiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($serieList as $serie) {
                            $idPlatform = $serie->getIdPlatform();
                            $platformObject = listPlatform($idPlatform);
                            ?>
                            <tr>
                                <td>
                                    <?php echo $serie->getId(); ?>
                                </td>
                                <td>
                                    <?php echo $serie->getTitle(); ?>
                                </td>
                                <td>
                                    <?php if (!empty($platformObject)) {
                                        echo $platformObject['name'];
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $serie->getIdDirector(); ?>
                                </td>
                                <td>
                                    <?php echo $serie->getPremierYear(); ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="NewSerie.php?id=<?php echo $serie->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="DeleteSerie.php?id=<?php echo $serie->getId(); ?>">
                                            Eliminar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-secondary" href="#">
                                            ver mas
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
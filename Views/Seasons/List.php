<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SerieController.php');
require_once('../../Controllers/SeasonController.php');
?>

<!-- Contenido -->
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE TEMPORADAS</h1>
            <p>Se podra crear, actualizar o borrar temporadas de series</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="NewSerie.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $seasonList = listSeasons();
            if (count($seasonList) > 0) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Id serie</th>
                            <th>Serie</th>
                            <th>Numero</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($seasonList as $season) {
                            $idSerie = $season->getIdSerie();
                            echo "<script>console.log('$idSerie');</script>";
                            $serieObject = findSerie($idSerie);
                            echo "<script>console.log(" . json_encode($serieObject) . ");</script>";
                            ?>
                            <tr>
                                <td>
                                    <?php echo $season->getId(); ?>
                                </td>
                                <td>
                                    <?php echo $season->getIdSerie(); ?>
                                </td>
                                <td>
                                    <?php if (!empty($serieObject)) {
                                        echo $serieObject['title'];
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $season->getNumber(); ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="NewSerie.php?id=<?php echo $season->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="DeleteSerie.php?id=<?php echo $season->getId(); ?>">
                                            Eliminar
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
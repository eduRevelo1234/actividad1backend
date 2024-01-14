<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SerieController.php');
require_once('../../Controllers/SeasonController.php');
require_once('../../Controllers/ChapterController.php');
?>
<!-- Contenido -->
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE EPISODIOS</h1>
            <p>Se podra crear, actualizar o borrar episodios de una temporada</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="NewChapter.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $chapterList = listChapters();
            if (count($chapterList) > 0) {
                ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Serie</th>
                            <th>Temporada</th>
                            <th>Numero de episodio</th>
                            <th>Titulo</th>
                            <th>Duaracion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($chapterList as $chapter) {
                            $idSeason = $chapter->getIdSeason();
                            $seasonObject = findSeason($idSeason);
                            $idSerie = $seasonObject['id_serie'];
                            $serieObject = listSerie($idSerie);
                            ?>
                            <tr>
                                <td>
                                    <?php echo $chapter->getId(); ?>
                                </td>
                                <td>
                                    <?php if (!empty($serieObject)) {
                                        echo $serieObject['title'];
                                    } ?>
                                </td>
                                <td>
                                    <?php if (!empty($seasonObject)) {
                                        echo $seasonObject['number'];
                                    } ?>
                                </td>
                                <td>
                                    <?php echo $chapter->getNumber(); ?>
                                </td>
                                <td>
                                    <?php echo $chapter->getTitle(); ?>
                                </td>
                                <td>
                                    <?php echo $chapter->getDuration(); ?>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="NewChapter.php?id=<?php echo $chapter->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="DeleteChapter.php?id=<?php echo $chapter->getId(); ?>">
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
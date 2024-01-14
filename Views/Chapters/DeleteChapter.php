<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SeasonController.php');
require_once('../../Controllers/ChapterController.php');
require_once('../../Controllers/SerieController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
    $idChapter = $_GET['id'];
    $chapterObject = findChapter($idChapter);
    $seasonObject = findSeason($chapterObject['id_season']);
    $serieObject = findSerie($seasonObject['id_serie']);
    $sendData = false;

    if (isset($_POST['deleteBtn'])) {
        $sendData = true;
    }
    if ($sendData) {
        if (isset($chapterObject)) {
            $platformResult = deleteChapter($chapterObject['id']);
        }
    }
    if (!$sendData) {
        ?>
        <div class="card">
            <div class="card-header text-center">
                <h1>ELIMINAR EPISODIO</h1>
            </div>
            <div class="card-body">
                <form name="delete_serie" action="" method="POST">
                    <h3 class="text-center">
                        Desea eliminar el episodio
                    </h3>
                    <h3 class="text-center">
                        <?php if (isset($chapterObject))
                            echo $chapterObject['number']; ?> de la temporada
                        <?php if (isset($seasonObject))
                            echo $seasonObject['number']; ?> de la serie
                        <?php if (!empty($serieObject)) {
                            echo $serieObject['title'];
                        } ?> ?
                    </h3>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-secondary" href="List.php">Regresar</a>
                        <br>
                        <input type="submit" value="Eliminar" class="btn btn-danger" name="deleteBtn">
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        ?>
        <?php
        switch ($platformResult) {
            case 'okDelete':
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    La serie fue eliminada exitosamente !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'errorDelete':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Hubo al eliminar la serie !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
        }
        ?>
    </div>
    <?php
    }
    ?>
</div>
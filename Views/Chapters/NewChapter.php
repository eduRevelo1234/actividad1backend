<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SerieController.php');
require_once('../../Controllers/SeasonController.php');
require_once('../../Controllers/PlatformController.php');
require_once('../../Controllers/ChapterController.php');
?>
<div class="container mt-4">
    <?php
    $idChapter = null;
    $idSeason = null;
    $serie = null;
    $season = null;
    if (isset($_GET['id']) && $_GET['id'] !== null) {
        $idChapter = $_GET['id'];
        $chapter = findChapter($idChapter);
        $idSeason = $chapter['id_season'];
        $season = findSeason($idSeason);
        $idserie = $season['id_serie'];
        $serie = listSerie($idserie);
    }
    $sendData = false;
    $chapterResult = false;
    if (isset($_POST['saveBtn'])) {
        $sendData = true;
        if (isset($_POST['idSeason']) && isset($_POST['number'])) {
            $chapterResult = insertChapter(
                $_POST['number'],
                $_POST['title'],
                $_POST['duration'],
                $_POST['idSeason']
            );
        } else {
            $chapterResult = "emptyerror";
        }
    }
    if (isset($_POST['editBtn'])) {
        $sendData = true;
        if (isset($_POST['idSeason']) && isset($_POST['number'])) {
            $chapterResult = editChapter(
                $idChapter,
                $_POST['number'],
                $_POST['title'],
                $_POST['duration'],
                $_POST['idSeason']
            );
        } else {
            $chapterResult = "emptyerror";
        }
    }
    if (!$sendData) {
        ?>
        <div class="card mx-auto">
            <div class="card-header text-center">
                <?php
                if (null !== $idSeason) {
                    ?>
                    <h1>EDICION DE UN CAPITULO</h1>
                    <?php
                } else {
                    ?>
                    <h1>CREACION DE NUEVO CAPITULO</h1>
                    <?php
                }
                ?>
            </div>
            <div class="card-body">
                <form name="create_serie" action="" method="POST">
                    <?php
                    if (null !== $idChapter) {
                        ?>
                        <div class="form-group row offset-2">
                            <label for="idSerie" class="col-3 col-form-label">Serie</label>
                            <div class="col-5">
                                <select id="idSerie" name="idSerie" class="form-control" disabled>
                                    <?php
                                    if (null !== $serie) {
                                        echo "<option value='" . $serie['id'] . "'>" . $serie['title'] . "</option>";
                                    } else {
                                        ?>
                                        <option value="" disabled selected>Selecciona una serie</option>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                    $serieList = listSeries();
                                    foreach ($serieList as $serieOption) {
                                        echo "<option value='" . $serieOption->getId() . "'>" . $serieOption->getTitle() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group row margin-top offset-2">
                        <label for="idSeason" class="col-3 col-form-label">Id de temporada</label>
                        <div class="col-1">
                            <input id="idSeason" name="idSeason" type="text" required class="form-control" placeholder="Id" value="<?php if (isset($season))
                                echo $season['id']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="number" class="col-3 col-form-label">Numero de episodio</label>
                        <div class="col-2">
                            <input id="number" name="number" type="text" required class="form-control" placeholder="Episodio" value="<?php if (isset($chapter))
                                echo $chapter['number']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="title" class="col-3 col-form-label">Titulo</label>
                        <div class="col-5">
                            <input id="title" name="title" type="text" required class="form-control" placeholder="Titulo de episodio"
                                value="<?php if (isset($chapter))
                                    echo $chapter['title']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="duration" class="col-3 col-form-label">Duracion</label>
                        <div class="col-2">
                            <input id="duration" name="duration" type="text" required class="form-control" placeholder="Duracion" value="<?php if (isset($chapter))
                                echo $chapter['duration']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top">
                        <div class="offset-6">
                            <a class="btn btn-secondary mb-2" href="List.php">Regresar</a>
                            <input class="btn btn-primary mb-2" type="submit" value="Guardar" name=<?php if (null !== $idChapter) {
                                echo "editBtn";
                            } else {
                                echo "saveBtn";
                            } ?>>
                        </div>
                    </div>
                    <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>">
                    <input type="hidden" name="platformNameCurrent" value="<?php echo $platformObject['name']; ?>">
                </form>
            </div>
        </div>
        <?php
    } else {
        switch ($chapterResult) {
            case 'ok':
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    El episodio se creo exitosamente !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'exist':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Ya existe ese episodio para la temporada de esa serie!
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'emptyerror':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Debe llenar todos los campos!
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'okUpdate':
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    El episodio se edito exitosamente !
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
<!-- Fin Contenido -->
<?php
include_once(__DIR__ . '/../Templates/Footer.php');
?>
<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once('../../Controllers/SerieController.php');
require_once('../../Controllers/PlatformController.php');
?>
<div class="container mt-4">
    <?php
    $idserie = null;
    $serie = null;
    if (isset($_GET['id']) && $_GET['id'] !== null) {
        $idserie = $_GET['id'];
        $serie = findSerie($idserie);
    }
    $sendData = false;
    $serieResult = false;
    if (isset($_POST['saveBtn'])) {
        $sendData = true;
        if (isset($_POST['title'])) {
            $serieResult = insertSerie(
                $_POST['title'],
                $_POST['idDirector'],
                $_POST['idPlatform'],
                $_POST['premierYear']
            );
        }
    }
    if (isset($_POST['editBtn'])) {
        $sendData = true;
        if (isset($_POST['title'])) {
            $serieResult = editSerie(
                $idserie,
                $_POST['title'],
                $_POST['idDirector'],
                $_POST['idPlatform'],
                $_POST['premierYear']
            );
        }
    }
    if (!$sendData) {
        ?>
        <div class="card mx-auto">
            <div class="card-header text-center">
                <?php
                if (null !== $idserie) {
                    ?>
                    <h1>EDICION DE UNA PLATAFORMA</h1>
                    <?php
                } else {
                    ?>
                    <h1>CREACION DE NUEVA SERIE</h1>
                    <?php
                }
                ?>
            </div>
            <div class="card-body">
                <form name="create_serie" action="" method="POST">
                    <div class="form-group row offset-2">
                        <label for="title" class="col-3 col-form-label">Titulo</label>
                        <div class="col-5">
                            <input id="title" name="title" type="text" class="form-control" placeholder="Titulo" value="<?php if (isset($serie))
                                echo $serie['title']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="idDirector" class="col-3 col-form-label">ID director</label>
                        <div class="col-1">
                            <input id="idDirector" name="idDirector" type="text" class="form-control" placeholder="Id"
                                value="<?php if (isset($serie))
                                    echo $serie['id_director']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="idPlatform" class="col-3 col-form-label">ID Plataforma</label>
                        <div class="col-1">
                            <input id="idPlatform" name="idPlatform" type="text" class="form-control" placeholder="Id"
                                value="<?php if (isset($serie))
                                    echo $serie['id_platform']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top offset-2">
                        <label for="premierYear" class="col-3 col-form-label">Año de lanzamiento</label>
                        <div class="col-2">
                            <input id="premierYear" name="premierYear" type="text" class="form-control" placeholder="Año"
                                value="<?php if (isset($serie))
                                    echo $serie['premiere_year']; ?>">
                        </div>
                    </div>
                    <div class="form-group row margin-top">
                        <div class="offset-6">
                            <a class="btn btn-secondary mb-2" href="List.php">Regresar</a>
                            <input class="btn btn-primary mb-2" type="submit" value="Guardar" name=<?php if (null != $idserie) {
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
        echo "<script> console.log('$serieResult'); </script>";
        switch ($serieResult) {
            case 'ok':
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    La Plataforma se creo exitosamente !
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
                    El nombre de la Serie ya existe !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'errorformat':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Existe error de formato en una de los campos!
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
                    El campo titulo es obligatorio!
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
                    La Serie se edito exitosamente !
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
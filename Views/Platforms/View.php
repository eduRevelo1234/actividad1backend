<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
    $idPlatform = isset($_GET['id']) ? $_GET['id'] : 0;
    $platformObject = listPlatform($idPlatform);
    $sendData = false;
    $platformResult = false;

    if (isset($_POST['saveBtn'])) {
        $sendData = true;
    }
    if ($sendData) {
        if (isset($_POST['platformName'])) {
            $platformResult = burnPlatform($_POST['platformId'], $_POST['platformName'], $_POST['platformNameCurrent']);
        }
    }
    if (!$sendData) {
        ?>
        <div class="card">
            <div class="card-header text-center">
                <?php
                if ($idPlatform > 0) {
                    ?>
                    <h1>EDICION DE UNA PLATAFORMA</h1>
                    <?php
                } else {
                    ?>
                    <h1>CREACION DE UNA NUEVA PLATAFORMA</h1>
                    <?php
                }
                ?>
            </div>
            <div class="card-body">
                <form name="create_platform" action="" method="POST">
                    <div class="form-floating mb-3">
                        <input id="platformName" name="platformName" type="text" required class="form-control"
                            placeholder="name@example.com" value="<?php if (isset($platformObject['name']))
                                echo $platformObject['name']; ?>" autocomplete="off">
                        <label for="platformName">Nombre de la Plataforma</label>
                    </div>

                    <input type="hidden" name="platformId" value="<?php echo $idPlatform; ?>">
                    <input type="hidden" name="platformNameCurrent" value="<?php if (isset($platformObject['name']))
                        echo $platformObject['name']; ?>">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="submit" value="Guardar" class="btn btn-success" name="saveBtn">
                        <br>
                        <a class="btn btn-danger" href="List.php">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
    } else {
        ?>
        <?php

        switch ($platformResult) {
            case 'errorvacio':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    El nombre de la Plataforma no debe estar vacio !
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
                    El nombre de la Plataforma solo debe contener letras !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'registered':
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
            case 'errorregistered':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Hubo un error en la creacion de la Plataforma !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'edited':
                ?>
                <div class="alert alert-success" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    La Plataforma se edito exitosamente !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'errorredited':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    Hubo un error en la edicion de la Plataforma !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'errorname':
                ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-x-circle-fill"></i>
                    El nombre de la Plataforma ya existe !
                    <br>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a class="btn btn-primary" href="List.php">
                            Regresar
                        </a>
                    </div>
                </div>
                <?php
                break;
            case 'samename':
                ?>
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    El nombre del Idioma es el mismo !
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
<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idNationality = isset($_GET['id']) ? $_GET['id'] : 0;
        $nationalityObject = listNationality($idNationality);
        $sendData = false;
        $nationalityResult = false;
        
        if (isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if ($sendData) 
        {
            if (isset($_POST['nationalityName'])) 
            {
                $nationalityResult = burnNationality($_POST['nationalityId'], $_POST['nationalityName'],$_POST['nationalityNameCurrent']);
            }
        }
        if (!$sendData) 
        {
    ?>
            <div class="card">
                <div class="card-header text-center">
                    <?php
                        if ($idNationality > 0) 
                        {
                    ?>
                        <h1>EDICION DE UNA NACIONALIDAD</h1>
                    <?php
                        } else 
                        {
                    ?>
                        <h1>CREACION DE UNA NUEVA NACIONALIDAD</h1>
                    <?php
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_nationality" action="" method="POST">
                        <div class="form-floating mb-3">
                            <input id="nationalityName" name="nationalityName" type="text" class="form-control" placeholder="Country Name" value="<?php if (isset($nationalityObject['name'])) echo $nationalityObject['name']; ?>" autocomplete="off">
                            <label for="nationalityName">Nombre de la Nacionalidad</label>
                        </div>

                        <input type="hidden" name="nationalityId" value="<?php if (isset($nationalityObject['id'])) echo $nationalityObject['id']; ?>">
                        <input type="hidden" name="nationalityNameCurrent" value="<?php if (isset($nationalityObject['name'])) echo $nationalityObject['name']; ?>">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="submit" value="Guardar" class="btn btn-success" name="saveBtn">
                            <br>
                            <a class="btn btn-danger" href="List.php">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
    <?php
        } else 
        {
    ?>
            <?php
                switch ($nationalityResult) {
                case 'errorvacio':
            ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Nacionalidad no debe estar vacío !
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
                            El nombre de la Nacionalidad solo debe contener letras !
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
                            La Nacionalidad se creó exitosamente !
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
                            Hubo un error en la creación de la Nacionalidad !
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
                            La Nacionalidad se editó exitosamente !
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
                            Hubo un error en la edición de la Nacionalidad !
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
                            El nombre de la Nacionalidad ya existe ! 
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
                            El nombre de la Nacionalidad es el mismo que uno existente !
                            <br>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>
                        </div>
            <?php
                        break;
                    defaul:
            ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            Es una prueba !
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
<?php
include_once(__DIR__ . '/../Templates/Footer.php');
?>
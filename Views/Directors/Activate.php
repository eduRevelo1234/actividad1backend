<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/DirectorController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idDirector = $_GET['id'];
        $directorObject = listDirector($idDirector);
        $sendData = false;
        $directorActived = false;
        if(isset($_POST['activeBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            if(isset($directorObject)) {
                if($directorObject['status'] == 'Activa') 
                {
                    $directorResult = activeDirector($directorObject['id'],'Inactiva');
                }else
                {
                    $directorResult = activeDirector($directorObject['id'], 'Activa');
                }    
            }
        }
        if(!$sendData){
    ?>

        <div class="card">
            <div class="card-header text-center">
                <h1>CAMBIAR EL ESTADO DE UN DIRECTOR</h1>
            </div>
            <div class="card-body">
                <form name="create_director" action="" method="POST">
                    <?php 
                        if($directorObject['status'] == 'Activa') 
                        {
                    ?>
                            <h3 class="text-center">
                                Desea inactivar al Director
                            </h3>
                    <?php 
                        }else
                        {
                    ?>
                            <h3 class="text-center">
                                Desea activar al Director
                            </h3>
                    <?php 
                        }
                        $personList = listPerson($directorObject['idperson']);
                    ?> 
                    <h3 class="text-center">
                        <?php if(isset($personList)) echo $personList['name']." ".$personList['lastname']; ?>
                    </h3>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <?php 
                            if($directorObject['status'] == 'Activa') 
                            {
                        ?>
                            <input type="submit" value="Inactivar" class="btn btn-success" name="activeBtn">
                        <?php 
                            }else
                            {
                        ?>
                            <input type="submit" value="Activar" class="btn btn-success" name="activeBtn">
                        <?php 
                            }
                        ?>    
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
                switch ($directorResult) {
                    case 'actived':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Plataforma fue activada exitosamente ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errorractived':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Hubo un error en la activacion de la Plataforma ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'inactive':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Plataforma fue inactivada exitosamente ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errorrinactive':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Hubo un error en la inactivacion de la Plataforma ! 
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
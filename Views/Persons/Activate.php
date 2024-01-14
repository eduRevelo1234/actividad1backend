<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/ActorController.php');
require_once(__DIR__ . '/../../Controllers/DirectorController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idPerson = isset($_GET['id']) ? $_GET['id'] : 0;
        $personObject = listPerson($idPerson);
        $sendData = false;
        $personActived = false;
        if(isset($_POST['activeBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            if(isset($personObject)) {
                if($personObject['status'] == 'Activa') 
                {
                    $personResult = activePerson($personObject['id'],'Inactiva');
                    $actorResult = activeActorPerson($personObject['id'],'Inactiva');
                    $directorResult = activeDirectorPerson($personObject['id'],'Inactiva');
                }else
                {
                    $personResult = activePerson($personObject['id'],'Activa');
                    $actorResult = activeActorPerson($personObject['id'],'Activa');
                    $directorResult = activeDirectorPerson($personObject['id'],'Activa');
                }    
            }
        }
        if(!$sendData){
    ?>

        <div class="card">
            <div class="card-header text-center">
                <h1>CAMBIAR EL ESTADO DE UNA PERSONA</h1>
            </div>
            <div class="card-body">
                <form name="create_person" action="" method="POST">
                    <?php 
                        if($personObject['status'] == 'Activa') 
                        {
                    ?>
                            <h3 class="text-center">
                                Desea inactivar a la Persona
                            </h3>
                    <?php 
                        }else
                        {
                    ?>
                            <h3 class="text-center">
                                Desea activar a la Persona
                            </h3>
                    <?php 
                        }
                    ?>
                    
                    <h3 class="text-center">
                        <?php if(isset($personObject)) echo $personObject['name']; ?> ?
                    </h3>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <?php 
                            if($personObject['status'] == 'Activa') 
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
                switch ($personResult) {
                    case 'actived':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Persona fue activada exitosamente ! 
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
                            Hubo un error en la activacion de la Persona ! 
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
                            La Persona fue inactivada exitosamente ! 
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
                            Hubo un error en la inactivacion de la Persona ! 
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
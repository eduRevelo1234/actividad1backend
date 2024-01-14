<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/ActorController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idActor = isset($_GET['id']) ? $_GET['id'] : 0;
        $actorObject = listActor($idActor);
        $sendData = false;
        $actorResult = false;

        if(isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if($sendData) 
        {
            if(isset($_POST['actorCode'])) 
            {
                $actorResult = burnActor($_POST['actorId'],$_POST['actorIdperson'],$_POST['actorCode'],$_POST['actorCodeCurrent']);
            }
        }
        if(!$sendData)
        {
    ?>
            <div class="card">
                <div class="card-header text-center">
                    <?php 
                        if($idActor > 0)
                        {
                    ?>
                        <h1>EDICION DE UN ACTOR</h1>
                    <?php 
                        }else
                        {
                    ?>
                        <h1>CREACION DE UN NUEVO ACTOR</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_actor" action="" method="POST">
                        <div class="row">
                            <!-- Persona -->
                            <div class="col-lg-4 col-md-12">
                                    <?php
                                        $valorseleccionado=isset($actorObject['idperson']) ? $actorObject['idperson'] : 0; 
                                        $personList = listPersonsActive();
                                        if (count($personList) > 0) {
                                    ?>
                                    <div class="form-floating mb-3">
                                        <select id="actorIdperson" name="actorIdperson" class="form-select" aria-label="Default select example">
                                            <option value=0 selected>Escojer una Persona</option>
                                        <?php
                                                foreach ($personList as $person) 
                                                {  
                                        ?>
                                            <option value="<?php  echo $person->getId(); ?>" <?php echo ($valorseleccionado==$person->getId()) ? "selected" : ""; ?> ><?php  echo $person->getName()." " .$person->getLastname(); ?></option>
                                                    
                                        <?php
    
                                                }
                                        ?>
                                        </select>
                                    </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            <!-- Codigo -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="actorCode" name="actorCode" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($actorObject['code'])) echo $actorObject['code']; ?>" autocomplete="off">
                                    <label for="actorCode">Codigo del Actor</label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="actorId" value="<?php echo $idActor; ?>">
                        <input type="hidden" name="actorCodeCurrent" value="<?php if (isset($actorObject['code'])) echo $actorObject['code']; ?>">

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
                switch ($actorResult) {
                    case 'errorpersonvacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El campo Persona no debe estar vacio ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'errorcodevacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El codigo del actor no puede estar vacio ! 
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
                            El Actor se creo exitosamente ! 
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
                            Hubo un error en la creacion del Actor ! 
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
                            El Actor se edito exitosamente ! 
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
                            Hubo un error en la edicion del Actor ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'errorcode':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El codigo del Actor ya existe ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                         case 'samecode':
            ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El codigo del actor es el mismo  ! 
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
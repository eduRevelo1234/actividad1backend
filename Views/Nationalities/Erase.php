<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idNationality = $_GET['id'];
        $nationalityObject = listNationality($idNationality);
        $sendData = false;
        $nationalityErase = false;
        if(isset($_POST['eraseBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            //Verificamos si no hay personas que utilizan esta nacionalidad
            $personList = listPersonNationality($nationalityObject['id']);        
            if (empty($personList))
            {
                $nationalityResult = eraseNationality($nationalityObject['id']);
            }else
            {
                $nationalityResult = 'errorexists';
            }
        }
        if(!$sendData){
    ?>    

        <div class="card">
            <div class="card-header text-center">
                <h1>BORRAR UNA NACIONALIDAD</h1>
            </div>
            <div class="card-body">
                <form name="create_language" action="" method="POST">
                    <h3 class="text-center">
                        Desea borrar la Nacionalidad
                    </h3>

                    <h3 class="text-center">
                        <?php if(isset($nationalityObject)) echo $nationalityObject['name']; ?> ?
                    </h3>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <input type="submit" value="Borrar" class="btn btn-success" name="eraseBtn">
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
                    case 'erased':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Nacionalidad fue borrada exitosamente ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errorrerased':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Hubo un error en el borrado de la Nacionalidad ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errorexists':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            EXISTEN PERSONAS QUE TIENEN ESTA NACIONALIDAD 
                            <br>
                            ANTES DE ELIMINAR SE DEBE CAMBIAR LA NACIONALIDAD DE LAS PERSONAS ! 
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
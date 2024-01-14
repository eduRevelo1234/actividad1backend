<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');


?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idPerson = isset($_GET['id']) ? $_GET['id'] : 0;
        $personObject = listPerson($idPerson);
        $sendData = false;
        $personResult = false;

        if (isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if ($sendData) 
        {
            if (isset($_POST['personName'])) 
            {
                $personResult = burnPerson($_POST['personId'],$_POST['personName'],$_POST['personLastname'],$_POST['personCode'],$_POST['personDatebirth'],$_POST['personIdnationality'],$_POST['personNameCurrent'],$_POST['personCodeCurrent']);          
            }
        }
        if(!$sendData)
        {
    ?>
            <div class="card">
                <div class="card-header text-center">
                    <?php 
                        if ($idPerson > 0)
                        {
                    ?>
                        <h1>EDICION DE UNA PERSONA</h1>
                    <?php 
                        } else
                        {
                    ?>
                        <h1>CREACION DE UNA NUEVA PERSONA</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_person" action="" method="POST">
                        <!-- Datos de la persona -->
                        <div class="row">
                            <!-- Nombre  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="personName" required  name="personName" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($personObject['name'])) echo $personObject['name']; ?>" autocomplete="off">
                                    <label for="personName">Nombre de la persona</label>
                                </div>
                            </div>

                            <!-- Apellido  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="personLastname" name="personLastname" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($personObject['lastname'])) echo $personObject['lastname']; ?>" autocomplete="off">
                                    <label for="personName">Apellido de la persona</label>
                                </div>
                            </div>

                            <!-- Codigo  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="personCode" name="personCode" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($personObject['code'])) echo $personObject['code']; ?>" autocomplete="off">
                                    <label for="personName">Codigo personal</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                             <!-- Fecha de nacimiento  -->
                            <?php 
                                //Cambio de formato de la fecha a dd/mm/aaaa
                                $fechaactual=isset($personObject['datebirth']) ? $personObject['datebirth'] : 0; 
                                $mostrarFecha = date("d/m/Y", strtotime($fechaactual));
                            ?>
                             <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="personDatebirth" name="personDatebirth" type="text" class="form-control" placeholder="name@example.com" value="<?php echo $mostrarFecha; ?>" autocomplete="off">
                                    <label for="personName">Fecha de Nacimiento</label>
                                </div>
                            </div>

                            <!-- Nacionalidad -->
                            <div class="col-lg-4 col-md-12">
                                 <?php
                                     $valorseleccionado=isset($personObject['idnationality']) ? $personObject['idnationality'] : 0; 
                                     $nationalityList = listNationalities();
                                     if (count($nationalityList) > 0) {
                                 ?>
                                 <div class="form-floating mb-3">
                                     <select id="personIdnationality" name="personIdnationality" class="form-select" aria-label="Default select example">
                                         <option value=0 selected>Escojer una Nacionalidad</option>
                                     <?php
                                             foreach ($nationalityList as $nationality) {  
                                     ?>
                                         <option value="<?php  echo $nationality->getId(); ?>" <?php echo ($valorseleccionado==$nationality->getId()) ? "selected" : ""; ?> ><?php  echo $nationality->getName(); ?></option>
                                                 
                                     <?php
 
                                             }
                                     ?>
                                     </select>
                                 </div>
                                     <?php
                                         }
                                     ?>
                            </div>
                        </div>
                                        
                        <input type="hidden" name="personId" value="<?php echo $idPerson; ?>">
                        <input type="hidden" name="personNameCurrent" value="<?php if (isset($personObject['name'])) echo $personObject['name']; ?>">
                        <input type="hidden" name="personCodeCurrent" value="<?php if (isset($personObject['code'])) echo $personObject['code']; ?>">

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
                switch ($personResult) {
                    case 'errornamevacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Persona no debe estar vacio ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'errornameformat':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Persona solo debe contener letras ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errorlastvacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El apellido de la Persona no debe estar vacio ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'errorlastformat':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El apellido de la Persona solo debe contener letras ! 
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
                            El Codigo personal no debe estar vacio ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'errorcodeformat':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El Codigo solo debe contener letras , numeros y guiones ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'errordatevacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            La Fecha de nacimiento no debe estar vacia ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errordateformat':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            La Fecha de nacimiento debe estar en el formato dd/mm/aaaa ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                    case 'errornationalityvacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            La Nacionalidad no debe estar vacia ! 
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
                            El Persona se creo exitosamente ! 
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
                            Hubo un error en la creacion del Persona ! 
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
                            El Persona se edito exitosamente ! 
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
                            Hubo un error en la edicion del Persona ! 
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
                            El nombre del Persona ya existe ! 
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
                            El Codigo personal ya existe ! 
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
                            El nombre del Persona es el mismo  ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'sameisocode':
            ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El ISO Code es el mismo ! 
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
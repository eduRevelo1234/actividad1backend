<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/LanguageController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idLanguage = $_GET['id'];
        $languageObject = listLanguage($idLanguage);
        $sendData = false;
        $languageResult = false;

        if(isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if($sendData) 
        {
            if(isset($_POST['languageName'])) 
            {
                $languageResult = burnLanguage($_POST['languageId'],$_POST['languageName'],$_POST['languageIsocode'],$_POST['languageNameCurrent'],$_POST['languageIsocodeCurrent']);          
            }
        }
        if(!$sendData)
        {
    ?>
            <div class="card">
                <div class="card-header text-center">
                    <?php 
                        if($idLanguage > 0)
                        {
                    ?>
                        <h1>EDICION DE UN IDIOMA</h1>
                    <?php 
                        }else
                        {
                    ?>
                        <h1>CREACION DE UN NUEVO IDIOMA</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_language" action="" method="POST">
                        <div class="form-floating mb-3">
                            <input id="languageName" name="languageName" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($languageObject)) echo $languageObject['name']; ?>">
                            <label for="languageName">Nombre del Idioma</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="languageIsocode" name="languageIsocode" type="text" class="form-control" placeholder="name@example.com" value="<?php if(isset($languageObject)) echo $languageObject['isocode']; ?>">
                            <label for="languageIsocode">Codigo ISO 639</label>
                        </div>
                        
                        <input type="hidden" name="languageId" value="<?php echo $idLanguage; ?>">
                        <input type="hidden" name="languageNameCurrent" value="<?php echo $languageObject['name']; ?>">
                        <input type="hidden" name="languageIsocodeCurrent" value="<?php echo $languageObject['isocode']; ?>">

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
                switch ($languageResult) {
                    case 'errornamevacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre del Idioma no debe estar vacio ! 
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
                            El nombre del Idioma solo debe contener letras ! 
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
                            El ISO Code no debe estar vacio ! 
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
                            El ISO Code solo debe contener 2 letras ! 
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
                            El Idioma se creo exitosamente ! 
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
                            Hubo un error en la creacion del Idioma ! 
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
                            El Idioma se edito exitosamente ! 
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
                            Hubo un error en la edicion del Idioma ! 
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
                            El nombre del Idioma ya existe ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'errorisocode':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El ISO Code del Idioma ya existe ! 
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
                            El nombre del Idioma es el mismo  ! 
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
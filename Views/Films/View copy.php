<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/FilmController.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');
require_once(__DIR__ . '/../../Controllers/LanguageController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idFilm = $_GET['id'];
        $filmObject = listFilm($idFilm);
        $sendData = false;
        $filmResult = false;

        if(isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if($sendData) 
        {
            if(isset($_POST['filmTitle'])) 
            {
                //Guardo los datos de la tabla pelicula
                $filmResult = 'prueba';
                //$filmResult = saveFilm($_POST['filmId'],$_POST['filmTitle'],$_POST['filmPlataform'],$_POST['filmDirector'],$_POST['filmPremiereyear']);
                
                //Guardo los datos de la tabla Actor-Pelicula detalle

                //Guardo los datos de la tabla Idioma Audio-Pelicula detalle

                //Guardo los datos de la tabla Idioma Subtitulo-Pelicula detalle
            }
        }
        if(!$sendData)
        {
    ?>
            <div class="card">
                <div class="card-header text-center">
                    <?php 
                        if($idFilm > 0)
                        {
                    ?>
                        <h1>EDICION DE UN PELICULA</h1>
                    <?php 
                        }else
                        {
                    ?>
                        <h1>CREACION DE UN NUEVO PELICULA</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form title="create_film" action="" method="POST">
                        <!-- Id -->
                        <input type="hidden" title="filmId" value="<?php echo $idFilm; ?>">
                        
                        <!-- Titulo -->
                        <div class="form-floating mb-3">
                            <input id="filmTitle" title="filmTitle" type="text" class="form-control" placeholder="title@example.com" value="<?php if(isset($filmObject)) echo $filmObject['title']; ?>">
                            <label for="filmTitle">Titulo de la Pelicula</label>
                        </div>
                        <input type="hidden" title="filmTitleCurrent" value="<?php echo $filmObject['title']; ?>">
                        
                        <!-- Datos de la pelicula -->
                        <div class="row">
                            <!-- Plataforma -->
                            <div class="col-lg-4 col-md-12">
                                <?php
                                    $platformList = listPlatforms();
                                    if (count($platformList) > 0) {
                                ?>
                                <div class="form-floating mb-3">
                                    <select id=filmPlataform class="form-select" aria-label="Default select example">
                                        <option selected>Escojer una Plataforma</option>
                                    <?php
                                            foreach ($platformList as $platform) {  
                                    ?>
                                        <option value="<?php echo $platform->getId(); ?>"><?php echo $platform->getName(); ?></option>
                                    <?php
                                            }
                                    ?>
                                    </select>
                                </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            
                            <!-- Director  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <select id=filmDirector class="form-select" aria-label="Default select example">
                                        <option selected>Escojer un Director</option>
                                        <option value="1">Director 1</option>
                                        <option value="1">Director 1</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Año de estreno  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="filmPremiereyear" title="filmPremiereyear" type="text" class="form-control" placeholder="title@example.com" value="<?php if(isset($filmObject)) echo $filmObject['title']; ?>">
                                    <label for="filmPremiereyear">Año de estreno</label>
                                </div>
                            </div>
                        </div>
                        
                        &nbsp;&nbsp;
                        <!-- Listados -->
                        <div class="row">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="navActors-tab" data-bs-toggle="tab" data-bs-target="#navActors" type="button" role="tab" aria-controls="navActors" aria-selected="true">ACTORES</button>
                                    <button class="nav-link" id="navLanguageAudio-tab" data-bs-toggle="tab" data-bs-target="#navLanguageAudio" type="button" role="tab" aria-controls="navLanguageAudio" aria-selected="false">IDIOMAS AUDIO</button>
                                    <button class="nav-link" id="navLanguageCaption-tab" data-bs-toggle="tab" data-bs-target="#navLanguageCaption" type="button" role="tab" aria-controls="navLanguageCaption" aria-selected="false">IDIOMAS SUBTITULO</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                
                                <!-- Actores -->
                                <div class="tab-pane fade show active" id="navActors" role="tabpanel" aria-labelledby="navActors-tab" tabindex="0">
                                    <div class="text-center">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                            <label class="form-check-label" for="inlineCheckbox1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                            <label class="form-check-label" for="inlineCheckbox2">2</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Idiomas de Audio -->
                                <div class="tab-pane fade" id="navLanguageAudio" role="tabpanel" aria-labelledby="navLanguageAudio-tab" tabindex="0">
                                    &nbsp;&nbsp;
                                    <div text-align: justify;>
                                    <?php
                                        $languajeList = listLanguages();
                                        if (count($languajeList) > 0) {
                                            foreach ($languajeList as $languaje) {
                                    ?>    
                                                &nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="<?php echo $languaje->getId(); ?>" value="<?php echo $languaje->getName(); ?>">
                                                    <label class="form-check-label" for="<?php echo $languaje->getId(); ?>"><?php echo $languaje->getName(); ?></label>
                                                </div>
                                                &nbsp;&nbsp;
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                                
                                <!-- Idiomas de Subtitulo -->
                                <div class="tab-pane fade" id="navLanguageCaption" role="tabpanel" aria-labelledby="navLanguageCaption-tab" tabindex="0">
                                    &nbsp;&nbsp;
                                    <div text-align: justify;>
                                    <?php
                                        $languajeList = listLanguages();
                                        if (count($languajeList) > 0) {
                                            foreach ($languajeList as $languaje) {
                                    ?>    
                                                &nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="<?php echo $languaje->getId(); ?>" value="<?php echo $languaje->getName(); ?>">
                                                    <label class="form-check-label" for="<?php echo $languaje->getId(); ?>"><?php echo $languaje->getName(); ?></label>
                                                </div>
                                                &nbsp;&nbsp;
                                    <?php
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Botones -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <input type="submit" value="Guardar" class="btn btn-success" title="saveBtn">
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
                switch ($filmResult) {
                    case 'errorvacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Pelicula no debe estar vacio ! 
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
                            El nombre de la Pelicula solo debe contener letras ! 
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
                            La Pelicula se creo exitosamente ! 
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
                            Hubo un error en la creacion de la Pelicula ! 
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
                            La Pelicula se edito exitosamente ! 
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
                            Hubo un error en la edicion de la Pelicula ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'errortitle':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Pelicula ya existe ! 
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
                            El ISO Code de la Pelicula ya existe ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'sametitle':
            ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            El nombre de la Pelicula es el mismo  ! 
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
                        case 'prueba':
            ?>
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            Esto es una prueba ! 
                            <br> 
                            <?php
                            echo 'prueba';
                            ?>
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
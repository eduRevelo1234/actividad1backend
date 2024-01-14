<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/FilmController.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');
require_once(__DIR__ . '/../../Controllers/LanguageController.php');
require_once(__DIR__ . '/../../Controllers/DetailAudioFilmController.php');
require_once(__DIR__ . '/../../Controllers/DetailCaptionFilmController.php');
require_once(__DIR__ . '/../../Controllers/ActorController.php');
require_once(__DIR__ . '/../../Controllers/DetailActorFilmController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idFilm = isset($_GET['id']) ? $_GET['id'] : 0;
        $filmObject = listFilm($idFilm);
        $sendData = false;
        $filmResult = "";
        $eraseAudioResult = "";
        $saveAudioResult = "";
        $eraseCaptionResult = "";
        $saveCaptionResult = "";
        $eraseActorResult = "";
        $saveActorResult = "";

        if(isset($_POST['saveBtn'])) 
        {
            $sendData = true;
        }
        if($sendData) 
        {
            //Se guarda los datos de la pelicula
            $filmResult = burnFilm($_POST['filmId'],$_POST['filmTitle'],$_POST['filmIdPlataform'],$_POST['filmIdDirector'],$_POST['filmYear'],$_POST['filmTitleCurrent']);
            if($filmResult == 'edited' or $filmResult == 'registered' )
            {
                //Obtenemos el ultimo registro guardado
                $endfilm = endFilm();
                    
                //Se guarda los datos en la tabla actor / pelicula
                
                //Verificamos si estamos editando o creando
                if($_POST['filmId']>0)
                {
                    //Borramos todos los registros de la pelicula en la tabla actores peliculas
                    $eraseActorResult = eraseActorFilm($_POST['filmId']);
                    //Grabamos los actores con su pelicula
                    foreach($_POST['check_actor_list'] as $selection) 
                    {
                        echo $selection;
                        echo '  --   ';
                        echo $_POST['filmId'];
                        echo '     ';
                        $saveActorResult = burnActorFilm($selection,$_POST['filmId']);        
                    }
                }else
                {
                    //Grabamos los actores con su pelicula
                    foreach($_POST['check_actor_list'] as $selection) 
                    {
                        $saveActorResult = burnActorFilm($selection,$endfilm['maxid']);        
                    }
                }

                //Se guarda los datos en la tabla lenguaje de audio / pelicula
                
                //Verificamos si estamos editando o creando
                if($_POST['filmId']>0)
                {
                    //Borramos todos los registros de la pelicula en la tabla lenguage audio
                    $eraseAudioResult = eraseAudioFilm($_POST['filmId']);
                    //Grabamos los idiomas de audio con su pelicula
                    foreach($_POST['check_audio_list'] as $selection) 
                    {
                        $saveAudioResult = burnAudioFilm($_POST['filmId'],$selection);        
                    }
                }else
                {
                    //Grabamos los idiomas de audio con su pelicula
                    foreach($_POST['check_audio_list'] as $selection) 
                    {
                        $saveAudioResult = burnAudioFilm($endfilm['maxid'],$selection);        
                    }
                }
                
                //Se guarda los datos en la tabla lenguaje de subtitulo / pelicula
                
                //Verificamos si estamos editando o creando
                if($_POST['filmId']>0)
                {
                    //Borramos todos los registros de la pelicula en la tabla lenguage subtitulo
                    $eraseCaptionResult = eraseCaptionFilm($_POST['filmId']);
                    //Grabamos los idiomas de audio con su pelicula
                    foreach($_POST['check_caption_list'] as $selection) 
                    {
                        $saveCaptionResult = burnCaptionFilm($_POST['filmId'],$selection);        
                    }
                }else
                {
                    //Grabamos los idiomas de subtitulo con su pelicula
                    foreach($_POST['check_caption_list'] as $selection) 
                    {
                        $saveCaptionResult = burnCaptionFilm($endfilm['maxid'],$selection);        
                    }
                }
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
                        <h1>CREACION DE UNA NUEVA PELICULA</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_film" action="" method="POST">
                        <!-- Id -->
                        <input id="filmId" name="filmId" type="hidden" value="<?php echo $idFilm; ?>">
                        
                        <!-- Titulo -->
                        <div class="form-floating mb-3">
                            <input id="filmTitle" name="filmTitle" type="text" class="form-control" autocomplete="off" placeholder="name@example.com" value="<?php if(isset($filmObject['title'])) echo $filmObject['title']; ?>">
                            <label for="filmTitle">Nombre de la Pelicula</label>
                        </div>
                        <input id="filmTitleCurrent" type="hidden" name="filmTitleCurrent" type="text" class="form-control" value="<?php if(isset($filmObject)) echo $filmObject['title']; ?>">

                        <!-- Datos de la pelicula -->
                        <div class="row">
                            <!-- Plataforma -->
                            <div class="col-lg-4 col-md-12">
                                <?php
                                    $valorseleccionado=isset($filmObject['idplatform']) ? $filmObject['idplatform'] : 0; 
                                    $platformList = listPlatforms();
                                    if (count($platformList) > 0) {
                                ?>
                                <div class="form-floating mb-3">
                                    <select id="filmIdPlataform" name="filmIdPlataform" class="form-select" aria-label="Default select example">
                                        <option value=0 selected>Escojer una Plataforma</option>
                                    <?php
                                            foreach ($platformList as $platform) {  
                                    ?>
                                        <option value="<?php  echo $platform->getId(); ?>" <?php echo ($valorseleccionado==$platform->getId()) ? "selected" : ""; ?> ><?php  echo $platform->getName(); ?></option>
                                                
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
                                    <select id="filmIdDirector" name="filmIdDirector" class="form-select" aria-label="Default select example" value=1>
                                        <option value="0" selected>Escojer un Director</option>
                                        <option value="1">Director 1</option>
                                        <option value="2">Director 2</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Año de estreno  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="filmYear" name="filmYear" type="text" class="form-control" autocomplete="off" placeholder="name@example.com" value="<?php if(isset($filmObject['premiereyear'])) echo $filmObject['premiereyear']; ?>">
                                    <label for="filmYear">Año de estreno</label>
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
                                    &nbsp;&nbsp;
                                    <div text-align: justify;>
                                    <?php
                                        $actorList = listActors();
                                        
                                        if (count($actorList) > 0) 
                                        {
                                            foreach ($actorList as $actor) {
                                                //Traemos el nombre y Apellido del Actor 
                                                $personObject = listPerson($actor->getIdperson());
                                                //Verificamos si estamos editando o creando
                                                if($idFilm>0)
                                                {
                                                    //Verificamos si existe el registro guardado
                                                    $selectactor = listActorFilm($actor->getId(),$idFilm);
                                                    if(!empty($selectactor))
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_actor_list[]" value="<?php echo $actor->getId(); ?>" checked >&nbsp;&nbsp;<?php echo $personObject['name']." " .$personObject['lastname']; ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }else
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_actor_list[]" value="<?php echo $actor->getId(); ?>" >&nbsp;&nbsp;<?php echo $personObject['name']." " .$personObject['lastname']; ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }
                                                }else
                                                {
                                    ?>
                                                &nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <label><input type="checkbox" name="check_actor_list[]" value="<?php echo $actor->getId(); ?>" >&nbsp;&nbsp;<?php echo $personObject['name']." " .$personObject['lastname']; ?></label>
                                                </div>
                                                &nbsp;&nbsp;
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
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
                                                //Verificamos si estamos editando o creando
                                                if($idFilm>0)
                                                {
                                                    //Verificamos si existe el registro guardado
                                                    $selectlanguaje = listAudioFilm($idFilm,$languaje->getId());
                                                    if(!empty($selectlanguaje))
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_audio_list[]" value="<?php echo $languaje->getId(); ?>" checked >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }else
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_audio_list[]" value="<?php echo $languaje->getId(); ?>" >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }
                                                }else
                                                {
                                    ?>
                                                &nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <label><input type="checkbox" name="check_audio_list[]" value="<?php echo $languaje->getId(); ?>" >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                </div>
                                                &nbsp;&nbsp;
                                    <?php
                                                }
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
                                                //Verificamos si estamos editando o creando
                                                if($idFilm>0)
                                                {
                                                    //Verificamos si existe el registro guardado
                                                    $selectlanguaje = listCaptionFilm($idFilm,$languaje->getId());
                                                    if(!empty($selectlanguaje))
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_caption_list[]" value="<?php echo $languaje->getId(); ?>" checked >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }else
                                                    {
                                    ?>
                                                        &nbsp;&nbsp;
                                                        <div class="form-check form-check-inline">
                                                            <label><input type="checkbox" name="check_caption_list[]" value="<?php echo $languaje->getId(); ?>" >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                        </div>
                                                        &nbsp;&nbsp;
                                    <?php
                                                    }
                                                }else
                                                {
                                    ?>
                                                &nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <label><input type="checkbox" name="check_caption_list[]" value="<?php echo $languaje->getId(); ?>" >&nbsp;&nbsp;<?php echo $languaje->getName(); ?></label>
                                                </div>
                                                &nbsp;&nbsp;
                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;&nbsp;
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
                switch ($filmResult) {

                    case 'errortitulovacio':
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
                        case 'errorplataformavacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Se debe escojer una opcion de Plataformas ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                        case 'errordirectorvacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            Se debe escojer una opcion de Directores ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                        case 'erroranovacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El año de estreno de la Pelicula no debe estar vacio ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>      
                        </div>
            <?php
                        break;
                    case 'erroranoformat':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El año de estreno de la Pelicula solo debe contener 4 numeros ! 
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
                }
            ?>
            </div>
    <?php
        }
    ?>
</div>
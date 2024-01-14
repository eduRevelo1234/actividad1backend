<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/SerieController.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');
require_once(__DIR__ . '/../../Controllers/LanguageController.php');
require_once(__DIR__ . '/../../Controllers/DetailAudioSerieController.php');
require_once(__DIR__ . '/../../Controllers/DetailCaptionSerieController.php');
require_once(__DIR__ . '/../../Controllers/ActorController.php');
require_once(__DIR__ . '/../../Controllers/DetailActorSerieController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/DirectorController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idSerie = isset($_GET['id']) ? $_GET['id'] : 0;
        $serieObject = listSerie($idSerie);
        $sendData = false;
        $serieResult = "";
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
            //Se guarda los datos de la serie
            $serieResult = burnSerie($_POST['serieId'],$_POST['serieTitle'],$_POST['serieIdPlataform'],$_POST['serieIdDirector'],$_POST['serieYear'],$_POST['serieTitleCurrent']);
            if($serieResult == 'edited' or $serieResult == 'registered' )
            {
                //Obtenemos el ultimo registro guardado
                $endserie = endSerie();
                
                //Se guarda los datos en la tabla actor / serie
                
                //Verificamos si estamos editando o creando
                if($_POST['serieId']>0)
                {
                    //Borramos todos los registros de la serie en la tabla actores series
                    $eraseActorResult = eraseActorSerie($_POST['serieId']);
                    //Grabamos los actores con su pelicula
                    foreach($_POST['check_actor_list'] as $selection) 
                    {
                        $saveActorResult = burnActorSerie($selection,$_POST['serieId']);        
                    }
                }else
                {
                    //Grabamos los actores con su pelicula
                    foreach($_POST['check_actor_list'] as $selection) 
                    {
                        $saveActorResult = burnActorSerie($selection,$endserie['maxid']);        
                    }
                }

                //Se guarda los datos en la tabla lenguaje de audio / serie
                
                //Verificamos si estamos editando o creando
                if($_POST['serieId']>0)
                {
                    //Borramos todos los registros de la serie en la tabla lenguage audio
                    $eraseAudioResult = eraseAudioSerie($_POST['serieId']);
                    //Grabamos los idiomas de audio con su serie
                    foreach($_POST['check_audio_list'] as $selection) 
                    {
                        $saveAudioResult = burnAudioSerie($_POST['serieId'],$selection);        
                    }
                }else
                {
                    //Grabamos los idiomas de audio con su serie
                    foreach($_POST['check_audio_list'] as $selection) 
                    {
                        $saveAudioResult = burnAudioSerie($endserie['maxid'],$selection);        
                    }
                }
                
                //Se guarda los datos en la tabla lenguaje de subtitulo / serie
                
                //Verificamos si estamos editando o creando
                if($_POST['serieId']>0)
                {
                    //Borramos todos los registros de la serie en la tabla lenguage subtitulo
                    $eraseCaptionResult = eraseCaptionSerie($_POST['serieId']);
                    //Grabamos los idiomas de audio con su serie
                    foreach($_POST['check_caption_list'] as $selection) 
                    {
                        $saveCaptionResult = burnCaptionSerie($_POST['serieId'],$selection);        
                    }
                }else
                {
                    //Grabamos los idiomas de subtitulo con su serie
                    foreach($_POST['check_caption_list'] as $selection) 
                    {
                        $saveCaptionResult = burnCaptionSerie($endserie['maxid'],$selection);        
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
                        if($idSerie > 0)
                        {
                    ?>
                        <h1>EDICION DE UNA SERIE</h1>
                    <?php 
                        }else
                        {
                    ?>
                        <h1>CREACION DE UNA NUEVA SERIE</h1>
                    <?php 
                        }
                    ?>
                </div>
                <div class="card-body">
                    <form name="create_serie" action="" method="POST">
                        <!-- Id -->
                        <input id="serieId" name="serieId" type="hidden" value="<?php echo $idSerie; ?>">
                        
                        <!-- Titulo -->
                        <div class="form-floating mb-3">
                            <input id="serieTitle" name="serieTitle" type="text" class="form-control" autocomplete="off" placeholder="name@example.com" value="<?php if(isset($serieObject['title'])) echo $serieObject['title']; ?>">
                            <label for="serieTitle">Nombre de la Serie</label>
                        </div>
                        <input id="serieTitleCurrent" type="hidden" name="serieTitleCurrent" type="text" class="form-control" value="<?php if(isset($serieObject['title'])) echo $serieObject['title']; ?>">

                        <!-- Datos de la serie -->
                        <div class="row">
                            <!-- Plataforma -->
                            <div class="col-lg-4 col-md-12">
                                 
                                <?php
                                    $valorseleccionado=isset($serieObject['idplatform']) ? $serieObject['idplatform'] : 0;
                                    $platformList = listPlatforms();
                                    if (count($platformList) > 0) {
                                ?>
                                <div class="form-floating mb-3">
                                    <select id="serieIdPlataform" name="serieIdPlataform" class="form-select" aria-label="Default select example">
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
                                <?php
                                    $valorseleccionado=isset($serieObject['iddirector']) ? $serieObject['iddirector'] : 0;
                                    $directorList = listDirectors();
                                    if (count($directorList) > 0) {
                                ?>
                                <div class="form-floating mb-3">
                                    <select id="serieIdDirector" name="serieIdDirector" class="form-select" aria-label="Default select example">
                                        <option value=0 selected>Escojer un Director</option>
                                    <?php
                                            foreach ($directorList as $director) 
                                            {
                                                //Traemos el nombre y Apellido del Director 
                                                $personObject = listPerson($director->getIdperson());        
                                    ?>
                                        <option value="<?php  echo $director->getId(); ?>" <?php echo ($valorseleccionado==$director->getId()) ? "selected" : ""; ?> ><?php  echo $personObject['name']." " .$personObject['lastname']; ?></option>   
                                    <?php

                                            }
                                    ?>
                                    </select>
                                </div>
                                    <?php
                                        }
                                    ?>
                            </div>
                            
                            <!-- Año de estreno  -->
                            <div class="col-lg-4 col-md-12">
                                <div class="form-floating mb-3">
                                    <input id="serieYear" name="serieYear" type="text" class="form-control" autocomplete="off" placeholder="name@example.com" value="<?php if(isset($serieObject['premiereyear'])) echo $serieObject['premiereyear']; ?>">
                                    <label for="serieYear">Año de estreno</label>
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
                                                if($idSerie>0)
                                                {
                                                    //Verificamos si existe el registro guardado
                                                    $selectactor = listActorSerie($actor->getId(),$idSerie);
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
                                                if($idSerie>0)
                                                {   
                                                    //Verificamos si existe el registro guardado
                                                    $selectlanguaje = listAudioSerie($idSerie,$languaje->getId());
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
                                                if($idSerie>0)
                                                {
                                                    //Verificamos si existe el registro guardado
                                                    $selectlanguaje = listCaptionSerie($idSerie,$languaje->getId());
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
                switch ($serieResult) {

                    case 'errortitulovacio':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            El nombre de la Serie no debe estar vacio ! 
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
                            El año de estreno de la Serie no debe estar vacio ! 
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
                            El año de estreno de la Serie solo debe contener 4 numeros ! 
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
                            La Serie se creo exitosamente ! 
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
                            Hubo un error en la creacion de la Serie ! 
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
                            La Serie se edito exitosamente ! 
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
                            Hubo un error en la edicion de la Serie ! 
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
                            El nombre de la Serie ya existe ! 
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
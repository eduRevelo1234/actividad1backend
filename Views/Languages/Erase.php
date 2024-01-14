<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/LanguageController.php');
require_once(__DIR__ . '/../../Controllers/DetailAudioFilmController.php');
require_once(__DIR__ . '/../../Controllers/DetailAudioSerieController.php');
require_once(__DIR__ . '/../../Controllers/DetailCaptionFilmController.php');
require_once(__DIR__ . '/../../Controllers/DetailCaptionSerieController.php');

?>

<!-- Contenido -->
<div class="container mt-4">
    <?php
        $idLanguage = $_GET['id'];
        $languageObject = listLanguage($idLanguage);
        $sendData = false;
        $languageErase = false;
        if(isset($_POST['eraseBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            //Verificamos si no hay peliculas ni series que utilizan este idioma
            $languagecaptionfilmList = listLanguageCaptionFilm($languageObject['id']);        
            $languageaudiofilmList = listLanguageAudioFilm($languageObject['id']);        
            $languagecaptionserieList = listLanguageCaptionSerie($languageObject['id']);        
            $languageaudioserieList = listLanguageAudioSerie($languageObject['id']);        
            
            if (empty($languagecaptionfilmList) && empty($languageaudiofilmList))
            {
                if (empty($languagecaptionserieList) && empty($languageaudioserieList))
                {
                    $languageResult = eraseLanguage($languageObject['id']);
                }else
                {
                    $languageResult = 'errorserie';
                }        
            }else
            {
                $languageResult = 'errorfilms';
            }
        }
        if(!$sendData){
    ?>

        <div class="card">
            <div class="card-header text-center">
                <h1>BORRAR UN IDIOMA</h1>
            </div>
            <div class="card-body">
                <form name="create_language" action="" method="POST">
                    <h3 class="text-center">
                        Desea borrar el Idioma
                    </h3>

                    <h3 class="text-center">
                        <?php if(isset($languageObject)) echo $languageObject['name']; ?> ?
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
                switch ($languageResult) {
                    case 'erased':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            El Idioma fue borrado exitosamente ! 
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
                            Hubo un error en el borrado del Idioma ! 
                            <br> 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'errorfilms':
            ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-x-circle-fill"></i>
                            EXISTEN PELICULAS QUE TIENEN ESTE LENGUAJE 
                            <br>
                            ANTES DE ELIMINAR SE DEBE CAMBIAR EL LENGUAJE DE LAS PELICULAS ! 
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary" href="List.php">
                                    Regresar
                                </a>
                            </div>         
                        </div>
            <?php
                        break;
                        case 'errorserie':
                            ?>
                                        <div class="alert alert-danger" role="alert">
                                            <i class="bi bi-x-circle-fill"></i>
                                            EXISTEN SERIES QUE TIENEN ESTA LENGUAJE 
                                            <br>
                                            ANTES DE ELIMINAR SE DEBE CAMBIAR EL LENGUAJE DE LAS SERIES ! 
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
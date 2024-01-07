<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/FilmController.php');

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
                $filmResult = saveFilm($_POST['filmId'],$_POST['filmTitle'],$_POST['filmIsocode'],$_POST['filmTitleCurrent'],$_POST['filmIsocodeCurrent']);          
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
                        <div class="form-floating mb-3">
                            <input id="filmTitle" title="filmTitle" type="text" class="form-control" placeholder="title@example.com" value="<?php if(isset($filmObject)) echo $filmObject['title']; ?>">
                            <label for="filmTitle">Nombre de la Pelicula</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input id="filmIsocode" title="filmIsocode" type="text" class="form-control" placeholder="title@example.com" value="<?php if(isset($filmObject)) echo $filmObject['isocode']; ?>">
                            <label for="filmIsocode">Codigo ISO 639</label>
                        </div>
                        
                        <input type="hidden" title="filmId" value="<?php echo $idFilm; ?>">
                        <input type="hidden" title="filmTitleCurrent" value="<?php echo $filmObject['title']; ?>">
                        <input type="hidden" title="filmIsocodeCurrent" value="<?php echo $filmObject['isocode']; ?>">

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

                }
            ?>
            </div>
    <?php
        }
    ?>
</div>
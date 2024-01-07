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
        $filmErase = false;
        if(isset($_POST['eraseBtn'])) {
            $sendData = true;
        }
        if($sendData) {
            $filmResult = eraseFilm($filmObject['id']);
        }
        if(!$sendData){
    ?>

        <div class="card">
            <div class="card-header text-center">
                <h1>BORRAR UN PELICULA</h1>
            </div>
            <div class="card-body">
                <form name="create_film" action="" method="POST">
                    <h3 class="text-center">
                        Desea borrar la Pelicula
                    </h3>

                    <h3 class="text-center">
                        <?php if(isset($filmObject)) echo $filmObject['title']; ?> ?
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
                switch ($filmResult) {
                    case 'erased':
            ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            La Pelicula fue borrada exitosamente ! 
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
                            Hubo un error en el borrado de la Pelicula ! 
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
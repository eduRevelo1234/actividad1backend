<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/SerieController.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');
require_once(__DIR__ . '/../../Controllers/DirectorController.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE SERIES</h1>
            <p>Se podra crear, actualizar o borrar/suspender una Serie</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="View.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $serieList = listSeries();
            if (count($serieList) > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Plataforma</th>
                            <th>Director</th>
                            <th>Año</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        foreach ($serieList as $serie) {
                        ?>
                            <tr>
                                <td><?php echo $serie->getId(); ?> </td>
                                <td><?php echo $serie->getTitle(); ?></td>
                                <?php
                                    $platformList = listPlatform($serie->getIdplatform());
                                ?>   
                                <td><?php if(isset($platformList)) echo $platformList['name']; ?></td>
                                <?php
                                    $directorObject = listDirector($serie->getIddirector());
                                    //Traemos el nombre y Apellido del Director 
                                    $personObject = listPerson($directorObject['idperson']);
                                ?> 
                                <td><?php echo $personObject['name']." " .$personObject['lastname']; ?></td>
                                <td><?php echo $serie->getPremiereyear(); ?> </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="View.php?id=<?php echo $serie->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="Erase.php?id=<?php echo $serie->getId(); ?>">
                                            Borrar
                                        </a>
                                    </div>            
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="alert alert-danger" role="alert">
                    No existen registros
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<!-- Fin Contenido -->

<?php
    
    include_once(__DIR__ . '/../Templates/Footer.php');
?>
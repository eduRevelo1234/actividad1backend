<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/FilmController.php');
require_once(__DIR__ . '/../../Controllers/PlatformController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE PELICULAS</h1>
            <p>Se podra crear, actualizar o borrar/suspender una Pelicula</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="View.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $filmList = listFilms();
            if (count($filmList) > 0) {
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
                        foreach ($filmList as $film) {
                        ?>
                            <tr>
                                <td><?php echo $film->getId(); ?> </td>
                                <td><?php echo $film->getTitle(); ?></td>
                                <?php
                                    $platformList = listPlatform($film->getIdplatform());
                                ?>   
                                <td><?php if(isset($platformList)) echo $platformList['name']; ?></td>
                                <td><?php echo $film->getIddirector(); ?> </td>
                                <td><?php echo $film->getPremiereyear(); ?> </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-primary" href="View.php?id=<?php echo $film->getId(); ?>">
                                            Editar
                                        </a>
                                        &nbsp;&nbsp;
                                        <a class="btn btn-danger" href="Erase.php?id=<?php echo $film->getId(); ?>">
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
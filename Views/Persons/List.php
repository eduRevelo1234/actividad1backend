<?php
include_once(__DIR__ . '/../Templates/Header.php');
require_once(__DIR__ . '/../../Controllers/PersonController.php');
require_once(__DIR__ . '/../../Controllers/NationalityController.php');
?>

<!-- Contenido -->
<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">
            <h1>LISTADO DE PERSONAS</h1>
            <p>Se podra crear, actualizar o borrar/suspender una Persona</p>
        </div>
        <div class="card-body">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-success" href="View.php">
                    <i class="bi bi-file-earmark-plus"></i>
                    Nuevo registro
                </a>
            </div>
            <?php
            $personList = listPersons();
            if (count($personList) > 0) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Codigo Personal</th>
                            <th>Fecha Nacimiento</th>
                            <th>Nacionalidad</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        foreach ($personList as $person) {
                            $status = $person->getStatus();  
                        ?>
                            <tr>
                                <td><?php echo $person->getId(); ?> </td>
                                <td><?php echo $person->getName(); ?></td>
                                <td><?php echo $person->getLastname(); ?></td>
                                <td><?php echo $person->getCode(); ?></td>

                                <?php 
                                    //Cambio de formato de la fecha a dd/mm/aaaa
                                    $mostrarFecha = date("d/m/Y", strtotime($person->getDatebirth()));
                                ?>
                                
                                <td><?php echo $mostrarFecha; ?></td>                                
                                
                                <?php
                                    //Obtengo el listado de nacionalidades
                                    $nationalityList = listNationality($person->getIdnacionality());
                                ?>   
                                <td><?php if(isset($nationalityList)) echo $nationalityList['name']; ?></td>
                                <td><?php echo $status; ?> </td>
                                <td>
                                    <?php 
                                        if($status == 'Activa')
                                        {
                                    ?>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="View.php?id=<?php echo $person->getId(); ?>">
                                                    Editar
                                                </a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-danger" href="Activate.php?id=<?php echo $person->getId(); ?>">
                                                    Desactivar
                                                </a>
                                            </div>    
                                    <?php 
                                        } else
                                        {     
                                    ?>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-primary" href="View.php?id=<?php echo $person->getId(); ?>">
                                                    Editar
                                                </a>
                                                &nbsp;&nbsp;
                                                <a class="btn btn-success" href="Activate.php?id=<?php echo $person->getId(); ?>">
                                                    Activar
                                                </a>
                                            </div>
                                    <?php 
                                        }     
                                    ?>        
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
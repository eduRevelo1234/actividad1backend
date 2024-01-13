<!doctype html>
<html lang="en">

<head>
    <!-- Metas requeridos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Titulo e Icono -->
    <title>SeriCine</title>
    <link rel="icon" type="image/png" href="http://localhost/Sericine/Assets/fotos/tarea1.ico" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Propio CSS -->
    <link rel="stylesheet" href="http://localhost/Sericine/Assets/css/estilos.css">

</head>

<body>
    <!-- Barra de navegacion -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><span class="text-primary">Seri</span>Cine</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://localhost/Sericine/Index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://localhost/Sericine/Views/Platforms/List.php">Plataformas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="http://localhost/Sericine/Views/Films/List.php">Peliculas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Series
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="http://localhost/Sericine/Views/Series/List.php">Series</a></li>
                            <li><a class="dropdown-item" href="#">Temporadas</a></li>
                            <li><a class="dropdown-item" href="#">Capitulos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Auxiliares
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="http://localhost/Sericine/Views/Peoples/ListPeople.php">Personas</a></li>
                            <li><a class="dropdown-item" href="#">Actores</a></li>
                            <li><a class="dropdown-item" href="#">Directores</a></li>
                            <li><a class="dropdown-item" href="http://localhost/Sericine/Views/Nationality/ListNationality.php">Nacionalidades</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="http://localhost/Sericine/Views/Languages/List.php">Idiomas</a></li>
                          
                       
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!DOCTYPE html>
<html>
<head>
    <title>Tomar Asistencia</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-info navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ABM_Alumno/index.php">Alumnos</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
            <table class="table table-hover mt-3">
                <tr class="table-light">
                    <th>Apellido</th>
                    <th>Nombre</th>

                    <!-- headers de tabla vacios para que se vea bien el estilo de bootstrap -->
                    <th></th>
                </tr>

                <tr>
                <?php
                    require_once("clases/Database.php");
                    $conexion = new Database;
                    $conexion->conectar();

                    $origen = "asistencia";

                    $conexion->getListaAlumnos($origen);

                    $dniAlumno = $_GET['dni'];

                    $conexion->registrarAsistencia($dniAlumno);
                ?>
                </tr>
            </table>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
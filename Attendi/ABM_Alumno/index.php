<!DOCTYPE html>
<html>
<head>
    <title>ABM Alumno</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-info navbar-light">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Alumnos</a>
                </li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../Configuracion/index.php">Configuracion</a>
                </li>
            </ul>
        </div>
    </nav>

    <a href="alta_alumno.php" class="btn btn-primary mt-3 ms-3">Dar alta</a>

    <div class="container-fluid">
            <table class="table table-hover mt-3">
                <tr class="table-light">
                    <th>Apellido</th>
                    <th>Nombre</th>
                    <th>DNI</th>

                    <!-- headers de tabla vacios para que se vea bien el estilo de bootstrap -->
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                <?php
                    require_once("../clases/Database.php");
                    require_once("../clases/Alumno.php");
                    
                    $conexion = new Database;
                    $conexion->conectar();

                    $origen = "ABM";

                    $alumno = new Alumno('', '', '', $conexion);
                    $alumno->getListaAlumnos($origen);
                ?>
                </tr>
            </table>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
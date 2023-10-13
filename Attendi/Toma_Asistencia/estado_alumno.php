<?php
    require_once("../clases/Database.php");
    require_once("../clases/Alumno.php");
    require_once("../clases/Asistencia.php");

    $conexion = new Database;
    $conexion->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $dniAlumno = $_POST['dni_alumno'];

        $alumno = new Alumno($dniAlumno, '', '', $conexion);

        $datosAlumno = $alumno->getAlumno();

        $asistencia = new Asistencia($conexion);

        $resultado = $asistencia->totalAsistencias($dniAlumno);
        $total = $resultado[0]['total'];

        $porcentaje = $asistencia->porcentajeAsistencia($dniAlumno);
        $color_fondo = $asistencia->instanciaAlumno($porcentaje);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estado Alumno</title>
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
                    <a class="nav-link" href="../ABM_Alumno/index.php">Alumnos</a>
                </li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../Configuracion/index.php">Configuracion</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <table class="table table-hover mt-3">
            <tr class="table-light">
                <th><h5>Apellido</h5></th>
                <th><h5>Nombre</h5></th>
                <th><h5>Asistencias</h5></th>
                <th><h5>% Asistencia</h5></th>
            </tr>
            <tr class="<?php echo $color_fondo ?>">
                <td><h5> <?php echo $datosAlumno[0]['apellido']; ?> </h5></td>
                <td><h5> <?php echo $datosAlumno[0]['nombre']; ?> </h5></td>
                <td><h5> <?php echo $total; ?> </h5></td>
                <td><h5> <?php echo $porcentaje; ?> </h5></td>
            </tr>
        </table>
    </div>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
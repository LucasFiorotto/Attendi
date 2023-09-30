<?php
    require_once("../clases/Database.php");
    $conexion = new Database;
    $conexion->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $dniAlumno = $_POST['dni_alumno'];
        $nombreAlumno = $_POST['nombre_alumno'];
        $apellidoAlumno = $_POST['apellido_alumno'];

        $conexion->updateAlumno($dniAlumno, $nombreAlumno, $apellidoAlumno);
    };

    $dniAlumno = $_GET['dni'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Alumno</title>
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
        </div>
    </nav>

    <?php
       $alumno = $conexion->getAlumno($dniAlumno);
        
    ?>

    <div class="container mt-3">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" autocomplete="off">

            <label for="dni_alumno" class="form-label">DNI: </label>
            <input type="number" class="form-control" id="dni_alumno" name="dni_alumno" value="<?php echo $dniAlumno; ?>" min="1" readonly required> <br>
            <div class="row">
                <div class="col">
                    <label for="dni_alumno" class="form-label">Nombre: </label>
                    <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" value="<?php $conexion->getAlumnoNombre($dniAlumno); ?>" 
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required> <br>
                </div>
                <div class="col">
                    <label for="dni_alumno" class="form-label">Apellido: </label>
                    <input type="text" class="form-control" id="apellido_alumno" name="apellido_alumno" value="<?php $conexion->getAlumnoApellido($dniAlumno); ?>"
                    onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required> <br>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </form>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
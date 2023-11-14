<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="height: 100vh; background-image: url('../Bootstrap/icons/background.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
    <?php
        include("../navbar.php");
        error_reporting(E_ERROR | E_PARSE);
        
        $dniAlumno = $_GET['dni'];
    ?>

    <div class="d-flex justify-content-center mt-5">
        <div class="btn-group">
            <button type="button" class="btn btn-lg btn-success border rounded border-2 border-dark" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">Consulte el estado de un alumno!</button>
            <div class="dropdown-menu border border-2 border-dark p-5">
                <form action="../Toma_Asistencia/estado_alumno.php" method="post" autocomplete="off">
                    <div class="input-group input-group-lg">
                        <input type="number" class="form-control border border-dark" id="dni_alumno" placeholder="Ingresar DNI" name="dni_alumno" value="<?php echo $dniAlumno ?>" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-lg btn-primary border border-dark mt-3">Consultar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
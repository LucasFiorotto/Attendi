<!DOCTYPE html>
<html>
<head>
    <title>Gestionar Asistencias</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container pt-3 ms-1 w-25">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" autocomplete="off">
            <div class="input-group mt-3">
                <span class="input-group-text">Fecha: </span>
                <input type="date" class="form-control" name="fecha">
                <button type="submit" class="btn btn-primary">Mostrar</button>
            </div>
        </form>
    </div>

    <div class="container-fluid">
        <table class="table table-hover mt-3">
            <tr class="table-light">
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Hora</th>

                <!-- headers de tabla vacios para que se vea bien el estilo de bootstrap -->
                <th></th>
                <th></th>
            </tr>

            <tr>
                <?php
                    require_once("../clases/Database.php");
                    require_once("../clases/Asistencia.php");

                    $conexion = new Database;
                    $conexion->conectar();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $fecha = $_POST['fecha'];
                
                        $asistencia = new Asistencia($conexion);
                        $asistencia->mostrarAsistencias($fecha);
                    }
                ?>
            </tr>
        </table>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
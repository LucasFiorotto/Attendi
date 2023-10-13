<!DOCTYPE html>
<html>
<head>
    <title>Configuración</title>
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
                    <a class="nav-link" href="index.php">Configuracion</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php
        require_once("../clases/Database.php");
        require_once("../clases/Parametro.php");

        $conexion = new Database;
        $conexion->conectar();

        $parametro = new Parametro('', '', '', $conexion);
        $datosParametro = $parametro->getParametros();
    ?>

    <div class="container ms-1 w-25">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-group mt-3">
                <span class="input-group-text">Cantidad de clases (dias): </span>
                <input type="number" class="form-control" name="cdad_clases" value="<?php echo $datosParametro[0]['cdad_clases']; ?>">
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text">Porcentaje promoción: </span>
                <input type="number" class="form-control" name="porc_promocion" value="<?php echo $datosParametro[0]['porc_promocion']; ?>">
            </div>

            <div class="input-group mt-3">
                <span class="input-group-text">Porcentaje regularización: </span>
                <input type="number" class="form-control" name="porc_regular" value="<?php echo $datosParametro[0]['porc_regular']; ?>">
            </div>
        
            <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
        </form>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $cdadClases = $_POST['cdad_clases'];
            $porcPromocion = $_POST['porc_promocion'];
            $porcRegular = $_POST['porc_regular'];
    
            $parametro = new Parametro($cdadClases, $porcPromocion, $porcRegular, $conexion);
            
            $parametro->setParametros();
        }
    ?>

    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
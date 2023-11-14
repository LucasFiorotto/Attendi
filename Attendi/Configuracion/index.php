<!DOCTYPE html>
<html>
<head>
    <title>Configuración</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="height: 100vh; background-image: url('../Bootstrap/icons/background.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
    <?php include("../navbar.php"); ?>

    <?php
        require_once("../Clases/Database.php");
        require_once("../Clases/Alumno.php");
        require_once("../Clases/Parametro.php");

        $database = new Database;
        $database->conectar();

        $datosParametro = Parametro::getParametros($database);

        $minimoClases = Alumno::getMayorCantidadAsistencias($database);
    ?>

    <div class="d-flex justify-content-center mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="input-group input-group-lg">
                <span class="input-group-text border border-2 border-end-0 border-dark">Cantidad de clases (dias): </span>
                <input type="number" class="form-control border border-2 border-dark" name="cdad_clases" value="<?php echo $datosParametro[0]['cdad_clases']; ?>" min="<?php echo $minimoClases; ?>">
            </div>

            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text border border-2 border-end-0 border-dark">Porcentaje promoción: </span>
                <input type="number" class="form-control border border-2 border-dark" name="porc_promocion" value="<?php echo $datosParametro[0]['porc_promocion']; ?>" min="0" max="100">
            </div>

            <div class="input-group input-group-lg mt-3">
                <span class="input-group-text border border-2 border-end-0 border-dark">Porcentaje regularización: </span>
                <input type="number" class="form-control border border-2 border-dark" name="porc_regular" value="<?php echo $datosParametro[0]['porc_regular']; ?>" min="0" max="100">
            </div>
        
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-success btn-lg border border-2 border-dark">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $cdadClases = $_POST['cdad_clases'];
            $porcPromocion = $_POST['porc_promocion'];
            $porcRegular = $_POST['porc_regular'];

            if (($porcRegular >= $porcPromocion) && ($porcRegular && $porcPromocion != 0)){ ?>
                <script>
                    alert("El porcentaje de regularización no puede ser mayor o igual al de promoción.");
                </script>
            <?php } else {
                Parametro::setParametros($cdadClases, $porcPromocion, $porcRegular, $database);
            }
        }

        $database->desconectar();
    ?>
</body>
</html>
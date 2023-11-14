<?php
    require_once("../Clases/Database.php");
    require_once("../Clases/Alumno.php");

    $database = new Database;
    $database->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $dniAnterior = $_POST['dni_alumno_anterior'];
        $dni = $_POST['dni_alumno'];
        $nombre = $_POST['nombre_alumno'];
        $apellido = $_POST['apellido_alumno'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];

        $alumno = new Alumno($dni, $nombre, $apellido, $fechaNacimiento);

        $origenForm = "modificar";

        $advertencias = $alumno->validar_form($origenForm, $dniAnterior, $database);

        if (empty($advertencias)) {
            $alumno->updateAlumno($dniAnterior, $database);
        } else { ?>
            <script>
                alert("No se puede dar de alta al alumno por las siguientes razones:\n<?php foreach ($advertencias as $advertencia => $string) { echo "- ".$string ?>\n<?php } ?>");
                window.location.replace("modificar_alumno.php?dni=<?php echo $dni ?>");
            </script>
        <?php }
    };

    $dniAlumno = $_GET['dni'];

    $pattern = '/^[0-9]+$/';
    
    if (!preg_match($pattern, $dniAlumno)) { ?>
        <script>
            alert("El DNI solo puede contener números.");
            window.location.replace("index.php");
        </script>
    <?php }

    $datosAlumno = Alumno::getAlumno($dniAlumno, $database);

    if (empty($datosAlumno)) { ?>
        <script>
            alert("No existe alumno con tal DNI.");
            window.location.replace("index.php");
        </script>
    <?php }

    $database->desconectar();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Alumno</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="height: 100vh; background-image: url('../Bootstrap/icons/background.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
    <?php include("../navbar.php"); ?>

    <div class="d-flex justify-content-center mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">

            <input type="hidden" name="dni_alumno_anterior" value="<?php echo $dniAlumno; ?>">

            <div class="row">
                <div class="col">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border border-2 border-end-0 border-dark">DNI: </span>
                        <input type="number" class="form-control border border-2 border-dark" id="dni_alumno" placeholder="Ingresar DNI" name="dni_alumno" value="<?php echo $datosAlumno[0]['dni']; ?>" min="1" onkeypress="return (event.charCode > 47 && event.charCode < 58)" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border border-2 border-end-0 border-dark">Fecha Nacimiento: </span>
                        <input type="date" class="form-control border border-2 border-dark" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $datosAlumno[0]['fecha_nacimiento']; ?>" required>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border border-2 border-end-0 border-dark">Nombre: </span>
                        <input type="text" class="form-control border border-2 border-dark" id="nombre_alumno" placeholder="Ingresar nombre" name="nombre_alumno" value="<?php echo $datosAlumno[0]['nombre']; ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241)" required>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text border border-2 border-end-0 border-dark">Apellido: </span>
                        <input type="text" class="form-control border border-2 border-dark" id="apellido_alumno" placeholder="Ingresar apellido" name="apellido_alumno" value="<?php echo $datosAlumno[0]['apellido']; ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241)" required>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-lg btn-success border border-2 border-dark">Modificar</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
    require_once("../Clases/Database.php");
    require_once("../Clases/Alumno.php");
    require_once("../Clases/Asistencia.php");

    $database = new Database;
    $database->conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $dniAlumno = $_POST['dni_alumno'];

        $datosAlumno = Alumno::getAlumno($dniAlumno, $database);

        if (empty($datosAlumno)) { ?>
            <script>
                alert("No existe alumno registrado con tal DNI, revise y vuelva a intentar.");
                window.location.replace("../Inicio/index.php?dni=<?php echo $dniAlumno; ?>");
            </script>
        <?php } else {
            $resultado = Asistencia::totalAsistencias($dniAlumno, $database);
            $total = $resultado[0]['total'];
    
            $porcentaje = Asistencia::porcentajeAsistencia($dniAlumno, $database);
            
            $color_fondo = Asistencia::instanciaAlumno($porcentaje, $database);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estado Alumno</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="height: 100vh; background-image: url('../Bootstrap/icons/background.jpg'); background-repeat: no-repeat; background-size: 100% 100%;">
    <?php include("../navbar.php"); ?>

    <div class="d-flex justify-content-center mt-5">
        <div class="col">
            <div class="row">
                <div class="d-flex justify-content-center">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text border border-2 border-end-0 border-dark">DNI</span>
                            <input type="number" class="form-control border border-2 border-end-0 border-dark" id="dni_alumno" placeholder="Ingresar DNI" name="dni_alumno" value="<?php echo $dniAlumno ?>" required>
                            <button type="submit" class="btn btn-primary border border-2 border-dark">Consultar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <table class="table w-auto ms-5 mt-1">
                        <thead class="table">
                            <tr>
                                <th scope="col" class="h4 text-center bg-transparent"><img src="../bootstrap/icons/info-circle-fill.svg" class="bg-transparent text-info" role="img" width="52" height="52"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="table-success border border-2 border-success">
                                <td class="h5 text-center align-middle">Promoción</td>
                            </tr>
                            <tr class="table-warning border border-2 border-warning">
                                <td class="h5 text-center align-middle">Regular</td>
                            </tr>
                            <tr class="table-danger border border-2 border-danger">
                                <td class="h5 text-center align-middle">Libre</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4">
                    <div class="d-flex justify-content-center mt-4">
                        <table class="table table-hover border border-2 caption-top w-auto">
                            <caption class="text-center h5">Estado del alumno</caption>
                            <thead class="table-light border border-2 border-dark">
                                <tr>
                                    <th scope="col" class="h5 text-center">Apellido</th>
                                    <th scope="col" class="h5 text-center">Nombre</th>
                                    <th scope="col" class="h5 text-center">Asistencias</th>
                                    <th scope="col" class="h5 text-center">Porcentaje</th>
                                    <th scope="col" class="h5 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="<?php echo $color_fondo ?> border border-2 border-top-0 border-dark">
                                    <td class="h5 text-center align-middle"><?php echo $datosAlumno[0]['apellido']; ?></td>
                                    <td class="h5 text-center align-middle"><?php echo $datosAlumno[0]['nombre']; ?></td>
                                    <td class="h5 text-center align-middle"><?php echo $total; ?></td>
                                    <td class="h5 text-center align-middle"><?php echo $porcentaje."%"; ?></td>
                                    <td class="text-center align-middle" id="btn_presente"></td>

                                    <?php
                                        date_default_timezone_set('America/Argentina/Buenos_Aires');

                                        $fecha = date("Y-m-d");

                                        $fechaHora = date("Y-m-d H:i:s");

                                        $asistencias = Asistencia::mostrarAsistencias($fecha, $database);

                                        $dniAsistencias = array();

                                        foreach ($asistencias as $asistencia) {
                                            array_push($dniAsistencias, $asistencia['dni_alumno']);
                                        }

                                        if (!in_array($datosAlumno[0]['dni'], $dniAsistencias)) { ?>
                                            <script>
                                                document.getElementById("btn_presente").innerHTML = `<a href="registro_asistencia.php?dni=<?php echo $datosAlumno[0]['dni']; ?>&fecha_hora=<?php echo $fechaHora; ?>&origen=estadoAlumno" class="btn btn-success border border-dark">Presente</a>`;
                                            </script>
                                        <?php } else { ?>
                                            <script>
                                                document.getElementById("btn_presente").innerHTML = `<div class="btn btn-info border border-dark">Ya presente</div>`;
                                            </script>
                                        <?php }

                                        $database->desconectar();
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
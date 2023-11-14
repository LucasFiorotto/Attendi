<!DOCTYPE html>
<html>
<head>
    <title>Gestionar Asistencias</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:BurlyWood">
    <?php include("../navbar.php"); ?>

    <div class="d-flex justify-content-center mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
            <div class="input-group input-group-lg">
                <span class="input-group-text border border-2 border-end-0 border-dark">Fecha</span>
                <input type="date" class="form-control border border-2 border-end-0 border-dark" name="fecha" required>
                <button type="submit" class="btn btn-primary border border-2 border-dark">Mostrar</button>
            </div>
        </form>
    </div>

    <div id="tabla_asistencias"></div>

    <script>
        document.getElementById("tabla_asistencias").innerHTML = `
            <div class="d-flex justify-content-center mt-5">
                <div class="card bg-warning border-5 border-secondary">
                    <div class="card-body">
                        <h2 class="card-text">No se ha seleccionado dia para mostrar asistencias</h2>
                    </div>
                </div>
            </div>`;
    </script>

    <?php
        require_once("../Clases/Database.php");
        require_once("../Clases/Asistencia.php");

        $database = new Database;
        $database->conectar();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $fecha = $_POST['fecha'];

            $fechaFormateada = strtotime($fecha); //fecha convertida de string a tiempo para después pasarla a formato de fecha.

            $fechaFormateada = date("d/m/Y", $fechaFormateada); //fecha ya formateada.
                    
            $asistencias = Asistencia::mostrarAsistencias($fecha, $database);

            if (empty($asistencias)) { ?>
                <script>
                    document.getElementById("tabla_asistencias").innerHTML = `
                        <div class="d-flex justify-content-center mt-5">
                            <div class="card bg-danger border-5 border-secondary">
                                <div class="card-body">
                                    <h2 class="card-text">No hay asistencias registradas en el dia seleccionado</h2>
                                </div>
                            </div>
                        </div>`;
                </script>
            <?php } else { ?>
                <script>
                    document.getElementById("tabla_asistencias").innerHTML = `
                        <div class="row">
                            <div class="col-sm-4">
                                <table class="table w-auto ms-5 mt-1">
                                    <thead class="table">
                                        <tr>
                                            <th scope="col" class="h4 text-center bg-transparent"><img src="../bootstrap/icons/info-circle-fill.svg" class="bg-transparent text-info" role="img" width="52" height="52"></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="table border border-2 border-secondary">
                                            <td class="h5 text-center align-middle">--:-- = agregada, fuera de término</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-4">
                                <div class="row d-flex justify-content-center mt-4">
                                    <table class="table table-hover border border-2 caption-top w-auto">
                                        <caption class="text-center h5">Clase del <?php echo $fechaFormateada; ?></caption>
                                        <thead class="table-secondary border border-2 border-dark">
                                            <tr>
                                                <th scope="col" class="h5 text-center">Apellido</th>
                                                <th scope="col" class="h5 text-center">Nombre</th>
                                                <th scope="col" class="h5 text-center">DNI</th>
                                                <th scope="col" class="h5 text-center">Hora</th>
                                                <th scope="col" class="h5 text-center">Acciones</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php foreach ($asistencias as $asistencia) { ?>
                                            <tr class="border border-2 border-dark">
                                                <td class="h5 text-center align-middle"><?php echo $asistencia['apellido']; ?></td> 
                                                <td class="h5 text-center align-middle"><?php echo $asistencia['nombre']; ?></td>
                                                <td class="h5 text-center align-middle"><?php echo $asistencia['dni_alumno']; ?></td>
                                                <td class="h5 text-center align-middle">
                                                    <?php
                                                        if ($asistencia['time'] == "00:00:00") {
                                                            echo nl2br("--:--");
                                                        } else {
                                                            echo substr($asistencia['time'], 0, -3);
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="confirmar_eliminar_asistencia.php?id=<?php echo $asistencia['id']; ?>&fecha=<?php echo $fecha; ?>" class="btn"><img src="../bootstrap/icons/file-earmark-x-fill.svg" role="img" width="32" height="32"></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-center">
                                        <a href="agregar_asistencia.php?fecha=<?php echo $fecha; ?>" class="btn btn-success btn-lg border border-2 border-dark">Agregar Asistencia</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                </script>
            <?php }
        }

        $database->desconectar();
    ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Tomar Asistencia</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:BurlyWood">
    <?php include("../navbar.php"); ?>

    <div>
        <h4 class="d-flex justify-content-center mt-5">Fecha de hoy: <?php date_default_timezone_set('America/Argentina/Buenos_Aires'); echo date("d/m/Y"); ?> </h4>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <table class="table table-hover border border-2 caption-top w-auto">
            <caption class="text-center h5">Lista de alumnos</caption>
            <thead class="table-secondary border border-2 border-dark">
                <tr>
                    <th scope="col" class="h5 text-center">Apellido</th>
                    <th scope="col" class="h5 text-center">Nombre</th>
                    <th scope="col" class="h5 text-center">Acciones</th>
                </tr>
            </thead>
                <tr>
                    <?php
                        require_once("../Clases/Database.php");
                        require_once("../Clases/Alumno.php");

                        $database = new Database;
                        $database->conectar();

                        date_default_timezone_set('America/Argentina/Buenos_Aires');
                        $fecha = date("Y-m-d");

                        $alumnosAusentes = Alumno::getListaAlumnosAusentes($fecha, $database);

                        $fechaHora = date("Y-m-d H:i:s");

                        foreach ($alumnosAusentes as $alumno) { ?>
                            <tr class="border border-2 border-dark">
                                <td class="h5 text-center align-middle"><?php echo $alumno['apellido']; ?></td> 
                                <td class="h5 text-center align-middle"><?php echo $alumno['nombre']; ?></td>
                                <td class="text-center align-middle"><a href="registro_asistencia.php?dni=<?php echo $alumno['dni'] ?>&fecha_hora=<?php echo $fechaHora; ?>&origen=tomaAsistencia" class="btn btn-success border border-dark">Presente</a></td>
                            </tr>
                        <?php }

                        $listaAlumnos = Alumno::getListaAlumnos($database);

                        if (empty($listaAlumnos)) { ?>
                            <script>
                                alert("No se puede tomar asistencia debido a que no hay alumnos dados de alta.");
                                window.location.replace("../Inicio/index.php");
                            </script>
                        <?php }

                        if (empty($alumnosAusentes)) { ?>
                            <tr class="border border-2 border-dark">
                                <td class="h5 text-center align-middle" colspan="3">Todos los alumnos están presentes</td>
                            </tr>
                        <?php }

                        $database->desconectar();
                    ?>
                </tr>
            <tbody>

            </tbody>
        </table>
    </div>
</body>
</html>
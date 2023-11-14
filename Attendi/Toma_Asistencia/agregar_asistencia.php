<!DOCTYPE html>
<html>
<head>
    <title>Agregar Asistencia</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:BurlyWood">
    <?php
        include("../navbar.php");

        $fecha = $_GET['fecha'];

        $fechaFormateada = strtotime($fecha); //fecha convertida de string a tiempo para después pasarla a formato de fecha.

        $fechaFormateada = date("d/m/Y", $fechaFormateada); //fecha ya formateada.
    ?>

    <div>
        <h4 class="d-flex justify-content-center mt-5">Clase del <?php echo $fechaFormateada; ?> </h4>
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

                        $alumnos = Alumno::getListaAlumnosAusentes($fecha, $database);

                        foreach ($alumnos as $alumno) { ?>
                            <tr class="border border-2 border-dark">
                                <td class="h5 text-center align-middle"><?php echo $alumno['apellido']; ?></td> 
                                <td class="h5 text-center align-middle"><?php echo $alumno['nombre']; ?></td>
                                <td class="text-center align-middle"><a href="registro_asistencia.php?dni=<?php echo $alumno['dni'] ?>&fecha_hora=<?php echo $fecha; ?>&origen=agregarAsistencia" class="btn btn-success border border-dark">Presente</a></td>
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
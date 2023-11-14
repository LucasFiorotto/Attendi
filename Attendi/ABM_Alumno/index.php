<!DOCTYPE html>
<html>
<head>
    <title>ABM Alumno</title>
    <link href="../Bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color:BurlyWood">
    <?php include("../navbar.php"); ?>

    <div class="d-flex justify-content-center mt-5">
        <a href="alta_alumno.php" class="btn btn-success btn-lg border border-2 border-dark">Dar alta</a>
    </div>

    <div class="table d-flex justify-content-center mt-5">
        <table class="table table-hover border border-2 caption-top w-auto">
            <caption class="text-center h5">Lista de alumnos</caption>
            <thead class="table-secondary border border-2 border-dark">
                <tr>
                    <th scope="col" class="h5 text-center">Apellido</th>
                    <th scope="col" class="h5 text-center">Nombre</th>
                    <th scope="col" class="h5 text-center">DNI</th>
                    <th scope="col" class="h5 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once("../Clases/Database.php");
                    require_once("../Clases/Alumno.php");
                    
                    $database = new Database;
                    $database->conectar();

                    $listaAlumnos = Alumno::getListaAlumnos($database);

                    if (empty($listaAlumnos)) { ?>
                        <tr class="border border-2 border-dark">
                            <td class="h5 text-center align-middle" colspan="4">No hay alumnos dados de alta</td>
                        </tr>
                    <?php }

                    foreach ($listaAlumnos as $alumno) { ?>
                        <tr class="border border-2 border-dark">
                            <td class="h5 text-center align-middle"><?php echo $alumno['apellido']; ?></td> 
                            <td class="h5 text-center align-middle"><?php echo $alumno['nombre']; ?></td>
                            <td class="h5 text-center align-middle"><?php echo $alumno['dni']; ?></td>
                            <td>
                                <a href="modificar_alumno.php?dni=<?php echo $alumno['dni'] ?>" class="btn"><img src="../bootstrap/icons/pen-fill.svg" role="img" width="32" height="32"></a>
                                <a href="confirmar_baja_alumno.php?dni=<?php echo $alumno['dni'] ?>" class="btn"><img src="../bootstrap/icons/person-x-fill.svg" role="img" width="32" height="32"></a>
                            </td>
                        </tr>
                    <?php }

                    $database->desconectar();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
    require_once("../Clases/Database.php");
    require_once("../Clases/Alumno.php");

    $database = new Database;
    $database->conectar();

    $dniAlumno = $_GET['dni'];

    Alumno::deleteAlumno($dniAlumno, $database);

    $database->desconectar();
?>

    
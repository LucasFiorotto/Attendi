<?php
    require_once("../clases/Database.php");
    require_once("../clases/Alumno.php");

    $conexion = new Database;
    $conexion->conectar();

    $dniAlumno = $_GET['dni'];

    $alumno = new Alumno($dniAlumno, '', '', $conexion);

    $alumno->deleteAlumno();
?>
<?php
    require_once("../clases/Database.php");
    $conexion = new Database;
    $conexion->conectar();

    $dniAlumno = $_GET['dni'];

    $conexion->deleteAlumno($dniAlumno);
?>
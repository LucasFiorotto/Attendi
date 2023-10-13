<?php
    require_once("../clases/Database.php");
    require_once("../clases/Asistencia.php");

    $conexion = new Database;
    $conexion->conectar();

    $dniAlumno = $_GET['dni'];
    
    $asistencia = new Asistencia($conexion);
    $asistencia->registrarAsistencia($dniAlumno);
?>
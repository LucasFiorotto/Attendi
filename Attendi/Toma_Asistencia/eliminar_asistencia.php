<?php
    require_once("../Clases/Database.php");
    require_once("../Clases/Asistencia.php");

    $idAsistencia = $_GET['id'];
    $fecha = $_GET['fecha'];

    $database = new Database;
    $database->conectar();

    Asistencia::deleteAsistencia($idAsistencia, $fecha, $database);

    $database->desconectar();
?>
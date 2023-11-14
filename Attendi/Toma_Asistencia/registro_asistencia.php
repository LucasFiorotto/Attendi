<?php
    require_once("../Clases/Database.php");
    require_once("../Clases/Asistencia.php");

    $database = new Database;
    $database->conectar();

    $dniAlumno = $_GET['dni'];
    $origen = $_GET['origen'];
    $fechaHora = $_GET['fecha_hora'];

    if ($origen == "tomaAsistencia") {
        $fecha= substr($fechaHora, 0, -9);
        
        $asistencias = Asistencia::mostrarAsistencias($fecha, $database);
    } elseif ($origen == "agregarAsistencia") {
        $asistencias = Asistencia::mostrarAsistencias($fechaHora, $database);
    }

    $dniAlumnosAsistencia = array();
    
    foreach ($asistencias as $asistencia) {
        array_push($dniAlumnosAsistencia, $asistencia['dni_alumno']);
    }

    if (in_array($dniAlumno, $dniAlumnosAsistencia)) { ?>
        <script>
            alert("Ya se registro una asistencia para este alumno el dia de hoy.");
            window.location.replace("index.php");
        </script>
    <?php } else {
        Asistencia::registrarAsistencia($dniAlumno, $fechaHora, $origen, $database);
    }

    $database->desconectar();
?>
<?php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    class Asistencia {
        private $database;

        public function __construct($database) {
            $this->database = $database;
        }

        public function registrarAsistencia($dniAlumno) {
            $fechaHora = date("Y-m-d H:i:s");

            $sql = "INSERT INTO asistencias (dni_alumno, fecha_hora) VALUES ($dniAlumno, '$fechaHora')";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Asistencia registrada con éxito");
                location.href = "index.php";
            </script>';
        }

        public function totalAsistencias($dniAlumno) {
            $sql = "SELECT COUNT(id) as total FROM asistencias WHERE dni_alumno = '$dniAlumno'";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            return $resultado;
        }

        public function porcentajeAsistencia($dniAlumno) {
            $sql = "SELECT COUNT(id) as total FROM asistencias WHERE dni_alumno = '$dniAlumno'";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $asistencias = $stmt->fetchAll();
            $asistencias = $asistencias[0]['total'];

            $sql = "SELECT cdad_clases FROM parametros";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $cdad_clases = $stmt->fetchAll();
            $cdad_clases = $cdad_clases[0]['cdad_clases'];

            $porcentaje =  $asistencias * 100 / $cdad_clases;
            return round($porcentaje, 1);
        }

        public function instanciaAlumno($porcentaje) {
            $sql = "SELECT porc_promocion, porc_regular FROM parametros";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $parametros = $stmt->fetchAll();
            $porc_promocion = $parametros[0]['porc_promocion'];
            $porc_regular = $parametros[0]['porc_regular'];

            if ($porcentaje >= $porc_promocion) {
                $color_fondo = "table-success";
            } elseif ($porcentaje >= $porc_regular && $porcentaje < $porc_promocion) {
                $color_fondo = "table-warning";
            } else {
                $color_fondo = "table-danger";
            }

            return $color_fondo;
        }

        public function mostrarAsistencias($fecha) {
            $sql = "SELECT dni_alumno, nombre, apellido, DATE_FORMAT(fecha_hora, '%d-%m-%Y') AS 'date', TIME(fecha_hora) AS time
            FROM asistencias
            INNER JOIN alumnos ON alumnos.dni = asistencias.dni_alumno
            WHERE asistencias.date = $fecha";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $asistencias = $stmt->fetchAll();

            foreach ($asistencias as $asistencia) { ?>
                <tr>
                    <td><?php echo $asistencia['dni_alumno']; ?></td> 
                    <td><?php echo $asistencia['nombre']; ?></td>
                    <td><?php echo $asistencia['apellido']; ?></td>
                    <td><?php echo $asistencia['time']; ?></td>
                </tr>
            <?php
            }
        }
    }
?>
<?php
    class Asistencia {

        public static function registrarAsistencia($dniAlumno, $fechaHora, $origen, $database) {
            $sql = "INSERT INTO asistencias (dni_alumno, fecha_hora) VALUES ($dniAlumno, '$fechaHora')";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();

            ?> <script> alert("Asistencia registrada con éxito."); </script> <?php

            if ($origen == "tomaAsistencia") { ?>
                <script>
                    window.location.replace("index.php");
                </script>
            <?php } else if ($origen == "estadoAlumno") { ?>
                <html>
                    <form action="estado_alumno.php" method="post" id="form_estado_alumno">
                        <input type="hidden" name="dni_alumno" value="<?php echo $dniAlumno; ?>"/>
                    </form>
   
                    <script>
                        document.getElementById("form_estado_alumno").submit();
                    </script>
                </html>
            <?php } else { ?>
                <html>
                    <form action="gestion_asistencias.php" method="post" id="form_fecha">
                        <input type="hidden" name="fecha" value="<?php echo $fechaHora; ?>"/>
                    </form>
   
                    <script>
                        document.getElementById("form_fecha").submit();
                    </script>
                </html>
            <?php }
        }

        public static function deleteAsistencia($idAsistencia, $fecha, $database) {
            $sql = "DELETE FROM asistencias WHERE id = $idAsistencia";
            $stmt = $database->conn->prepare($sql);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?> <script>
                alert("Asistencia eliminada con éxito.");
            </script>

            <html>
                <form action="gestion_asistencias.php" method="post" id="form_fecha">
                    <input type="hidden" name="fecha" value="<?php echo $fecha; ?>"/>
                </form>
   
                <script>
                    document.getElementById("form_fecha").submit();
                </script>
            </html> <?php
        }

        public static function totalAsistencias($dniAlumno, $database) {
            $sql = "SELECT COUNT(id) as total FROM asistencias WHERE dni_alumno = '$dniAlumno'";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            
            return $resultado;
        }

        public static function porcentajeAsistencia($dniAlumno, $database) {
            require_once("Alumno.php");

            $sql = "SELECT COUNT(id) as total FROM asistencias WHERE dni_alumno = '$dniAlumno'";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();
            $asistencias = $stmt->fetchAll();
            $asistencias = $asistencias[0]['total'];

            $sql = "SELECT cdad_clases FROM parametros";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();
            $cdad_clases = $stmt->fetchAll();
            $cdad_clases = $cdad_clases[0]['cdad_clases'];

            $minimoClases = Alumno::getMayorCantidadAsistencias($database);

            if ($cdad_clases == 0) { ?>
                <script>
                    alert('Establezca la cantidad de clases para poder consultar.');
                    window.location.replace("../Inicio/index.php");
                </script>
            <?php } elseif ($cdad_clases < $minimoClases) { ?>
                <script>
                    alert('Debe actualizar la cantidad de clases para poder continuar\nRazón: el alumno que más asistió ha superado la cantidad de clases establecida.');
                    window.location.replace("../Inicio/index.php");
                </script>
            <?php } else {
                $porcentaje =  $asistencias * 100 / $cdad_clases;
                return round($porcentaje, 1);
            }
        }

        public static function instanciaAlumno($porcentaje, $database) {
            $sql = "SELECT porc_promocion, porc_regular FROM parametros";
            $stmt = $database->conn->prepare($sql);
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

        public static function mostrarAsistencias($fecha, $database) {
            $sql = "SELECT id, dni_alumno, nombre, apellido, TIME(fecha_hora) AS time
            FROM asistencias
            INNER JOIN alumnos ON alumnos.dni = asistencias.dni_alumno
            WHERE DATE(fecha_hora) = '$fecha'";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();
            $asistencias = $stmt->fetchAll();

            return $asistencias;
        }
    }
?>
<?php
    class Alumno {
        private $dni;
        private $nombre;
        private $apellido;
        private $fechaNacimiento;

        public function __construct($dni, $nombre, $apellido, $fechaNacimiento) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->fechaNacimiento = $fechaNacimiento;
        }

        public function validar_form($origenForm, $dniAnterior, $database) {
            $advertencias = array(); //guarda las posibles advertencias para después mostrarlas en el front.

            //validación dni.
            if (($origenForm == "alta") || ($origenForm == "modificar" && $this->dni != $dniAnterior)) {
                $alumnos = Alumno::getListaAlumnos($database);
                $dniAlumnos = array();

                foreach ($alumnos as $alumno) {
                    array_push($dniAlumnos, $alumno['dni']);
                }

                if (in_array($this->dni, $dniAlumnos)) {
                    array_push($advertencias, "Ya existe un alumno con tal DNI.");
                }
            }

            //validacion nombre.
            $nombre = str_replace(" ", "", $this->nombre); //elimina los posibles espacios en blanco.

            if (ctype_alpha($nombre) == false) { //comprueba que todos los caracteres sean alfabéticos.
                array_push($advertencias, "El nombre solo puede contener letras.");
            };

            //validacion apellido.
            $apellido = str_replace(" ", "", $this->apellido);

            if (ctype_alpha($apellido) == false) {
                array_push($advertencias, "El apellido solo puede contener letras.");
            };

            //validacion edad.
            $añoNacimiento = date('Y', strtotime($this->fechaNacimiento));
            $añoActual = date("Y");
            $años = $añoActual - $this->fechaNacimiento;

            if ($años < 17) {
                array_push($advertencias, "El alumno debe tener como mínimo 17 años.");
            }

            return $advertencias;
        }

        public function setAlumno($database) { 
            $sql = "INSERT INTO alumnos (dni, nombre, apellido, fecha_nacimiento) VALUES (:dni, :nombre, :apellido, :fecha_nacimiento)";

            $stmt = $database->conn->prepare($sql);

            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':fecha_nacimiento', $this->fechaNacimiento);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?> <script> alert("Alumno dado de alta con éxito."); </script> <?php
        }

        public static function deleteAlumno($dniAlumno, $database) {
            $sql = "DELETE FROM alumnos WHERE dni = $dniAlumno";
            $stmt = $database->conn->prepare($sql);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?> <script> alert("Alumno dado de baja con éxito."); window.location.replace("index.php"); </script> <?php
        }

        public function updateAlumno($dniAnterior, $database) {
            $sql = "UPDATE alumnos SET dni = (:dni), nombre = (:nombre), apellido = (:apellido), fecha_nacimiento = (:fecha_nacimiento) WHERE dni = $dniAnterior";

            $stmt = $database->conn->prepare($sql);

            $stmt->bindParam(':dni', $this->dni);
            $stmt->bindParam(':nombre', $this->nombre);
            $stmt->bindParam(':apellido', $this->apellido);
            $stmt->bindParam(':fecha_nacimiento', $this->fechaNacimiento);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            ?> <script> alert("Alumno modificado con éxito."); window.location.replace("index.php"); </script> <?php
        }

        public static function getAlumno($dniAlumno, $database) {
            $sql = "SELECT * FROM alumnos WHERE dni = $dniAlumno";
            $stmt = $database->conn->prepare($sql);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            $datos = $stmt->fetchAll();
            
            return $datos;
        }

        public static function getListaAlumnos($database) {
            $sql = "SELECT * FROM alumnos ORDER BY apellido";
            $stmt = $database->conn->prepare($sql);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        
            $alumnos = $stmt->fetchAll();

            return $alumnos;
        }

        public static function getListaAlumnosAusentes($fecha, $database) {
            $sql = "SELECT * FROM alumnos WHERE dni NOT IN (SELECT dni_alumno FROM asistencias WHERE DATE(asistencias.fecha_hora) = '$fecha') ORDER BY apellido";
            $stmt = $database->conn->prepare($sql);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    
            $alumnos = $stmt->fetchAll();

            return $alumnos;
        }

        public static function getMayorCantidadAsistencias($database) {
            require_once("Asistencia.php");
            
            $alumnos = Alumno::getListaAlumnos($database);
            $dniAlumnos = array();

            foreach ($alumnos as $alumno) {
                array_push($dniAlumnos, $alumno['dni']);
            }
            
            $totalAsistencias = array();

            foreach ($dniAlumnos as $dniAlumno) {
                $asistencias = Asistencia::totalAsistencias($dniAlumno, $database);
                array_push($totalAsistencias, $asistencias[0]['total']);
            }

            if (empty($totalAsistencias)) {
                return 0;
            } else {
                return max($totalAsistencias);
            }
        }
    }
?>
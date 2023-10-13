<?php
    class Alumno {
        private $dni;
        private $nombre;
        private $apellido;
        private $database;

        public function __construct($dni, $nombre, $apellido, $database) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->database = $database;
        }

        public function setAlumno() {
            $sql = "INSERT INTO alumnos (dni,nombre,apellido) VALUES (:dni_alumno, :nombre_alumno, :apellido_alumno)";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->bindParam(":dni_alumno", $this->dni);
            $stmt->bindParam(":nombre_alumno", $this->nombre);
            $stmt->bindParam(":apellido_alumno", $this->apellido);

            try {
                $stmt->execute();
            } catch(PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo '<script> alert("DNI ya existe");
                    location.href = "alta_alumno.php";
                    </script>';
               }
            }

            echo '<script> alert("Alumno dado de alta con éxito"); </script>';

            /*echo '<div class="container w-25 mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Alumno dado de alta con éxito</strong>
                </div>
            </div>';*/
        }

        public function deleteAlumno() {
            $sql = "DELETE FROM alumnos WHERE dni = '$this->dni'";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Alumno dado de baja con éxito");
            location.href = "index.php";
            </script>';
        }

        public function updateAlumno() {
            $sql = "UPDATE alumnos SET nombre = '$this->nombre', apellido = '$this->apellido' WHERE dni = '$this->dni'";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Alumno modificado con éxito");
                location.href = "index.php";
            </script>';
        }

        public function getAlumno() {
            $sql = "SELECT * FROM alumnos WHERE dni = '$this->dni'";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function getListaAlumnos($origen) {
            $sql = "SELECT * FROM alumnos ORDER BY apellido";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            $alumnos = $stmt->fetchAll();
            
            if ($origen == "ABM") {
                foreach ($alumnos as $alumno) { ?>
                    <tr>
                        <td><?php echo $alumno['apellido']; ?></td> 
                        <td><?php echo $alumno['nombre']; ?></td>
                        <td><?php echo $alumno['dni']; ?></td>
                        <?php echo "<td>
                            <a href='modificar_alumno.php?dni=".$alumno['dni']."' class='btn btn-info'>Modificar</a>
                            <a href='baja_alumno.php?dni=".$alumno['dni']."' class='btn btn-danger'>X</a>
                        </td>"; ?>
                    </tr>
                <?php
                }
            } elseif ($origen == "asistencia") {
                foreach ($alumnos as $alumno) { ?>
                    <tr>
                        <td><?php echo $alumno['apellido']; ?></td> 
                        <td><?php echo $alumno['nombre']; ?></td>
                        <?php echo "<td>
                            <a href='registro_asistencia.php?dni=".$alumno['dni']."' class='btn btn-success'>Presente</a>
                        </td>"; ?>
                    </tr>
                <?php
                }
            }
        }
    }
?>
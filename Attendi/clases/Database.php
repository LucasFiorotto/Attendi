<?php
    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "sistema_asistencia";
        private $conn;

        public function conectar() {
            try {
                $this->conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //echo "Connected successfully";
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        public function getListaAlumnos($origen) {
            $sql = "SELECT * FROM alumnos ORDER BY apellido";
            $stmt = $this->conn->prepare($sql);
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

        public function setAlumno($dniAlumno, $nombreAlumno, $apellidoAlumno) {
            $sql = "INSERT INTO alumnos (dni,nombre,apellido) VALUES (:dni_alumno, :nombre_alumno, :apellido_alumno)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":dni_alumno", $dniAlumno);
            $stmt->bindParam(":nombre_alumno", $nombreAlumno);
            $stmt->bindParam(":apellido_alumno", $apellidoAlumno);
            
            try {
                $stmt->execute();
            } catch(PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo '<script> alert("DNI ya existe");
                    location.href = "alta_alumno.php";
                    </script>';
               }
            }

            //echo '<script> alert("Alumno dado de alta con éxito"); </script>';
            echo '<div class="container w-25 mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Alumno dado de alta con éxito</strong>
                </div>
            </div>';
        }

        public function updateAlumno($dniAlumno, $nombreAlumno, $apellidoAlumno) {
            $sql = "UPDATE alumnos SET nombre = '$nombreAlumno', apellido = '$apellidoAlumno' WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Alumno modificado con éxito");
                location.href = "index.php";
            </script>';
        }

        public function deleteAlumno($dniAlumno) {
            $sql = "DELETE FROM alumnos WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Alumno dado de baja con éxito");
            location.href = "index.php";
            </script>';
        }

        public function getAlumno($dniAlumno) {
            $sql = "SELECT * FROM alumnos WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return  $stmt->fetchAll();
        }

        public function getAlumnoNombre($dniAlumno) {
            $sql = "SELECT nombre FROM alumnos WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $alumno = $stmt->fetchAll();
            echo $alumno[0]['nombre'];
        }

        public function getAlumnoApellido($dniAlumno) {
            $sql = "SELECT apellido FROM alumnos WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $alumno = $stmt->fetchAll();
            echo $alumno[0]['apellido'];
        }

        public function registrarAsistencia($dniAlumno) {
            $sql = "INSERT apellido FROM alumnos WHERE dni = '$dniAlumno'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $alumno = $stmt->fetchAll();
        }
    }
?>
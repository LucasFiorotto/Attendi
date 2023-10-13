<?php
    class Parametro {
        private $cdadClases;
        private $porcPromocion;
        private $porcRegular;
        private $database;

        public function __construct($cdadClases, $porcPromocion, $porcRegular, $database) {
            $this->cdadClases = $cdadClases;
            $this->porcPromocion = $porcPromocion;
            $this->porcRegular = $porcRegular;
            $this->database = $database;
        }

        public function setParametros() {
            $sql = "DELETE FROM parametros";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();

            $sql = "INSERT INTO parametros (cdad_clases, porc_promocion, porc_regular) VALUES ($this->cdadClases, $this->porcPromocion, $this->porcRegular)";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();

            echo '<script> alert("Datos guardados con éxito");
            location.href = "index.php";
            </script>';
        }

        public function getParametros() {
            $sql = "SELECT * FROM parametros";
            $stmt = $this->database->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>
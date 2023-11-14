<?php
    class Parametro {
        public static function setParametros($cdadClases, $porcPromocion, $porcRegular, $database) {
            $sql = "UPDATE parametros SET cdad_clases = $cdadClases, porc_promocion = $porcPromocion, porc_regular = $porcRegular";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();

            ?> <script>
                alert("Datos guardados con éxito.");
                window.location.replace("index.php");
            </script> <?php
        }

        public static function getParametros($database) {
            $sql = "SELECT * FROM parametros";
            $stmt = $database->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }
?>
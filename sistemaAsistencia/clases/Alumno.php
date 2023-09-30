<?php
    class Alumno {
        private $dni;
        private $nombre;
        private $apellido;

        private function __construct($dni, $nombre, $apellido) {
            $this->dni = $dni;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
        }
    }
?>
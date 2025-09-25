<?php
    class Libro{
        public  $titulo;
        public  $autor;
        public  $añoPublicacion;
        public  $disponible;

        public function __construct($titulo,$autor,$añoPublicacion,$disponible){
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->añoPublicacion = $añoPublicacion;
            $this->disponible = $disponible;
        }
    }
?>
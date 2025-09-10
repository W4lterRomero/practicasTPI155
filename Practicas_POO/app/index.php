<?php

class Perro{
    public $raza;
    public $color;
    private $enfermo;
    public $nombre;
    protected $salud;

}

class Pitbull extends Perro{

    function ladrar($nombre){
        echo "$nombre esta ladrando";
    }
}


$nw = new Pitbull();

$nw->ladrar("el mambo de la banda");

?>
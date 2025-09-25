<?php
class Carro {
    public $color;
    public $ruedas;
    private $motor;
    public $marca;
    public $puertas;

    function __construct($marca, $puertas, $color, $ruedas = 4, $motor = "1.6L") {
        $this->color = $color;
        $this->marca = $marca;
        $this->puertas = $puertas;
        $this->ruedas = $ruedas;
        $this->motor = $motor; // como es privado, lo definimos aquí
    }

    function get_motor() {
        return $this->motor;
    }
    function prueba(){
        return "LALALALALLA";
    }
}

// Crear un objeto
$chevy = new Carro("Chevrolet", 4, "Rojo");

// Probar
echo "Marca: " . $chevy->marca . "<br>";
echo "Color: " . $chevy->color . "<br>";
echo "Puertas: " . $chevy->puertas . "<br>";
echo "Ruedas: " . $chevy->ruedas . "<br>";
echo "Motor: " . $chevy->get_motor();
?>

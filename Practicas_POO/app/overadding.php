<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

    class Perro{
        public $raza;
        public $orejas;

        public function __construct($raza,$orejas)
        {
            $this->raza = $raza;
            $this->orejas = $orejas;
        }

        public function intro(){
            echo "la raza es {$this->raza} y las orejas son tipo {$this->orejas}";
        }
    }

    class Pitbull extends Perro{
        public $peso;

        public function __construct($raza,$orejas, $peso)
        {
            $this->raza = $raza;
            $this->raza = $raza;
            $this->orejas = $orejas;

        }
    }

$wachu = new Perro("sadf","wow");

print_r($wachu);
//¿Que imprime?
?>
</body>
</html>
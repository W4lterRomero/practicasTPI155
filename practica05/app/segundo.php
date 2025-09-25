<!-- La empresa Lorena desea calcular la cantidad a pagar, además de saber 
cuánto será el
importe a pagar de AFP, ISSS, renta. Se desea una aplicación web que 
reciba el nombre del
empleado y el salario base dicha aplicación debe calcular los descuentos 
de los empleados
y mostrar el salario menos los descuentos. y colocar mensajes en colores 
según el tramo de
renta en el que está el empleado.
- ISSS 3%
- Aporte patronal 7.5%
- Aporte del empleado 3% -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form methor="get">
        <label for="">Nombre</label>
        <input type="text">
        <label for="">Salario</label>
        <input type="number" step="0.01" name = "salario">
        <input type="submit" value="Buscar" name = "buscar">
    </form>

<?php 
    if(($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["salario"])){
        $salario = $_GET["salario"];
        $salarioTotal = $salario-($salario*0.03)-($salario*0.07)-($salario*0.03);
        $salarioTotal = number_format($salarioTotal,2);
         $total = 0;
        if($salarioTotal<472){
            echo "no se te aplicaran tramos";
        }
        if($salarioTotal >472.01 && $salarioTotal<=895.24){
            echo "lo que tienes de salario es: {$salarioTotal}";
            $total = $salarioTotal-($salarioTotal*0.10)-17.67;
            echo "so el final es: {$total}";
        }
        if($salarioTotal <=2038.10 && $salarioTotal>895.24){
            echo "lo que tienes de salario es: {$salarioTotal}";
            $total = $salarioTotal-($salarioTotal*0.20)-60;
            echo "so el final de salario es: {$total}";
        }
        if($salarioTotal >=2038.10){
            echo "lo que tienes de salario es: {$salarioTotal}";
            $total = $salarioTotal-($salarioTotal*0.30)-288.57;
            echo "so el final es: {$total}";
        }
    } 
?>
</body>
</html>
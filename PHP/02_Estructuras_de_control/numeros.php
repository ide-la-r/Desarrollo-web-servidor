<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>numeros</title>
</head>
<body>
    <?php
    //  Forma 1
        $numero = 23;

        if($numero > 0)
            echo "<p>1. El numero $numero es mayor que 0</p>";
        elseif($numero == 0)
            echo "<p>2. El numero $numero es 0</p>";
        else
            echo "<p>3. El numero $numero es menor que 0</p>";

    //  Forma 2
        if($numero > 0){
            echo "<p>1. El numero $numero es mayor que 0</p>";
        }
        else{
            echo "<p>2. El numero $numero es menor que 0</p>";
        }

    //  Forma 3
    //El endif solo se pone cuando se hace el if asi :
        if($numero > 0):
            echo "<p>1. El numero $numero es mayor que 0</p>";
        else:
            echo "<p>2. El numero $numero es menor que 0</p>";
        endif;// si es la ultima instruccion no hace falta poner el punto y coma.

    #Para comparaciones podemo usar and y &&
        if($numero >= -10 and $numero <0)
            echo "<p>1. El numero $numero esta en el rango de -10 a 0</p>";
        elseif($numero >= 0 && $numero <= 10)
            echo "<p>2. El numero $numero esta en el rango de 0 y 10</p>";
        elseif($numero >= 10 && $numero <= 20)
            echo "<p>2. El numero $numero esta en el rango de 10 y 20</p>";
        else
            echo "<p>3. El numero $numero no esta en el rango establecido</p>";

    //Numeros aleatorios entre el 1 y el 200, incluye a los dos.
    $numero_aleatorio = rand(1,200);

    $numero_aleatorio_decimales = rand(10,100)/10;

    /*Comprobar de tres formas diferentes, con la estructura if, si el numero aleatorio
    tiene 1, 2 o 3 digitos */

    $digitos = null;
        if($numero_aleatorio >= 0 and $numero_aleatorio < 10)
            $digitos = 1;
        elseif($numero_aleatorio >= 10 && $numero < 100)
            $digitos = 2;
        elseif($numero_aleatorio >= 100)
            $digitos = 3;
        else
            $digitos = "ERROR";

    //VERSION CON MATCH
    $digitos = match (true) {
        $numero_aleatorio >= 1 && $numero_aleatorio <= 9 =>1,
        $numero_aleatorio >= 10 && $numero_aleatorio <= 99 =>2,
        $numero_aleatorio >= 100 && $numero_aleatorio <= 999 =>3,
        default => "ERROR"
    };

    echo "<p>El numero tiene $digitos digitos</p>";
    
    $n = rand(1,3);

    switch($n){
        case 1:
            echo "el numero es 1";
            break;
        case 2:
            echo "el numero es 2";
            break;
        case 3:
            echo "el numero es 3";
            break;
        default:
            echo "ERROR";
            break;//este no haria falta
    }

    $resultado = match($n) {
        1 => "El numero es 1",
        2 => "El numero es 2",
        3 => "El numero es 3"
    };

    echo "<h3>$resultado</h3>";
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio fechas</title>
</head>
<body>
<!-- 
    Ejercicio 1: MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO:
        Viernes 27 de Septiembre de 2024
    UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS
    
    EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NÚMEROS MÚLTIPLOS DE 3 USANDO
    WHILE E IF

    EJERCICIO 3: CALCULAR LA SUMA DE LOS NÚMEROS PARES ENTRE 1 Y 20

    EJERCICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE
-->
    <?php

        $dia = date("N");
        $dia = match ($dia) {
            "1" => "Lunes",
            "2" => "Martes",
            "3" => "Miercoles",
            "4" => "Jueves",
            "5" => "Viernes",
            "6" => "Sabado",
            "7" => "Domingo"
        };

        $diaNumero = date("j");
        $mes = date("n");
        $mes = match ($mes) {
            "1" => "Enero",
            "2" => "Febrero",
            "3" => "Marzo",
            "4" => "Abril",
            "5" => "Mayo",
            "6" => "Junio",
            "7" => "Julio",
            "8" => "Agosto",
            "9" => "Septiembre",
            "10" => "Octubre",
            "11" => "Noviembre",
            "12" => "Diciembre"
        };
        $ano = date("Y");

        echo "<h3>$dia $diaNumero de $mes de $ano</h3>";

        echo "<h1>Ejercicio 2</h1>";
        //2.
        $i = 0;
        while ($i <= 100) {
            if ($i % 3 == 0) {
                echo "<p>El numero: $i es multiplo de 3</p>";
            }
            $i++;
        }

        echo "<h1>Ejercicio 3</h1>";
        //3.
        $suma = 0;
        for ($i=0; $i < 20; $i++) { 
            if ($i % 2 == 0) {
                $suma += $i;
            }
        }
        echo "<p>La suma de todos los numeros pares de 1 a 20 es $suma</p>";

        echo "<h1>Ejercicio 4</h1>";
        //4.
        $factorial = 1;
        for ($i=1; $i <= 6; $i++) { 
            $factorial *= $i;
        }
        echo "<p>El factorial de 6 es $factorial</p>";

        //No para hasta que te saque 50 primos.
        $numero = 2;
        $numerosPrimos = 0;

        echo "<ol>";
        while($numerosPrimos < 50){
            $esPrimo = true;
            for ($i=2; $i < $numero; $i++) { 
                if ($numero % $i == 0) {
                    $esPrimo = false;
                    break;
                }
            }
            if ($esPrimo) {
                $numerosPrimos++;
                echo "<li>$numero</li>";
            }
            $numero++;
        }
        echo "</ol>";

//Git fetch lo que hace es descargarse la informacion de los cambios de github
//Git status para ver lo que hay que cambiar y luego el pull
    ?>
</body>
</html>
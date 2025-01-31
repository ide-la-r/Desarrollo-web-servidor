<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fechas</title>
</head>
<body>
    <?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 ); 

    $numero = "2";

    if($numero == 2)// En php se pueden comparar numeros string con int
        echo "EXITO";
    else
        echo "NO EXITO";

    if($numero === 2) //Esto es que es el mismo numero y que es del mismo tipo
        echo "EXITO";
    else
        echo "NO EXITO";

    /*
    "2" es igual a 2 
    "2" no es identico a 2
    2 si es identico a 2
    2 no es identico a 2.0
    */

    $hora = (int)date("G");//esto te dice la hora en la que estamos en formato de hora
    //Se castea a int porque sale como cadena.
    var_dump($hora); //esto era para ver la informacion de la variable.

    $hora_exacta = date("H:i:s");
    echo "<h1>$hora_exacta</h1>";
    /*
        Si $hora entre 6 y 11, es mañana
        Si $hora entre 12 y 14, es mediodia
        Si $hora entre 15 y 20, es tarde
        Si $hora entre 20 y 0, es noche
        Si $hora entre 1 y 5, es madrugada
    */

    $dia = date("l");
    echo "Hoy es $dia";

    /*Tenemos clase los lunes mirecoles y viernes, haz un siwtch si tenemos clase hoy */

    switch($dia){
        case "Monday":
        case "Wednesday":
        case "Friday":
            echo "Hoy tenemos clase y es $dia";
            break;
        default:
            echo "Hoy no tenemos clase y es $dia";
    }

    $dia_espanol = match($dia){
        "Monday" => "Lunes",
        "Tuesday" => "Martes",
        "Wednesday" => "Miercoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sabado",
        "Sunday" => "Domingo"
    };

    echo "<h3>$dia_espanol</h3>";
    ?>
</body>
</html>
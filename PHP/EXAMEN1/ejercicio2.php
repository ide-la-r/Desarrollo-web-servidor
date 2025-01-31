<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 examen</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <?php
        $array1 = [];
        $array2 = [];
        $array3 = [];

        for ($i=0; $i < 5; $i++) { 
            $array1[$i] = rand(1,10);
        }

        for ($i=0; $i < 5; $i++) { 
            $array2[$i] = rand(10,100);
        }

        array_push($array3, $array1);
        array_push($array3, $array2);

        for ($i=0; $i < count($array1); $i++) { 
            echo $array1[$i] . ", ";
        }
        echo "<br><br>";
        for ($i=0; $i < count($array2); $i++) { 
            echo $array2[$i] . ", ";
        }

        $maximo1 = $array1[0];
        $minimo1 = $array1[0];
        $media1 = 0;
        for ($i=0; $i < count($array1); $i++) { 
            if ($maximo1 < $array1[$i]) {
                $maximo1 = $array1[$i];
            }
            if ($minimo1 > $array1[$i]) {
                $minimo1 = $array1[$i];
            }
            $media1 += $array1[$i];
        }
        $media1 = ($media1/count($array1));
        echo "<br><br>";
        echo "El valor maximo del primer array es: " . $maximo1;
        echo "<br>";
        echo "El valor minimo del primer array es: " . $minimo1;
        echo "<br>";
        echo "La media de todos los valores del primer array es: " . $media1;

        $maximo2 = $array2[0];
        $minimo2 = $array2[0];
        $media2 = 0;
        for ($i=0; $i < count($array2); $i++) { 
            if ($maximo2 < $array2[$i]) {
                $maximo2 = $array2[$i];
            }
            if ($minimo2 > $array2[$i]) {
                $minimo2 = $array2[$i];
            }
            $media2 += $array2[$i];
        }
        $media2 = ($media2/count($array2));
        echo "<br><br>";
        echo "El valor maximo del segundo array es: " . $maximo2;
        echo "<br>";
        echo "El valor minimo del segundo array es: " . $minimo2;
        echo "<br>";
        echo "La media de todos los valores del segundo array es: " . $media2;
    ?>
</body>
</html>
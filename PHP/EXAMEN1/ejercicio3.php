<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 examen</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="numero">
        <select name="calculo" id="calculo">
            <option value="factorial">Factorial</option>
            <option value="sumatorio">Sumatorio</option>
        </select>
        <input type="submit" name="Calcular">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $numero = $_POST["numero"];
            $eleccion = $_POST["calculo"];
            $factorial = 1;
            $sumatorio = 0;

            if ($eleccion == "factorial") {
                if ($numero != 0) {
                    for ($i=1; $i <= $numero; $i++) { 
                        $factorial *= $i;
                    }
                }
                echo "<p>El factorial de $numero es $factorial</p>";
            }
            else if ($eleccion == "sumatorio") {
                for ($i=1; $i <= $numero; $i++) { 
                    $sumatorio += $i;
                }
                echo "<p>El sumatorio de $numero es $sumatorio</p>";
            }
        }
    ?>
    
</body>
</html>
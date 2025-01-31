<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require ("../05_funciones/potencias.php");
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="base">Base</label>
        <input type="text" name="base" id="base"><br><br>
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente"><br><br>
        <input type="submit" value="Enviar">
    </form>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $base = $_POST["base"];
            $exponente = $_POST["exponente"];
            $solucion = 1;

            if ($base != '') {//filtra la variable base y comprueba que es int
                if (filter_var($base, FILTER_VALIDATE_INT) !== FALSE) {//si le pones solo un = detecta que 0 no es un numero, asi si lo detecta.
                    $tmp_base = $base;
                } else{
                    echo "La base debe ser un numero";
                }
            } else{
                echo "<p>La base es obligatoria</p>";
            }

            //es lo mismo que lo de arriba pero planteado alrreves
            /*if ($base == '') {
                echo "<p>La base es obligatoria</p>";
            } else{
                if (filter_var($base, FILTER_VALIDATE_INT) === FALSE) {
                    echo "La base debe ser un numero";
                } else{
                    $tmp_base = $base;
                }
            }*/

            if ($exponente != '') {
                if (filter_var($exponente, FILTER_VALIDATE_INT) !== FALSE) {
                    if ($exponente >= 0) {
                        $temp_exponente = $exponente;
                    } else{
                        echo "<p>El exponente debe ser mayor o igual a 0</p>";
                    }
                } else{
                    echo "El exponente debe ser un numero";
                }
            } else{
                echo "<p>El exponente es obligatoria</p>";
            }

            if (isset($temp_base) && isset($temp_exponente)) {
                potencias($temp_base, $temp_exponente);
            }
        }
    ?>
</body>
</html>
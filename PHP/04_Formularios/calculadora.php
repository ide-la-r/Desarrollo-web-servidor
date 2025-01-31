<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">

    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="numero">Numero</label>
        <input type="text" name="numero" id="numero"><br><br>
        <input type="submit" value="Enviar">
    </form>
 

        <!--
          * Crea un formulario que reciba un numero 
          * Se mostrara la tabla de multiplicar de ese numero en una tabla HTML
          * 2 x 1 = 2
          * 2 x 2 = 4
          * ...
          -->
          <br><br>
        <table>
                <?php
                    $numero = $_POST["numero"];
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        for ($i=1; $i < 11; $i++) {;
                            echo "<tr>";
                            echo "<td>$numero x $i </td>";
                            echo "<td> = </td>";
                            echo "<td> " . ($numero * $i) . " </td>";
                            echo "</tr>";
                        }  
                    }
                ?>
        </table>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edades</title>
    
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <form action="" method="post">
        <label for="edad">Edad</label>
        <input type="text" name="edad" id="edad"><br><br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"><br><br>
        <input type="submit" value="Enviar">
        
        
    </form>
    
    <?php
        /***
         * Crear un formulario que reciba el nombre y la edad de una persona
         * Si la edad es menor de 18, se mostrara el nombre y que es menor de edad
         * Si la edad esta entre 18 y 65, se mostrara el nombre y que es mayor de edad
         * SI la edad es mas de 65, se mostrara el nombre y que se ha jubilado
         */

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $edad = $_POST["edad"];
            $nombre = $_POST["nombre"];
            if ($edad < 18) {
                echo "<h2>$nombre es menor de edad con $edad años</h2>";
            } elseif ($edad >=18 && $edad <= 65) {
                echo "<h2>$nombre es mayor de edad con $edad años</h2>";
            } elseif ($edad > 65) {
                echo "<h2>$nombre esta jubilado con $edad años</h2>";
            }
        }
    ?>
    
    <?php
        /***
          * Crea un formulario que reciba un numero 
          * Se mostrara la tabla de multiplicar de ese numero en una tabla HTML
          * 2 x 1 = 2
          * 2 x 2 = 4
          * ...
          */
        
        
    ?>
</body>
</html>
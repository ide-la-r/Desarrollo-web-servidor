<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Ejemplo</title>
</head>
<body>
    <!-- Si no ponemos nada es singel page y si no es se pone el nombre del archivo -->
    <form action="" method="post">
        <input type="text" name="mensaje">
        <input type="text" name="mensaje2">
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        /***
         * Este codigo se ejecuta cuando el servidor recibe una peticion POST
         */
        $mensaje = $_POST["mensaje"];//lo de entre comillas tiene que ser igual al input
    }
        //añadir al formulario un campo de texto adicional para introducir un numero
        //mostrar el mensaje tantas veces como indique el numero
    
        $mensaje2 = $_POST["mensaje2"];
        for ($i=0; $i < $mensaje2; $i++) { 
            echo "<h1>$mensaje</h1>";
        }
    ?>
</body>
</html>
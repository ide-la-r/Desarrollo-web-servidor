<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    define("PI", 3.14);

    echo "<h1>PI vale: " . PI . "</h1>";
    $mensaje = "Hola mundo";
    echo "<h1>EL 'MENSAJE'ES $mensaje</h1>" . "y AQUI CONCATENO CON OTRA CADENA";
    
    $numero = 3;
    var_dump($numero);

    $numero_float = 3.1;
    var_dump($numero_float);


    var_dump($mensaje);
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
        require('../05_funciones/depurar.php');
    ?>
</head>
<body>
    <?php 
    if($_SERVER["REQUEST_METHOD"]== "POST"){
        $tmp_nombre_estudio = depurar($_POST["nombre_estudio"]);
        $tmp_ciudad = depurar($_POST["ciudad"]);

        if($tmp_nombre_estudio == ''){
            $err_nombre_estudio = "El nombre del estudio es un campo obligatorio";
        }else{
            $patron = "/^[a-zA-Z0-9 áéíóúÁÉÍÓÚÑñ]*$/";
            if(!preg_match($patron, $tmp_nombre_estudio)){
                $err_nombre_estudio = "El nombre del estudio solo puede contener letras y números";
            }else{
                $nombre_estudio = $tmp_nombre_estudio;
            }
        }

        if($tmp_ciudad == ''){
            $err_ciudad = "La ciudad es un campo obligatorio";
        }else{
            $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚÑñ]*$/";
            if(!preg_match($patron, $tmp_ciudad)){
                $err_ciudad = "La ciudad solo puede contener letras";
            }else{
                $ciudad = $tmp_ciudad;
            }
        }
    }
    ?>
    <form action="" method="post">
        <h1>Formulario Nuevo Estudio</h1>
        <label>Nombre Estudio</label>
        <input type="text" name="nombre_estudio">
        <?php if(isset($err_nombre_estudio)) echo "<span class='error'>$err_nombre_estudio</span>";?>
        <label>Ciudad</label>
        <input type="text" name="ciudad">
        <input type="submit" value="Enviar">
        <?php if(isset($err_ciudad)) echo "<span class='error'>$err_ciudad</span>";?>
    </form>

    <?php 
        if(isset($nombre_estudio) && isset($ciudad)){
            echo "<h2>Estudio creado</h2>";
            echo "<p>Nombre Estudio: $nombre_estudio</p>";
            echo "<p>Ciudad: $ciudad</p>";
        }
    ?>
    
</body>
</html>
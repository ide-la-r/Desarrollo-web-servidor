<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Varios formularios</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require ('../05_funciones/temperaturas.php');
        require ('../05_funciones/edades.php');
    ?>
</head>
<body>
    
<!-- Cada formulario va separado, el hidden es un valor oculto que mandaremos para saber que formulario es -->

<form action="" method="post">
    <h1>Formulario Tempereturas</h1>
    <p>Temperatura: </p>
    <input type="text" name="temperatura"><br>
    <p>Unidad: </p>
    <select name="unidad_old" id="unidad_old">
        <option value="celsius">CELSIUS</option>
        <option value="kelvin">KELVIN</option>
        <option value="fahrenheit">FAHRENHEIT</option>
    </select>
    <p>Convertir a: </p>
    <select name="unidad_new" id="unidad_new">
        <option value="celsius">CELSIUS</option>
        <option value="kelvin">KELVIN</option>
        <option value="fahrenheit">FAHRENHEIT</option>
    </select>
    <input type="hidden" name="accion" value="formulario_temperaturas">
    <input type="submit" name="Convertir">
</form>


<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //formulario edades
        echo "<h3>Solucion edades:</h3>";
        if ($_POST["accion"] == "formulario_edades") {
            $edad = $_POST["edad"];
            $nombre = $_POST["nombre"];

            comprobarEdad($nombre, $edad);
        }
    }
    
?>

<form  action="" method="post">
    <h1>Formulario Edades</h1>
    <label for="edad">Edad</label>
    <input type="text" name="edad" id="edad"><br><br>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre"><br><br>
    <input type="hidden" name="accion" value="formulario_edades">
    <input type="submit" value="Enviar">
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //formulario temperaturas
        if ($_POST["accion"] == "formulario_temperaturas") {
            $temperatura = $_POST["temperatura"];
            $unidad_old = $_POST["unidad_old"];
            $unidad_new = $_POST["unidad_new"];
            
            if ($temperatura != '') {
                if (is_numeric($temperatura)) {
                    if ($unidad_old == "C" and $temperatura >= -273.15) {
                        convertirTemperatura($temperatura, $unidad_old, $unidad_new);
                    } elseif ($unidad_old == "C" and $temperatura < -273.15) {
                        echo "<p>La temperatura no puede ser inferior a -273.15 C</p>";
                    }
                    if ($unidad_old == "K" and $temperatura >= 0) {
                        convertirTemperatura($temperatura, $unidad_old, $unidad_new);
                    } elseif ($unidad_old == "K" and $temperatura < 0) {
                        echo "<p>La temperatura no puede ser inferior a 0 K</p>";
                    }
                    if ($unidad_old == "F" and $temperatura >= -459.67) {
                        convertirTemperatura($temperatura, $unidad_old, $unidad_new);
                    } elseif ($unidad_old == "F" and $temperatura < -459.67) {
                        echo "<p>La temperatura no puede ser inferior a -459.67 F</p>";
                    }
                } else{
                    echo "<p>La temperatura debe ser un nnumero</p>";
                }
            } else {
                echo "<p>Falta la temperatura</p>";
            }
            
        }
    }
    //Hacer todos los formularios que hemos hecho dentro de un fichero en conjunto, y hacerlo con funciones/minimo 4
?>

</body>
</html>
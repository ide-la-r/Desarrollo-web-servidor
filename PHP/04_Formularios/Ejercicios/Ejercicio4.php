<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de temperaturas</title>
</head>
<body>
<h2>Introduce dos numeros</h2>
    <form action="" method="post">
        <p>Temperatura: </p>
        <input type="text" name="cifra"><br>
        <p>Unidad: </p>
        <select name="unidad" id="unidad">
            <option value="Celsius">CELSIUS</option>
            <option value="Kelvin">KELVIN</option>
            <option value="Fahrenheit">FAHRENHEIT</option>
        </select>
        <p>Convertir a: </p>
        <select name="conversor" id="conversor">
            <option value="Celsius">CELSIUS</option>
            <option value="Kelvin">KELVIN</option>
            <option value="Fahrenheit">FAHRENHEIT</option>
        </select>
        <input type="submit" name="Convertir">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $temperatura = $_POST["temperatura"];
        
            $unidad_old = $_POST["unidad_old"];
            $unidad_new = $_POST["unidad_new"];
        
            $celsius = 0;
        
            if ($unidad_old != $unidad_new) {
              $resultado = match($unidad_old) {
                "celsius" => $celsius = $temperatura,
                "kelvin" => $celsius = $temperatura - 273.15,
                "fahrenheit" => $celsius = ($temperatura - 32) * 5/9
              };
        
              $resultado = match($unidad_new) {
                "celsius" => $celsius,
                "kelvin" => $celsius + 273.15,
                "fahrenheit" => ($celsius * 9/5) + 32 
              };
              echo "<h2>$resultado</h2>";
            }
            else echo "<h2>$temperatura</h2>";
          }
    ?>
</body>
</html>
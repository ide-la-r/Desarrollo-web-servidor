<?php
    //vamos a crear una funcion que reciba la temperatura, la unidad
    //inicial y la final, y devuelva la temperatura final.

    function convertirTemperatura($temperaturaInicial, $unidadInicial, $unidadFinal) {
        echo "<h1>aaaaaaaaaa</h1>";
        
        $temperatura = $temperaturaInicial;
    
        $unidad_old = $unidadInicial;
        $unidad_new = $unidadFinal;
    
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
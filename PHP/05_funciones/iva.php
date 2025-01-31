<?php
    function iva($precio, $iva){
        if ($precio != '' and $iva != '') {//control de que me metan algo vacio
            $pvp = match ($iva) {
                "General" => $precio * 1.21,
                "Reducido" => $precio * 1.10,
                "Superreducido" => $precio * 1.04,
            };
            echo "<h3> El PVP es $pvp </h3>";
        }
        else {
            echo "<p>Te faltan datos</p>";
        }
    }
?>
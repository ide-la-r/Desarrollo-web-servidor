<?php
    function potencias($base, $exponente){
        $solucion = 1;
        
        for ($i=0; $i < $exponente; $i++) { 
            $solucion = $solucion * $base;
        }
        echo "<h1>$solucion</h1>";
    }
    
?>
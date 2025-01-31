<?php
    function calculadora($num){
        echo "<table>";
        for ($i=1; $i < 11; $i++) {;
            echo "<tr>";
            echo "<td>$num x $i </td>";
            echo "<td> = </td>";
            echo "<td> " . ($num * $i) . " </td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>
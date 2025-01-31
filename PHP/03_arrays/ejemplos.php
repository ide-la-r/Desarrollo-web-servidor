<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos Array</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <?php
        /**
         * Todos los arrays en PHP son asociativos, Como los Map en java
         * 
         * Tienen pares clave-valor
         */

        $numeros = [5,10,9,6,7,4];
        $numero = array(6,10,9,4,3);
        print_r($numeros);//Este print es para imprimir un array
        echo "<br>";
        print_r($numero);


        $animales = [
            "A01" => "Perro",
            "A02" => "Gato",
            "A03" => "Ornitorrinco",
            "A04" => "Suricato",
            "A05" => "Capibara"
        ];
        echo "<br><br>";
        print_r($animales);

        echo "<p>" . $animales["A01"] . "</p>";

        $animales2 = [
            "Perro",
            "Gato",
            "Ornitorrinco",
            "Suricato",
            "Capibara"
        ];

        $animales2[2] = "Koala";
        $animales2[7] = "Iguana";//puedes poner la posicion que quieras.
        $animales2["A01"] = "Koala";
        array_push($animales2, "Morsa", "Foca");
        $animales2[] = "Ganso";
        unset($animales2[1]);
        echo "<br><br>";
        print_r($animales2);

        $animales2 = array_values($animales2);
        echo "<br><br>";
        echo "<ol>";
        for ($i=0; $i < count($animales2); $i++) { 
            echo "<li>" . $animales2[$i] ."</li>";
        }
        echo "</ol>";

        $i = 0;
        echo "<ol>";
        while ($i < count($animales2)) {
            echo "<li>" . $animales2[$i] ."</li>";
            $i++;
        }
        echo "</ol>";

        $cantidadAnimales = count($animales2);
        echo "<br>";
        echo "<h3>En total hay $cantidadAnimales animales</h3>";


        echo "<h1>Ejercicio 1</h1>";
        $coches = [
            "4343 TDZ" => "Ford Mustang",
            "1245 PRF" => "Chevrolet Camaro",
            "7398 DPS" => "Citroen C4"
        ];
        
        $coches["6583 MSR"] = "Peugeot 306";
        $coches["5687 JMY"] = "Toyota Yaris";
        $coches[] = "Koignisegg Regera";

        unset($coches[0]);

        $cochesOrdenados = array_values($coches);
        print_r($cochesOrdenados);

        echo "<ol>";
        foreach ($coches as $matricula => $coche) {
            echo "<li>$matricula, $coche</li>";
        }
        echo "</ol>";
    ?>

    <table>
        <caption>Coches</caption>
        <thead>
            <tr>
                <th>Matriculas</th>
                <th>Coche</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach ($coches as $matricula => $coche) {
                        echo "<tr>";
                        echo "<td>$matricula</td>";
                        echo "<td>$coche</td>";
                        echo "</tr>";
                    }
                ?>
        </tbody>
    </table>
    <table>
        <caption>Coches</caption>
        <thead>
            <tr>
                <th>Matriculas</th>
                <th>Coche</th>
            </tr>
        </thead>
        <tbody>
                <?php
                    foreach ($coches as $matricula => $coche) { ?>
                        <tr>
                            <td><?php echo "$matricula" ?></td>;
                            <td><?php echo "$coche" ?></td>;
                        </tr>
                    <?php } ?>
        </tbody>
    </table>
</body>
</html>
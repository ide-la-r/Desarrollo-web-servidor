<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays bidimensionales</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <?php
        $videojuegos = [
            ["Disco Elysium", "RPG", 9.99],
            ["Dragon ball Z kakarot", "Accion", 59.99],
            ["Persona 3", "RPG", 24.99],
            ["Commando 2", "Estrategia", 4.99],
            ["Hollow Knight", "Metroidvania", 9.99],
            ["Startew Valley", "Gestion de recursos", 7.99],
        ];

        $nuevo_videojuego = ["Octopath Traveler", "RPG", 29.95];
        array_push($videojuegos, $nuevo_videojuego);

        array_push($videojuegos, ["Ender Lilies", "Metroidvania", 9.95]);
        
        //unset($videojuegos[3]);

        array_push($videojuegos, ["Dota 2", "MOBA", 0]);
        array_push($videojuegos, ["Fall Guys", "Plataforma", 0]);
        array_push($videojuegos, ["Rocket League", "Deporte", 0]);
        array_push($videojuegos, ["Lego fortnite", "Accion", 0]);

        for ($i=0; $i < count($videojuegos); $i++) { 
            $videojuegos[$i][3] = "Free";
        }

        //el array colum selecciona una columna
        $_titulo = array_column($videojuegos, 0);
        

        //si fuera descendente, SORT_DEST
        array_multisort($_titulo, SORT_ASC, $videojuegos);
        
        //Si hacemos esto ordenarlo depsues tenemos que repetir todo esto entero desde $_titulo gasta el multishort
        
        $_titulo = array_column($videojuegos, 0);
        $_categoria = array_column($videojuegos, 1);
        $_precio = array_column($videojuegos, 2);
        array_multisort($_categoria, SORT_ASC, 
                        $_precio, SORT_DESC, 
                        $_titulo, SORT_DESC, 
                        $videojuegos);

    ?>

    <table>
        <thead>
            <tr>
                <th>Videojuego</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Gratis</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($videojuegos as $videojuego) {
                    //print_r($videojuego);
                    //echo"<br><br>";
                    list($titulo, $categoria, $precio, $free) = $videojuego;//desconpongo un array n varias variables.
                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$categoria</td>";
                    echo "<td>$precio</td>";
                    if ($precio == 0) echo "<td>$free</td>";
                    else echo "<td>No free</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
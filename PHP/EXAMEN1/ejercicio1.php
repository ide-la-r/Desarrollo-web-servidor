<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Examen</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <?php
    $animes = [
        ["Dandadan", "Accion"],
        ["Tragones y mazmorras", "Comedia"],
        ["Los diarios de la boticaria", "Historico"],
        ["Frieren", "Fantasia"],
        ];
        
    array_push($animes, ["Boku no hero", "Accion"]);
    array_push($animes, ["Konosuba", "Comedia"]);
    
    //unset($animes["Dandadan"]);
    
    for ($i=0; $i < count($animes); $i++) { 
        $animes[$i][2] = rand(1990,2030);
    }

    for ($i=0; $i < count($animes); $i++) { 
        $animes[$i][3] = rand(1,99);
    }

    for ($i=0; $i < count($animes); $i++) { 
        if ($animes[$i][2] <= 2024) $animes[$i][4] = "Ya disponible";
        else $animes[$i][4] = "Proximamente";
    }

    $_titulo = array_column($animes, 0);
    $_genero = array_column($animes, 1);
    $_año = array_column($animes, 2);
    array_multisort($_genero, SORT_ASC, 
                    $_año, SORT_ASC, 
                    $_titulo, SORT_ASC, 
                    $animes);
    ?>
    <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Genero</th>
                <th>Año</th>
                <th>Episodios</th>
                <th>Disponibilidad</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($animes as $anime) {
                list($titulo, $genero, $año, $episodios, $disponibilidad) = $anime;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$año</td>";
                echo "<td>$episodios</td>";
                echo "<td>$disponibilidad</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

    
</body>
</html>
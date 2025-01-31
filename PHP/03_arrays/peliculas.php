<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <?php
        $peliculas = [
            
            ["Karate a muerte en torremolinos", "Accion", 1975],
            ["Sharknado 1-5", "Accion", 2015],
            ["Princesa por sorpresa 2", "Comedia", 2008],
            ["Temblores 4", "Terror", 2018],
            ["Cariño, he cogido a los niños", "Aventuras", 2001],
            ["Stuart Little", "Infantil", 2000],
        ];

        /***
         * 1. Añadir con un rand, la duracion de cada pelicula como una nueva columna. La duracion sera
         * un numero aleatorio entre 30 y 240
         * 
         * 2. Añadir como una nueva columna, el tipo de pelicula. EL tipo sera:
         *      -Cortometraje. si la duracion es menor de 60
         *      -Largometraje, si la duracion es mayor o igual que 60
         * 
         * 3. Mostrar en otra tabla todas las columnas y ordenar ademas en este orden:
         *      1.Por el genero
         *      2.Por el año
         *      3.Por el titulo(todo alaveticamente, y el año del mas reciente al mas antiguo)
         * 
        */

        //Asi se ponen nuevas columnas con nuevos datos
        for ($i=0; $i < count($peliculas); $i++) { 
            $peliculas[$i][3] = rand(30,240);
            if ($peliculas[$i][3] >= 60) $peliculas[$i][4] = "Largometraje";
            else $peliculas[$i][4] = "Cortometraje";
        }

        $_titulo = array_column($peliculas, 0);
        $_categoria = array_column($peliculas, 1);
        $_año = array_column($peliculas, 2);
        array_multisort($_categoria, SORT_ASC, 
                        $_año, SORT_ASC, 
                        $_titulo, SORT_ASC, 
                        $peliculas);
    ?>
        <table>
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Año lanzamiento</th>
                <th>Duracion</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($peliculas as $pelicula) {
                    list($titulo, $categoria, $año, $duracion, $tipo) = $pelicula;//desconpongo un array n varias variables.
                    echo "<tr>";
                    echo "<td>$titulo</td>";
                    echo "<td>$categoria</td>";
                    echo "<td>$año</td>";
                    echo "<td>$duracion</td>";
                    echo "<td>$tipo</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
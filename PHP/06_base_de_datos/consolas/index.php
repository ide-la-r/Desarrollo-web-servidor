<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de consolas</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require('conexion.php');
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">

    </div>
    <h1>Tabla de consolas</h1>
    <?php
        /*$sql = "SELECT * FROM consolas";
        $resultado = $_conexion -> query($sql);*/

        //1.preparacion
        $sql = $_conexion -> prepare("SELECT * FROM consolas");

        //3.ejecucion
        $sql -> execute();

        //4.retrieve
        $resultado = $sql -> get_result();
        $_conexion -> close();

        /***
         * Aplicamos la funcion query a la conexion, donde se ejecuta la secuencia SQL hecha.
         * 
         * El resultado se almacena $resultado, que es un objeto con una estructura parecida a los arrays
         */
    ?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Fabricante</th>
                <th>Generacion</th>
                <th>Unidades vendidas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //fila es un array unidimensional aqui, pero no es un array es un objeto
                while ($fila = $resultado -> fetch_assoc()) {// trata el resultado como un array asociativo
                    echo"<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["fabricante"] . "</td>";
                    echo "<td>" . $fila["generacion"] . "</td>";
                    if ($fila["unidades_vendidas"] === NULL) echo "<td>No hay datos</td>";// tiene que ser 3 = porque tiene que ser estrictamente null, == no porque null == "" es true
                    else echo "<td>" . $fila["unidades_vendidas"] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
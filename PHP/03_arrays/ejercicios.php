<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios Arrays</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <!--    EJERCICIO 1
        Desarrollo web en entorno servidor => Alejandra
        Desarrollo web en entorno cliente => Jose Miguel
        Diseño de interfaces web => Jose Miguel
        Despliegue de aplicaciones => Jaime
        Empresa e iniciativa emprendedora => Andrea
        Ingles => Virginia

        Mostralo todo en una tabla
    -->

    <!--    EJERCICIO 2
        Francisco => 3
        Daniel => 5
        Aurora => 10
        Luis => 7
        Samuel => 9

        Mostrar en una tabla con 3 columnas 
            - COLUMNA 1: ALUMNO
            - COLUMNA 2: NOTA
            - COLUMNA 3: SI NOTA < 5, SUSPENSO, ELSE, APROBADO y que salga 
            verde si estas aprobado o rojo suspenso
    -->

    <!-- ESTO DE LAS TABLAS CAE SI O SI EN LOS EXAMENES -->
    <?php
    echo "<h1>Ejercicio 1</h1>";
        $asignaturas = [
            "Desarrollo web en entorno servidor" => "Alejandra",
            "Desarrollo web en entorno cliente" => "Jose Miguel",
            "Diseño de interfaces web" => "Jose Miguel",
            "Despliegue de aplicaciones" => "Jaime",
            "Empresa e iniciativa emprendedora" => "Andrea",
            "Ingles" => "Virginia"
        ];
    ?>    

    <table>
        <thead>
            <th>Asignatura</th>
            <th>Profesor</th>
        </thead>
        <tbody>
            <?php
                asort($asignaturas);//ordena ascendentemente y guardando la clave
                foreach ($asignaturas as $asignatura => $profesor) { ?>
                    <tr>
                        <td><?php echo "$asignatura"; ?></td>
                        <td><?php echo "$profesor"; ?></td>
                    </tr>
             <?php } ?>
        </tbody>
    </table>
    <br><br><br>
    <h1>Ejercicio 2</h1>
    <?php
    $alumnos = [
        "Francisco" => 3,
        "Daniel" => 5,
        "Aurora" => 10,
        "Luis" => 7,
        "Samuel" => 9
    ];
    ?>

    <table>
        <thead>
            <th>Alumno</th>
            <th>Notas</th>
            <th>Final</th>
        </thead>
        <tbody>
            <?php
                foreach ($alumnos as $alumno => $nota) { ?>
                    <tr>
                        <td><?php echo "$alumno"; ?></td>
                        <td><?php echo "$nota"; ?></td>
                        <?php 
                            if ($nota >= 5) {
                                echo "<td class='aprobado'>Aprobado</td>";
                            }
                            else{
                                echo "<td class='suspenso'>Suspenso</td>";
                            }
                        ?>
                    </tr>
             <?php } ?>
        </tbody>
    </table>
     <?php
        /**
         * Insertar dos nuevos estudiantes, con notas aleatorias entre 0 y 10
         * 
         * borra un estudiante (el que peor os caiga) por la clave
         * 
         * MOstrar en una tabla todo ordenado por los nombres en orden alfabeticamente inverso
         * 
         * Mostrar en una nueva tabla todo ordenado por la nota de 10 a 0 (orden inverso)
        */

        // Insertar estudiantes
        $alumnos["Jose"] = rand(0, 10);
        $alumnos["Ignacio"] = rand(0, 10);

        // Borrar estudiante
        unset($alumnos["Luis"]);

        // Ordenar por nombre
        ksort($alumnos);
        

        // Mostrar en una tabla de manera inversa
        krsort($alumnos);
        echo "<br><br>";
        echo "<table>";
        echo "<thead><th>Alumno</th><th>Nota</th></thead>";
        foreach ($alumnos as $alumno => $nota) {
            echo "<tr><td>$alumno</td><td>$nota</td></tr>";
        }
        echo "</table>";

        echo "<br><br>";
        // Mostrar en una tabla de manera inversa por notas
        arsort($alumnos);
        echo "<table>";
        echo "<thead><th>Alumno</th><th>Nota</th></thead>";
        foreach ($alumnos as $alumno => $nota) {
            echo "<tr><td>$alumno</td><td>$nota</td></tr>";
        }
        echo "</table>";
     ?>
</body>
</html>
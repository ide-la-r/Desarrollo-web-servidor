<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de tienda</title>
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        require('../util/conexion.php');

        /*session_start();
        if (isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] .  "</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }*/
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">

    </div>
    <a class="btn btn-warning" href="usuario/cerrar_sesion.php">Cerrar sesion</a>
    <br><br><br><br>
    <h1>Tabla de categorias</h1>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $categoria = $_POST["categoria"];

            $sql = "SELECT categoria FROM productos ORDER BY categoria";
            $resultado = $_conexion -> query($sql);
            $categorias = [];

            while ($fila = $resultado -> fetch_assoc()) {
                array_push($categorias, $fila["categoria"]);
            }

            if (!in_array($categoria, $categorias)) {
                //Borrar la categoria
                $sql = "DELETE FROM categorias WHERE categoria = '$categoria'";
                $_conexion -> query($sql);
            }
            else{
                $err_borrarCategoria = "No se puede borrar la categoria porque esta asociada a un producto";
            }   
        }

        $sql = "SELECT * FROM categorias";
        $resultado = $_conexion -> query($sql);
    ?>
    <a class="btn btn-secondary" href="nueva_categoria.php">Crear nueva categoria</a>
    <br><br>
    <?php if(isset($err_borrarCategoria)) echo "<span class='error'>$err_borrarCategoria</span>" ?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Categoria</th>
                <th>Descripcion</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($fila = $resultado -> fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila["categoria"] . "</td>";
                echo "<td>" . $fila["descripcion"] . "</td>";
                ?>
                <td>
                    <a class="btn btn-primary" href="editar_categoria.php?categoria=<?php echo $fila["categoria"] ?>">Editar categoria</a>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="categoria" value="<?php echo $fila["categoria"] ?>">
                        <input class="btn btn-danger" type="submit" value="borrar">
                    </form>
                </td>
                <?php
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
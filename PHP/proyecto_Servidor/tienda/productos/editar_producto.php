<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );
        require('../util/conexion.php');

        function depurar(string $entrada) : string {
            $salida = htmlspecialchars($entrada);
            $salida = trim($salida);
            $salida = stripslashes($salida);
            $salida = preg_replace('!\s!', ' ', $salida);
            return $salida;
        }
    ?>
</head>
<body>
<div class="container">
    <h1>Editar producto</h1>
    <?php

        $id_producto = $_GET["id_producto"];
        $sql = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
        $resultado = $_conexion -> query($sql);
        
        while ($fila = $resultado -> fetch_assoc()) {
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $descripcion = $fila["descripcion"];
        }

        $sql = "SELECT categoria FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while ($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = depurar($_POST["nombre"]);
            $precio = depurar($_POST["precio"]);
            $categoria = $_POST["categoria"];
            $stock = depurar($_POST["stock"]);
            $descripcion = depurar($_POST["descripcion"]);
            $confirmar = true;

            if ($nombre == '') {
                $confirmar = false;
                $err_nombre = "El nombre es obligatorio";
            } elseif (strlen($nombre) < 2 || strlen($nombre) > 50) {
                $confirmar = false;
                $err_nombre = "El nombre debe tener entre 2 y 50 caracteres";
            }
            $patron = "/^[a-zA-Z0-9 ñáéíóúüÁÉÍÓÚÜ]+$/";
            if (!preg_match($patron, $nombre)) {
                $confirmar = false;
                $err_titulo = "El nombre solo puede tener letras, espacios y numeros";
            }


            if ($precio == '') {
                $confirmar = false;
                $err_precio = "El precio es obligatorio";
            } elseif (!preg_match("/^[0-9]{1,4}(\.[0-9]{1,2})?$/", $precio)){
                $confirmar = false;
                $err_precio = "El precio debe ser un numero y que tenga hasta 4 digitos y 2 decimales";
            }


            if ($categoria == "") {
                $confirmar = false;
                $err_categoria = "La categoria es obligatoria";
            }elseif (!in_array($categoria, $categorias)) {
                $confirmar = false;
                $err_categoria = "Tienes que elegir una categoria existente"; //por si nos editan el html
            }

            if ($confirmar) {
                $sql = "UPDATE productos SET
                nombre = '$nombre',
                precio = '$precio',
                categoria = '$categoria',
                stock = '$stock',
                descripcion = '$descripcion'
                WHERE id_producto = '$id_producto'";
                $_conexion -> query($sql);
            }
            
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $nombre ?>">
                <?php if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" name="precio"  value="<?php echo $precio ?>">
                <?php if(isset($err_precio)) echo "<span class='error'>$err_precio</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="categoria">
                    <option value="<?php echo $categoria ?>" selected disabled hidden <?php echo $categoria ?>>--- Elige la categoria ---</option>
                    <?php 
                        foreach($categorias as $categoria) { ?> 
                            <option value="<?php echo $categoria; ?>">
                                <?php echo $categoria; ?>
                            </option> 
                    <?php } ?>
                </select>
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" name="stock"  value="<?php echo $stock ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">descripcion</label>
                <input class="form-control" name="descripcion"  value="<?php echo $descripcion ?>">
            </div>
            <div>
                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                <input class="btn btn-info" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
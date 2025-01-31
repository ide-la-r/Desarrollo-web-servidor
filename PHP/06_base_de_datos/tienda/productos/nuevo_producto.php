<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo producto</title>
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
        require('../util/depurar.php');

        session_start();
        if (!isset($_SESSION["usuario"])) { 
            header("location: ../usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
<div class="container">
    <h1>Nuevo producto</h1>
    <?php

        $sql = "SELECT categoria FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while ($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = depurar($_POST["nombre"]);
            $precio = depurar($_POST["precio"]);
            if(isset($_POST["categoria"])) $categoria = depurar($_POST["categoria"]);
            else $categoria = "";
            $stock = depurar($_POST["stock"]);
            $descripcion = depurar($_POST["descripcion"]);

            $imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "../imagenes/$imagen";

            $confirmar = true;

            $patron = "/^[a-zA-Z0-9 ñáéíóúüÁÉÍÓÚÜ]+$/";
            if ($nombre == '') {
                $confirmar = false;
                $err_nombre = "El nombre es obligatorio";
            } elseif (!preg_match($patron, $nombre)) {
                $confirmar = false;
                $err_nombre = "El nombre solo puede tener letras, espacios y numeros";
            } 
            elseif (strlen($nombre) < 2 || strlen($nombre) > 50) {
                $confirmar = false;
                $err_nombre = "El nombre debe tener entre 2 y 50 caracteres";
            } 


            if ($precio == '') {
                $confirmar = false;
                $err_precio = "El precio es obligatorio";
            } else{
                if (!filter_var($precio, FILTER_VALIDATE_FLOAT)) {
                    $confirmar = false;
                    $err_precio = "El precio tiene que ser un numero";
                }
                elseif (!preg_match("/^[0-9]{1,4}(\.[0-9]{1,2})?$/", $precio)){
                    $confirmar = false;
                    $err_precio = "El precio solo puede tener hasta 4 digitos y 2 decimales";
                }
            } 


            if ($categoria == '') {
                $confirmar = false;
                $err_categoria = "La categoria es obligatoria";
            } elseif (!in_array($categoria, $categorias)) {
                $confirmar = false;
                $err_categoria = "Tienes que elegir una categoria existente"; //por si nos editan el html
            }

            if ($stock == '' || $stock == 0) {
                $stock = 0;
            } else{
                if (!filter_var($stock, FILTER_VALIDATE_INT)) {
                    $confirmar = false;
                    $err_stock = "El stock tiene que ser un numero entero";
                } elseif ($stock < 0 || $stock > 2147483647){
                    $confirmar = false;
                    $err_stock = "El stock tiene que ser mayor de 0 y maximo 2147483647";
                }
            }


            if ($imagen == '') {
                $confirmar = false;
                $err_imagen = "La imagen es obligatoria";
            } else{
                if (strlen($imagen) > 60) {
                    $confirmar = false;
                    $err_imagen = "La ruta no puede tener mas de 60 caracteres";
                } else{
                    move_uploaded_file($ubicacion_temporal, $ubicacion_final);
                }
            }

            
            if ($descripcion == '') {
                $confirmar = false;
                $err_descripcion = "La descripción es obligatoria";
            } elseif(strlen($descripcion) > 255){
                $confirmar = false;
                $err_descripcion = "La descripción no puede tener mas de 255 caracteres";
            }


            if ($confirmar) {
                $sql = "INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion)
                VALUES ('$nombre', '$precio', '$categoria', '$stock', '$imagen', '$descripcion')";
                $_conexion -> query($sql);
            }  
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($err_nombre)) echo "<span class='error'>$err_nombre</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" name="precio">
                <?php if(isset($err_precio)) echo "<span class='error'>$err_precio</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="categoria">
                    <option selected disabled hidden>--- Elige la categoria ---</option>
                    <?php 
                        foreach($categorias as $categoria) { ?> 
                            <option value="<?php echo $categoria ?>">
                                <?php echo $categoria ?>
                            </option> 
                    <?php } ?>
                </select>
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" name="stock">
                <?php if(isset($err_stock)) echo "<span class='error'>$err_stock</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
                <?php if(isset($err_imagen)) echo "<span class='error'>$err_imagen</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcion"></textarea>
                <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
            </div>
            <div>
                <input class="btn btn-info" type="submit" value="Crear producto">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
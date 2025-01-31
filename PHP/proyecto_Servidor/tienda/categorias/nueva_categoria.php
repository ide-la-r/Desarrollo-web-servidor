<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva categoria</title>
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
    ?>
</head>
<body>
<div class="container">
    <h1>Nueva categoria</h1>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoria = $_POST["categoria"];
            $descripcion = $_POST["descripcion"];
            $confirmar = true;

            $sql = "SELECT categoria FROM categorias ORDER BY categoria";
            $resultado = $_conexion -> query($sql);
            $categorias = [];
            while ($fila = $resultado -> fetch_assoc()) {
                array_push($categorias, $fila["categoria"]);
            }
            if (in_array($categoria, $categorias)) {
                $confirmar = false;
                $err_categoria = "No se puede crear la categoria porque ya existe";
            } 


            $patron = "/^[a-zA-Z ñáéíóúüÁÉÍÓÚÜ]+$/";
            if (strlen($categoria) < 2) {
                $confirmar = false;
                $err_categoria = "La categoria tiene que tener minimo 2 caracteres";
            } else if (!preg_match($patron, $categoria)) {
                $confirmar = false;
                $err_categoria = "La categoria solo puede tener letras y espacios";
            }
            if (strlen($descripcion) > 255) {
                $confirmar = false;
                $err_descripcion = "La descripcion no puede ser mayor a 255 carecteres.";
            }
            if($confirmar){
                $sql = "INSERT INTO categorias (categoria, descripcion)
                VALUES ('$categoria', '$descripcion')";
                $_conexion -> query($sql);
            }
               
        }

    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
    <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input class="form-control" type="text" name="categoria">
                <?php if(isset($err_categoria)) echo "<span class='error'>$err_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="5"></textarea>
                <?php if(isset($err_descripcion)) echo "<span class='error'>$err_descripcion</span>" ?>
            </div>
            <div>
                <input class="btn btn-info" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
            
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
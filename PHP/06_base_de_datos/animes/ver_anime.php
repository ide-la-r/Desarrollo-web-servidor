<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .error {
            color: red;
        }
    </style>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );
        require('conexion.php');
    ?>
</head>
<body>
<div class="container">
    <h1>Editar anime</h1>
    <?php
        echo "<h1>" . $_GET["id_anime"] . "</h1>";

        $id_anime = $_GET["id_anime"];
        /*
        $sql = "SELECT * FROM animes WHERE id_anime = $id_anime";
        $resultado = $_conexion -> query($sql);
        */

        //prepare
        $sql = $_conexion -> prepare("SELECT * FROM animes WHERE id_anime = ?");
        //binding
        $sql -> bind_param("i", $id_anime);
        //execute
        $sql -> execute();
        //retrieve
        $resultado = $sql -> get_result();


        
        while ($fila = $resultado -> fetch_assoc()) {//este while se puede quitar porque solo coje un anime pero se pone por coherencia
            $titulo = $fila["titulo"];
            $nombre_estudio = $fila["nombre_estudio"];
            $anno_estreno = $fila["anno_estreno"];
            $num_temporadas = $fila["num_temporadas"];
            $imagen = $fila["imagen"];
        }


        /*$sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);*/

        //prepare
        $sql = $_conexion -> prepare("SELECT * FROM animes WHERE nombre_estudio = ?");
        //binding
        $sql -> bind_param("s", $nombre_estudio);
        //execute
        $sql -> execute();
        //retrieve
        $resultado = $sql -> get_result();

        $estudios = [];

        while ($fila = $resultado -> fetch_assoc()) {
            array_push($estudios, $fila["nombre_estudio"]);
        }
        //print_r($estudios);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_anime = $_POST["id_anime"];
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];

            /*
            $sql = "UPDATE animes SET
                titulo = '$titulo',
                nombre_estudio = '$nombre_estudio',
                anno_estreno = '$anno_estreno',
                num_temporadas = '$num_temporadas'
                WHERE id_anime = '$id_anime'
            ";
            $_conexion -> query($sql);
            */

            // prepare
            $sql = $conexion -> prepare($sql = "UPDATE animes SET
            titulo = ?,
            nombre_estudio = ?,
            anno_estreno = ?,
            num_temporadas = ?
            WHERE id_anime = ?
            ");
            //binding
            $sql -> bind_param("ssiii", 
            $titulo, 
            $nombre_estudio, 
            $anno_estreno, 
            $num_temporadas, 
            $id_anime);
            // execute
            $sql -> execute();
            $_conexion -> close();

        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Formulario Animes</h1>
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input class="form-control" type="text" name="titulo" value="<?php echo $titulo ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre Estudio</label>
                <select class="form-select" name="nombre_estudio">
                    <option value="<?php echo $nombre_estudio ?>" selected disabled hidden <?php echo $nombre_estudio ?>>--- Elige el estudio ---</option>
                    <?php 
                        foreach($estudios as $estudio) { ?> 
                            <option value="<?php echo $estudio; ?>">
                                <?php echo $estudio; ?>
                            </option> 
                    <?php } ?>
                </select>
                <?php if(isset($err_nombre_estudio)) echo "<span class='error'>$err_nombre_estudio</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Año Estreno</label>
                <input class="form-control" type="text" name="anno_estreno" value="<?php echo $anno_estreno ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Numero de Temporadas</label>
                <input class="form-control" type="text" name="num_temporadas" value="<?php echo $num_temporadas ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div>
                <input type="hidden" name="id_anime" value="<?php echo $id_anime ?>">
                <input class="btn btn-info" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
            
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
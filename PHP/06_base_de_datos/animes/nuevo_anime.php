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
        require('../../05_funciones/depurar.php');
        require('conexion.php');
    ?>
</head>
<body>
<div class="container">
    <h1>Nuevo anime</h1>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];

            /**
             * $_FILES -> que es un array BIDIMENSIONAL
             */
            //var_dump($_FILES["imagen"]);
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "./imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal, $ubicacion_final);

            /*$sql = "INSERT INTO animes (titulo, nombre_estudio,anno_estreno,num_temporadas,imagen)
                VALUES ('$titulo', '$nombre_estudio', $anno_estreno, $num_temporadas, '$ubicacion_final')"; // si es numero no hace falta las comillas

            $_conexion -> query($sql);*/

            /**
             * Las tres etapas de las prepared statements
             * 
             * 1. Preparacion
             * 2. Enlazado (binding)
             * 3. Ejecucion
             */

            //1.preparacion
            $sql = $_conexion -> prepare("INSERT INTO animes
                (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                VALUES (?,?,?,?,?)");
            //2.enlazado
            $sql -> bind_param("ssiis", $titulo, $nombre_estudio, $anno_estreno, $num_temporadas, $ubicacion_final);
            //3.ejecucion
            $sql -> execute();

            
        
        }

        /*$sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);*/

        //1.preparacion
        $sql = $_conexion -> prepare("SELECT * FROM estudios ORDER BY ?");
        //2.enlazado
        $sql -> bind_param("s", $nombre);
        //3.ejecucion
        $sql -> execute();
        //4.retrieve
        $resultado = $sql -> get_result();
        $_conexion -> close();
        

        $estudios = [];

        while ($fila = $resultado -> fetch_assoc()) {
            array_push($estudios, $fila["nombre_estudio"]);
        }
        //print_r($estudios);
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Formulario Animes</h1>
            <div class="mb-3">
                <label class="form-label">Titulo</label>
                <input class="form-control" type="text" name="titulo">
                <?php if(isset($err_titulo)) echo "<span class='error'>$err_titulo</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre Estudio</label>
                <select class="form-select" name="nombre_estudio">
                    <option value="" selected disabled hidden>--- Elige el estudio ---</option>
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
                <input class="form-control" type="text" name="anno_estreno">
                <?php if(isset($err_anno_estreno)) echo "<span class='error'>$err_anno_estreno</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Numero de Temporadas</label>
                <input class="form-control" type="text" name="num_temporadas">
                <?php if(isset($err_num_temporadas)) echo "<span class='error'>$err_num_temporadas</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
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
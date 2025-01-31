<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1);
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>

    <?php
        function depurar(string $entrada) : string {
            $salida = htmlspecialchars($entrada);
            $salida = trim($salida);
            $salida = stripslashes($salida);
            $salida = preg_replace('!\s!', ' ', $salida);
            return $salida;
        }
    ?>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_titulo = depurar($_POST["titulo"]);
            $tmp_paginas = depurar($_POST["paginas"]);
            
            
            $tmp_fecha_publicacion = depurar($_POST["fecha_publicacion"]);
            $tmp_sinopsis = depurar($_POST["sinopsis"]);

            if ($tmp_titulo == ""){
                $err_titulo = "El titulo es obligatorio";
            }
            else{
                if (strlen($tmp_titulo) < 1 or strlen($tmp_titulo) > 40){
                    $err_titulo = "El titulo debe contener entre 1 y 40 caracteres.";
                }
                else{
                    $patron = "/^[a-zA-z]{1}[a-zA-Z0-9 ñáéíóúüÁÉÍÓÚÜ.,;]+$/";
                    if (!preg_match($patron, $tmp_titulo)) {
                        $err_titulo = "El nombre solo puede contener letras, numeros, espacios, puntos, comas, puntos y comas y ñ";
                    }
                    else $titulo = ucwords(strtolower($tmp_titulo));
                }
            }


            if ($tmp_paginas == "") {
                $err_paginas = "Las paginas son obligatorias";
            }
            else{
                if (!filter_var($tmp_paginas, FILTER_VALIDATE_INT)) {
                    $err_paginas = "Las paginas tienen que ser un numero entero";
                }
                else{
                    if ($tmp_paginas < 10 or $tmp_paginas > 9999) {
                        $err_paginas = "Las paginas tienen que estar entre 10 y 9999";
                    }
                    else{
                        $paginas = $tmp_paginas;
                    }
                } 
            }


            if (isset($_POST["genero"])) $tmp_genero = $_POST["genero"];
            else $tmp_genero = "";

            if($tmp_genero == ""){
                $err_genero = "El genero es obligatorio";
            }
            else{
                $generos_validos = ["fantasia", "ciencia_ficcion", "romance", "drama"];
                if (!in_array($tmp_genero, $generos_validos)) {
                    $err_genero = "El genero no es valido";
                }
                else{
                    $genero = $tmp_genero;
                }
            }


            if (isset($_POST["secuela"])) $tmp_secuela = $_POST["secuela"];
            else $tmp_secuela = "";

            $secuelas_validas = ["si", "no"];
            if (!in_array($tmp_secuela, $secuelas_validas)) {
                $err_secuela = "La secuela no es valida";
            }
            else{
                $secuela = $tmp_secuela;
            }

            if ($tmp_fecha_publicacion == "") {
                $err_fecha_publicacion = "";
            }
            else{
                $fecha_maxima = date("Y-m-d", strtotime('+3 years'));
                $fecha_minima = "1800-01-01";

                if ($tmp_fecha_publicacion < $fecha_minima) {
                    $err_fecha_publicacion = "La fecha no puede ser inferior a 01-01-1800";
                }
                elseif ($tmp_fecha_publicacion > $fecha_maxima){
                    $err_fecha_publicacion = "La fecha no puede ser mayor al dia de hoy dentro de 3 años";
                }
                else{
                    $fecha_publicacion = $tmp_fecha_publicacion;
                }
            }


            if ($tmp_sinopsis == ""){
                $err_sinopsis = "";
            } 
            else{
                if (strlen($tmp_sinopsis) > 200){
                    $err_sinopsis = "La sinopsis puede contener como maximo 200 caracteres.";
                }
                else{
                    $patron = "/^[a-zA-Z ñáéíóúüÁÉÍÓÚÜ]+$/";
                    if (!preg_match($patron, $tmp_sinopsis)) {
                        $err_sinopsis = "La sinopsis solo puede contener letras, espacios y ñ";
                    }
                    else $sinopsis = ucwords(strtolower($tmp_sinopsis));
                }
            }
        }
    ?>


<h1>Formulario de libros</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Titulo</label>
            <input class="form-control" type="text" name="titulo">
            <?php if (isset($err_titulo)) echo"<span class='error'>$err_titulo</span>"; ?>
        </div class="mb-3">
        <div class="mb-3">
            <label class="form-label">Paginas</label>
            <input class="form-control" type="text" name="paginas">
            <?php if (isset($err_paginas)) echo"<span class='error'>$err_paginas</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Genero</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="fantasia">
                <label class="form-check-label">Fantasia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="ciencia_ficcion">
                <label class="form-check-label">Ciencia Ficcion</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="romance">
                <label class="form-check-label">Romance</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="drama">
                <label class="form-check-label">Drama</label>
            </div>
            <?php if (isset($err_genero)) echo"<span class='error'>$err_genero</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Tiene secuela?</label>
            <select class="form-select" name="secuela" id="secuela">
                <option value="no">No</option>
                <option value="si">Si</option>
            </select>
            <?php if (isset($err_secuela)) echo"<span class='error'>$err_secuela</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha Publicacion</label>
            <input class="form-control" type="date" name="fecha_publicacion">
            <?php if (isset($err_fecha_publicacion)) echo"<span class='error'>$err_fecha_publicacion</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Sinopsis</label>
            <input class="form-control" type="text" name="sinopsis">
            <?php if (isset($err_sinopsis)) echo"<span class='error'>$err_sinopsis</span>"; ?>
        </div>
        <!--Aqui va lo demas-->
        <div class="mb-3">
            <button class="btn btn-outline-primary" type="submit">Enviar</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
        if(isset($titulo) && isset($paginas) && isset($genero) && isset($secuela) && isset($fecha_publicacion)) { ?>
            <h1>Titulo: <?php echo $titulo ?></h1>
            <h1>Paginas: <?php echo $paginas ?></h1>
            <h1>Genero: <?php echo $genero ?></h1>
            <h1>Secuela: <?php echo $secuela ?></h1>
            <h1>Fecha de la Publicacion: <?php echo $fecha_publicacion ?></h1>
<?php   } ?>
</body>
</html>
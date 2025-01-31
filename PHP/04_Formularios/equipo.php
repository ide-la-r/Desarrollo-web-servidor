<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Equipo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );

        require("../05_funciones/depurar.php");
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<!--
Equipos de la liga

- Nombre (letras con tilde, ñ, espacios en blanco y punto)
- Inicial (3 letras)
- Liga (select con las opciones: Liga EA Sports, Liga Hypermotion, Liga Primera RFEF)
- Ciudad (letras con tilde, ñ, ç y espacios en blanco)
- Tiene titulo la liga? (select con si o no)
- Fecha de fundación (entre hoy y el 18 de diciembre de 1889)
- Número de jugadores (entre 19 y 32)
-->
<div class="container">
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_nombre = depurar($_POST["nombre"]);
            $tmp_iniciales = depurar($_POST["iniciales"]);
            
            $tmp_ciudad = depurar($_POST["ciudad"]);
            
            $tmp_fecha_fundacion = depurar($_POST["fecha_fundacion"]);
            $tmp_num_jugadores = depurar($_POST["num_jugadores"]);

            if ($tmp_nombre == ""){
                $err_nombre = "El nombre es obligatorio";
            } 
            else{
                if (strlen($tmp_nombre) < 3 || strlen($tmp_nombre) > 20){
                    $err_nombre = "El nombre debe contener entre 3 y 20 caracteres.";
                }
                else{
                    $patron = "/^[a-zA-Z áéíóúüÁÉÍÓÚÜ.]+$/";
                    if (!preg_match($patron, $tmp_nombre)) {
                        $err_nombre = "El nombre solo puede contener letras espacios y puntos";
                    }
                    else $nombre = ucwords(strtolower($tmp_nombre));//Lo pasamos todo a minuscula y la primera la ponemos mayuscula
                }
            }


            if ($tmp_iniciales == "") {
                $err_iniciales = "Las iniciales son obligatorias";
            }
            else{
                if (strlen($tmp_iniciales) != 3) {
                    $err_iniciales = "Las iniciales tienen que ser de 3 caracteres";
                }
                else{
                    $iniciales = strtoupper($tmp_iniciales);
                }
            }


            //esto lo hacemos para que nos meta algo si o si
            if (isset($_POST["liga"])) $tmp_liga = $_POST["liga"];
            else $tmp_liga = "";

            if($tmp_liga == ""){
                $err_liga = "La liga es obligatoria";
            }
            else{
                $ligas_validas = ["ea_sports", "hypermotion", "rfef"];
                if (!in_array($tmp_liga, $ligas_validas)) {
                    $err_liga = "La liga no es valida";
                }
                else{
                    $liga = $tmp_liga;
                }
            }


            if ($tmp_ciudad == "") {
                $err_ciudad = "La ciudad es obligatoria";
            }
            else{
                $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚüÜçÇ]+$/";
                if (!preg_match($patron, $tmp_ciudad)) {
                    $err_ciudad = "La ciudad solo puede contener letras, espacios y ç";
                }
                else{
                    $ciudad = ucwords(strtolower($tmp_ciudad));
                }
            }


            if (isset($_POST["titulos"])) $tmp_titulos = $_POST["titulos"];
            else $tmp_titulos = "";

            if($tmp_titulos == ""){
                $err_titulos = "Decir si tiene titulo o no es obliatorio";
            }
            else{
                $titulos_validos = ["si", "no"];
                if (!in_array($tmp_titulos, $titulos_validos)) {
                    $err_titulos = "El titulo no es valido";
                }
                else{
                    $titulos = $tmp_titulos;
                }
            }


            if ($tmp_fecha_fundacion == ""){
                $err_fecha_fundacion = "La fecha de fundacion es obligatoria";
            }
            else{
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if (!preg_match($patron,$tmp_fecha_fundacion)) {
                    $err_fecha_fundacion = "Formato de fecha incorrecto";
                }
                else{
                    $fecha_actual = date("Y-m-d");
                    $fecha_minima = "1889-12-18";

                    if ($tmp_fecha_fundacion < $fecha_minima) {
                        $err_fecha_fundacion = "La fecha no puede ser inferior a 18-12-1889";
                    }
                    elseif ($tmp_fecha_fundacion > $fecha_actual){
                        $err_fecha_fundacion = "La fecha no puede ser mayor al dia de hoy";
                    }
                    else{
                        $fecha_fundacion = $tmp_fecha_fundacion;
                    }
                }
            }


            if ($tmp_num_jugadores == ""){
                $err_num_jugadores = "El numero de jugadores es obligatorio";
            }
            else{
                if ($tmp_num_jugadores < 19 || $tmp_num_jugadores > 32) {
                    $err_num_jugadores = "El numero de jugadores debe ser entre 19 y 32";
                }
                else{
                    $num_jugadores = $tmp_num_jugadores;
                }
            }

        }
    ?>

    <h1>Formulario de equipos de la liga</h1>
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" type="text" name="nombre">
            <?php if (isset($err_nombre)) echo"<span class='error'>$err_nombre</span>"; ?>
        </div class="mb-3">
        <div>
            <label class="form-label">Iniciales</label>
            <input class="form-control" type="text" name="iniciales">
            <?php if (isset($err_iniciales)) echo"<span class='error'>$err_iniciales</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Liga</label>
            <select class="form-select" name="liga" id="liga">
                <option value="ea_sports">Liga EA Sports</option>
                <option value="hypermotion">Liga Hypermotion</option>
                <option value="rfef">Liga Primera RFEF</option>
            </select>
            <?php if (isset($err_liga)) echo"<span class='error'>$err_liga</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Ciudad</label>
            <input class="form-control" type="text" name="ciudad">
            <?php if (isset($err_ciudad)) echo"<span class='error'>$err_ciudad</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Liga con titulos</label>
            <select class="form-select" name="titulos" id="titulos">
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
            <?php if (isset($err_titulos)) echo"<span class='error'>$err_titulos</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha fundación</label>
            <input class="form-control" type="date" name="fecha_fundacion">
            <?php if (isset($err_fecha_fundacion)) echo"<span class='error'>$err_fecha_fundacion</span>"; ?>
        </div>
        <div class="mb-3">
            <label class="form-label">Numero de jugadores</label>
            <input class="form-control" type="text" name="num_jugadores">
            <?php if (isset($err_num_jugadores)) echo"<span class='error'>$err_num_jugadores</span>"; ?>
        </div>
        <div class="mb-3">
            <button class="btn btn-outline-primary" type="submit">Enviar</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
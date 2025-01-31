<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <?php
        function depurar(string $entrada) : string {//para que los parametros sean string y lo que salga sea string
            $salida = htmlspecialchars($entrada);//esto nos pone en modo texto cualquier cosa por si nos mete scripts y demas
            $salida = trim($salida); // esto lo que hace es quitar los espacios de los laterales
            $salida = stripslashes($salida); // esto te quita muchos \ que te puedan hacer bugs dentro de la aplicacion.
            $salida = preg_replace('!\s!', ' ', $salida); //esto nos quita todos los espacios sobrantes dentro de la cadena
            return $salida;
        }
    ?>
    <div class="container">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tmp_dni = depurar($_POST["dni"]);
                $tmp_fechaNacimiento = depurar($_POST["fechaNacimiento"]);
                $tmp_correo = depurar($_POST["correo"]);
                $tmp_usuario = depurar($_POST["usuario"]);
                $tmp_nombre = depurar($_POST["nombre"]);
                $tmp_apellidos = depurar($_POST["apellidos"]);

                if ($tmp_dni == '') {
                    $err_dni = "El DNI es obligatorio";
                } else{
                    $tmp_dni = strtoupper($tmp_dni);//ponemos la letra en mayuscula por si nos la meten en minuscula
                    $patron = "/^[0-9]{8}[A-Z]$/";// el $ y el ^ es para cerrar las expresiones regulares
                    if (!preg_match($patron, $tmp_dni)) {//esto ve si la variale tmp cumple el patron
                        $err_dni = "El DNI debe contener 8 numeros y 1 letra mayuscula";
                    }  else{
                        $numero_dni = substr($tmp_dni,0,8);//Cojo los numeros del DNI
                        $letra_dni = substr($tmp_dni,8,1);//Cojo la letra del DNI
                    
                        $resto_dni = $numero_dni % 23;
                        $letra_correcta = match($resto_dni) {
                            0 => "T",
                            1 => "R",
                            2 => "W",
                            3 => "A",
                            4 => "G",
                            5 => "M",
                            6 => "Y",
                            7 => "F",
                            8 => "P",
                            9 => "D",
                            10 => "X",
                            11 => "B",
                            12 => "N",
                            13 => "J",
                            14 => "Z",
                            15 => "S",
                            16 => "Q",
                            17 => "V",
                            18 => "H",
                            19 => "L",
                            20 => "C",
                            21 => "K",
                            22 => "E"
                        };

                        /* Otra manera de hacerlo mucho mas corto
                        $letras_dni = "TRWAGMYFPDXBNJZSQVHLCKE";
                        $letra_correcta = substr($letras_dni,$resto_dni,1);
                        */

                        if ($letra_dni != $letra_correcta) $err_dni = "La letra del DNI no es correcta";
                        else $dni = $tmp_dni;
                    }
                }


                if ($tmp_fechaNacimiento == '') {
                    $err_fechaNacimiento = "La fecha de nacimiento es obligatoria";
                } else{
                    $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                    if (!preg_match($patron, $tmp_fechaNacimiento)) {
                        $err_fechaNacimiento = "Debes poner el formato: yyyy-mm-dd";
                    }  
                    else{
                        $fecha_actual = date("Y-m-d");
                        list($anno_actual,$mes_actual,$dia_actual) = explode('-', $fecha_actual);//convierto en tres variables en las que cada uno mete su parte correspondiente, la funcion en si devuelve un array
                        list($anno,$mes,$dia) = explode('-',$tmp_fechaNacimiento);
                        
                        if($anno_actual - $anno < 18) {
                            $err_fechaNacimiento = "No puedes ser menor de edad";
                        }elseif($anno_actual - $anno == 18) {
                            if($mes_actual - $mes < 0) {
                                $err_fechaNacimiento = "No puedes ser menor de edad";
                            }elseif($mes_actual - $mes == 0) {
                                if($dia_actual - $dia < 0) {
                                    $err_fechaNacimiento = "No puedes ser menor de edad";
                                }else {
                                    $fechaNacimiento = $tmp_fechaNacimiento;
                                }
                            }elseif($mes_actual - $mes > 0) {
                                $fechaNacimiento = $tmp_fechaNacimiento;
                            } 
                        }elseif($anno_actual - $anno > 121) {
                            $err_fechaNacimiento = "No puedes tener mas de 120 años";
                        } elseif($anno_actual - $anno == 121) {
                            if($mes_actual - $mes > 0) {
                                $err_fechaNacimiento = "No puedes tener mas de 120 años";
                            } elseif($mes_actual - $mes == 0) {
                                if($dia_actual - $dia >= 0) {
                                    $err_fechaNacimiento = "No puedes tener mas de 120 años";
                                } else {
                                    $fechaNacimiento = $tmp_fechaNacimiento;
                                }
                            } elseif($mes_actual - $mes < 0){
                                $fechaNacimiento = $tmp_fechaNacimiento;
                            } 
                        }
                    }
                }


                if ($tmp_correo == '') {
                    $err_correo = "El correo es obligatorio";
                } else{
                    $patron = "/^[a-zA-Z0-9_\-.+]+@([a-zA-Z0-9-]+.)+[a-zA-Z]+$/";
                    if (!preg_match($patron, $tmp_correo)) {
                        $err_correo = "Debes poner bien el correo ej: example@gmail.com";
                    }  else{
                        $palabras_baneadas = ["caca", "peo", "recorcholis", "caracoles", "repampanos"];
                        
                        $palabras_encontradas = "";
                        foreach ($palabras_baneadas as $palabra_baneada){
                            if (str_contains($tmp_correo,$palabra_baneada)) {
                                $palabras_encontradas = " $palabra_baneada" . $palabras_encontradas;
                            }
                            if ($palabras_encontradas != '') {
                                $err_correo = "No se permiten las palabras: $palabras_encontradas";
                            }
                            else{
                                $correo = $tmp_correo;
                            }
                        }
                    }
                }


                if ($tmp_usuario == '') {
                    $err_usuario = "El usuario es obligatorio";
                } else{
                    // letras de la A a la Z (mayus o minus), numers y barrabaja
                    $patron = "/^[a-zA-Z0-9_]{4,12}$/";
                    if (!preg_match($patron, $tmp_usuario)) {
                        $err_usuario = "El usuario debe contener de 4 a 12 letras, numeros o barrabaja";
                    }  else{
                        $usuario = $tmp_usuario;
                    }
                }


                if ($tmp_nombre == '') {
                    $err_nombre = "El nombre es obligatorio";
                } else{
                    if (strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 40) {
                        $err_nombre = "El nombre debe tener entre 2 y 40 caracteres";
                    }
                    // letras de la A a la Z (mayus o minus), y tildes y espacios
                    $patron = "/^[a-zA-Z áéíóúüÁÉÍÓÚÜ]+$/";//el mas es para indicar que es mas de un caracter
                    if (!preg_match($patron, $tmp_nombre)) {
                        $err_nombre = "El nombre solo puede contener letras y espacios en blanco";
                    }  else{
                        $nombre = $tmp_nombre;
                    }
                }


                if ($tmp_apellidos == '') {
                    $err_apellidos = "Los apellidos son obligatorio";
                } else{
                    if (strlen($tmp_apellidos) < 2 || strlen($tmp_apellidos) > 60) {
                        $err_apellidos = "El nombre debe tener entre 2 y 60 caracteres";
                    }
                    // letras de la A a la Z (mayus o minus), y tildes y espacios
                    $patron = "/^[a-zA-Z áéíóúüÁÉÍÓÚÜ]+$/";//el mas es para indicar que es mas de un caracter
                    if (!preg_match($patron, $tmp_apellidos)) {
                        $err_apellidos = "Los apellido/s solo puede/n contener letras y espacios en blanco";
                    }  else{
                        $apellidos = $tmp_apellidos;
                    }
                }
            }
        ?>
        <h1>Formulario usuario</h1>
        <form class="col-4" action="" method="post"><!-- Esto del col 3 y eso es del bootstrap, cambios del css-->
            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input class="form-control" type="text" name="dni">
                <?php if(isset($err_dni)) echo "<span class = 'error'>$err_dni</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de nacimiento</label>
                <input class="form-control" type="text" name="fechaNacimiento">
                <?php if(isset($err_fechaNacimiento)) echo "<span class = 'error'>$err_fechaNacimiento</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input class="form-control" type="text" name="correo">
                <?php if(isset($err_correo)) echo "<span class = 'error'>$err_correo</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if(isset($err_usuario)) echo "<span class = 'error'>$err_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($err_nombre)) echo "<span class = 'error'>$err_nombre</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input class="form-control" type="text" name="apellidos">
                <?php if(isset($err_apellidos)) echo "<span class = 'error'>$err_apellidos</span>" ?>
            </div>
            <div class="mb-3">
                <button class="btn btn-outline-primary" type="submit">Enviar</button>
            </div>
        </form> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php
        if(isset($dni) && isset($correo) && isset($fechaNacimiento) && isset($usuario) && isset($nombre) && isset($apellidos)) { ?>
            <h1><?php echo $dni ?></h1>
            <h1><?php echo $correo ?></h1>
            <h1><?php echo $fechaNacimiento ?></h1>
            <h1><?php echo $usuario ?></h1>
            <h1><?php echo $nombre ?></h1>
            <h1><?php echo $apellidos ?></h1>
    <?php } ?>
    </body>
</html>
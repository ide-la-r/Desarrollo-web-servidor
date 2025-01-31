<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
    ?>
</head>
<body>
<div class="container">
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = depurar($_POST["usuario"]);
            $contrasena = $_POST["contrasena"];
            $confirmar = true;

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $_conexion -> query($sql);

            if($usuario == ''){
                $confirmar = false;
                $err_usuario = "El usuario es obligatorio";
            } else{
                if ($resultado -> num_rows == 1) {
                    $confirmar = false;
                    $err_usuario = "El usuario ya existe";
                } else{
                    $patron = "/^[a-zA-Z0-9áéíóúÁÉÍÓÚ]+$/";
                    if (strlen($usuario) < 3 || strlen($usuario) > 15) {
                        $confirmar = false;
                        $err_usuario = "El usuario no puede tener menos de 3 caracteres o mas de 15";
                    } elseif (!preg_match($patron, $usuario)) {
                        $confirmar = false;
                        $err_usuario = "El usuario solo puede tener letras y numeros";
                    }
                }
            }


            if ($contrasena == '') {
                $confirmar = false;
                $err_contrasena = "La contraseña es obligatoria";
            } else{
                $patron = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/";
                if (strlen($contrasena) < 8 || strlen($contrasena) > 15) {
                    $confirmar = false;
                    $err_contrasena = "La contraseña no puede tener menos de 8 caracteres o mas de 15";
                } elseif (!preg_match($patron, $contrasena)){
                    $confirmar = false;
                    $err_contrasena = "La contraseña tiene que tener letras minusculas, mayusculas, algun numero y puede tener caracteres especiales";
                } else{
                    $contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);
                }
            }

            
            if ($confirmar) {
                $sql = "INSERT INTO usuarios VALUES ('$usuario','$contrasena_cifrada')";
                $_conexion -> query($sql);
                header("location: iniciar_sesion.php");
                exit;
            }
            
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Registro</h1>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if (isset($err_usuario)) echo "<span class='error'>$err_usuario</span>"; ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
                <?php if (isset($err_contrasena)) echo "<span class='error'>$err_contrasena</span>"; ?>
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Registrarse">
                <br><br>
                <h3>Tienes ya cuenta?</h3>
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar sesion</a>
                <br><br>
                <a class="btn btn-secondary" href="../index.php">Volver al Inicio</a>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
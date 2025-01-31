<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
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

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $_conexion -> query($sql);

            if ($resultado -> num_rows == 0) {
                $err_usuario = "El usuario $usuario no existe";
            }
            else{
                $datos_usuario = $resultado -> fetch_assoc();
                $acceso_concedido = password_verify($contrasena,$datos_usuario["contrasena"]);
                
                if($acceso_concedido){
                    session_start();
                    $_SESSION["usuario"] = $usuario;
                    header("location: ../index.php");
                } else{
                    $err_contrasena = "La contraseña es incorrecta";
                }
            }
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Iniciar sesion</h1>
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
                <input class="btn btn-primary" type="submit" value="Entrar">
                <br><br>
                <h3>No tienes cuenta?</h3>
                <a class="btn btn-secondary" href="registro.php">Registrarse</a>
                <br><br>
                <a class="btn btn-secondary" href="../index.php">Volver al Inicio</a>
            </div>
            
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
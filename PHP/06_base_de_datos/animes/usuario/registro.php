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
        require('../conexion.php');
    ?>
</head>
<body>
<div class="container">
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);//Hace el hash de la contraseña
            
            $sql = "INSERT INTO usuarios VALUES ('$usuario','$contrasena_cifrada')";
            $_conexion -> query($sql);
            header("location: iniciar_sesion.php");
            exit;
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Registro</h1>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Registrarse">
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar sesion</a>
            </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
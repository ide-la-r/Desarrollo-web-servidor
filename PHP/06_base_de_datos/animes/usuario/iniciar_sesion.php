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

        require('../conexion.php');
    ?>
</head>
<body>
<div class="container">
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $_conexion -> query($sql);
            //var_dump($resultado);

            if ($resultado -> num_rows == 0) {
                echo "<h2>El usuario $usuario no existe</h2>";
            }
            else{
                $datos_usuario = $resultado -> fetch_assoc();
                /**
                 * podemos acceder a:
                 * 
                 * $datos_usuario["usuario]
                 * $datos_usuario["contraseña]
                 */
                $acceso_concedido = password_verify($contrasena,$datos_usuario["contrasena"]);
                //var_dump($acceso_condedido);
                if($acceso_concedido){
                    //todo guay
                    session_start();
                    $_SESSION["usuario"] = $usuario;//esto me sirve en cualquier pagina a nivel del cliente, es accesible en cualqiuier parte, es una variable global, como en amazon cuando pone en todos sitios tu nombre 
                    //$_COOKIE["loquesea"] = $loquesea esto es a nivel del servidor
                    header("location: ../index.php");
                    exit;
                } else{
                    echo "<h2>La contraseña es incorrecra</h2>";
                }
            }
        }
    ?>
    <form class="col-4" action="" method="post" enctype="multipart/form-data">
        <h1>Iniciar sesion</h1>
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <div>
                <input class="btn btn-primary" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="registro.php">Registrarse</a>
                <a class="btn btn-secondary" href="../index.php">Volver</a>
            </div>
            
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario multiplos</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
<h2>Introduce tres numeros</h2>
    <form action="" method="post">
        <input type="text" name="numero1"><br>
        <input type="text" name="numero2"><br>
        <input type="text" name="numero3"><br>

        <input type="submit" name="Enviar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $a = $_POST["numero1"];
            $b = $_POST["numero2"];
            $c = $_POST["numero3"];
            $suma = 0;

            echo "<h3>Los multiplos desde $a hasta $b de $c son: </h3>";
            for ($i = $a; $i <= $b; $i++) {
                if ($i % $c == 0) {
                    echo "$i<br>";
                }
            }
        }
    ?>
</body>
</html>
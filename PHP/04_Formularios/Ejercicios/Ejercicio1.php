<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Mayor de tres</title>
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
            $numero1 = $_POST["numero1"];
            $numero2 = $_POST["numero2"];
            $numero3 = $_POST["numero3"];
            $mayor = max($numero1,$numero2,$numero3);

            echo "El mayor de los numeros es $mayor";
        }
    ?>
</body>
</html>
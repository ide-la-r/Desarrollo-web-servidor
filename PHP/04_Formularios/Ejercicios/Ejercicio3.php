<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primos entre dos numeros</title>
</head>
<body>
<h2>Introduce dos numeros</h2>
    <form action="" method="post">
        <p>Inicio: </p>
        <input type="text" name="numero1"><br>
        <p>Fin: </p>
        <input type="text" name="numero2"><br><br>

        <input type="submit" name="Enviar">

        
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $inicio = $_POST["numero1"];
            $fin = $_POST["numero2"];
            $primo = true;

            for ($i = $inicio; $i <= $fin; $i++) {
                for ($j = 2; $j < $i/2; $j++) { 
                    if ($i % $j == 0) $primo = false;
                }
                
                if ($primo == true) echo "El numero $i es primo<br>";
                $primo = true;
            }
        }
    ?>
</body>
</html>
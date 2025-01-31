
<!-- -CREAR UNA COPIA DE IRPF.PHP CON GET EN VEZ DE POST Y CONTROLAR LOS ERRORES DE ENVIAR EL FORMULARIO VACIO
        -CONTROLAR EN TODOS LOS DEMAS FORMULARIOS HECHOS CON POST QUE SI SE MANDAN LOS CAMPOS VACIOS, SE MUESTRE UN MENSAJE.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="number" name="salario" placeholder="Salario">
        <input type="submit" value="Calcular salario bruto">
    </form>
    <?php
    if (isset($_GET["salario"])) {
        $salario = $_POST["salario"];

        $salario_final = null;
        
        $tramo1 = (12450 * 0.19);
        $tramo2 = ((20200 - 12450) * 0.24);
        $tramo3 = ((35200 - 20200) * 0.30);
        $tramo4 = ((60000 - 35200) * 0.37);
        $tramo5 = ((300000 - 60000) * 0.45);

        if ($salario != '') {
            if($salario <= 12450) {
                $salario_final = $salario - ($salario * 0.19);
            } elseif ($salario > 12450 && $salario <= 20200) {
                $salario_final = $salario 
                    - $tramo1 
                    - (($salario - 12450) * 0.24); 
            } elseif ($salario > 20200 && $salario <= 35200) {
                $salario_final = $salario
                    - $tramo1
                    - $tramo2
                    - (($salario - 20200) * 0.30);
            } elseif ($salario > 35200 && $salario <= 60000) {
                $salario_final = $salario 
                    - $tramo1
                    - $tramo2 
                    - $tramo3
                    - (($salario - 35200) * 0.37);
            } elseif ($salario > 60000 && $salario <= 300000) {
                $salario_final = $salario 
                    - $tramo1
                    - $tramo2 
                    - $tramo3
                    - $tramo4
                    - (($salario - 60000) * 0.45);
            } else {
                $salario_final = $salario
                    - $tramo1
                    - $tramo2 
                    - $tramo3
                    - $tramo4
                    - $tramo5
                    - (($salario - 300000) * 0.47);
            }

            echo "<h1>El salario neto de $salario es $salario_final</h1>";
        }
        else {
            echo "Faltan datos por rellenar";
        }
    }
    ?>
</body>
</html>
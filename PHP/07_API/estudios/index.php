<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudios</title>
</head>
<body>
    <form action="" method="get">
        <label for="">Ciudad: </label>
        <input type="text" name="ciudad">
        <input type="submit" value="Buscar">
    </form>

    <?php
    //url para que manda ta,bien la ciudad por get en la url<zzzzz
        $apiUrl = "http://localhost/Ejercicios/Servidor/PHP/07_API/estudios/api_estudios.php";

        if (!empty($_GET["ciudad"])) {
            $ciudad = $_GET["ciudad"];
            $apiUrl = "$apiUrl?ciudad=$ciudad";
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); //Sirve para retornar datos
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $estudios = json_decode($respuesta, true);
        //print_r($estudios);
    ?>
    <table>
        <thead>
            <tr>
                <th>Estudio</th>
                <th>Ciudad</th>
                <th>Año de fundacion</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($estudios as $estudio){ ?>
                    <tr>
                        <td><?php echo $estudio["nombre_estudio"] ?></td>
                        <td><?php echo $estudio["ciudad"] ?></td>
                        <td><?php echo $estudio["anno_fundacion"] ?></td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</body>
</html>
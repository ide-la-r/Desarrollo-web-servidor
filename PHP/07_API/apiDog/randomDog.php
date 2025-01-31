<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perro random</title>
</head>
<body>
    <?php
    $apiUrl = "https://dog.ceo/api/breeds/image/random";
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);
    curl_close($curl);

    $datos = json_decode($respuesta, true);
    $foto = $datos["message"];
?>

<h1>Foto random de perro</h1>
<img src="<?php echo $foto ?>" alt="Foto random de perro">
<br><br>
<a href="./randomDog.php">Ver perro nuevo</a>
</body>
</html>
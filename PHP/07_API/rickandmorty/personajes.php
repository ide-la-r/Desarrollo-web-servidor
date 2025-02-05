<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Anime</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        $apiUrl = "https://rickandmortyapi.com/api/character";
        $cantidad = isset($_GET["quantity"]) ? $_GET["quantity"] : "";
        $genero = isset($_GET["gender"]) ? $_GET["gender"] : "";
        $especie = isset($_GET["species"]) ? $_GET["species"] : "";
        
        
        if (isset($_GET["gender"]) && isset($_GET["species"] ) && isset($_GET["quantity"] )) { 
            $apiUrl = "https://rickandmortyapi.com/api/character?gender=$genero&species=$especie";
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $personajes = $datos["results"];
    ?>

    <form action="" method="get">
        <label for="quantity" class="form-label">Cantidad de personajes:</label>
        <input type="text" name="quantity" id="quantity" class="form-control"><br>

        <label for="gender">Género:</label>
        <select name="gender" id="gender">
            <option value="">Ambos</option>
            <option value="male">Masculino</option>
            <option value="female">Femenino</option>
        </select><br>

        <label for="species">Especie:</label>
        <select name="species" id="species">
            <option value="">Ambos</option>
            <option value="human">Humano</option>
            <option value="alien">Alien</option>
        </select><br>
        <input type="submit" value="Buscar">
    </form>
    <br>

    <table>
        <thead>
            <tr>
                <th scope="col">Nombre personaje</th>
                <th scope="col">Genero</th>
                <th scope="col">Especie</th>
                <th scope="col">Origen del personaje</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($cantidad == "") $cantidad = count($personajes);
                if ($cantidad > count($personajes)) $cantidad = count($personajes);
                for($i = 0; $i < $cantidad; $i++) { ?>
                    <tr>
                        <td><?php echo $personajes[$i]["name"]?></td>
                        <td><?php echo $personajes[$i]["species"]?></td>
                        <td><?php echo $personajes[$i]["gender"]?></td>
                        <td><?php echo $personajes[$i]["origin"]["name"]?></td>
                        <td>
                            <img width="100px" src="<?php echo $personajes[$i]["image"]?>">
                        </td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</body>
</html>
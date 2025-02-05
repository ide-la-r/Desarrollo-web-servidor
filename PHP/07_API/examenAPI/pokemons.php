<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica Poke API</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        $apiUrl = "https://pokeapi.co/api/v2/pokedex/1/";
        $cantidad = isset($_GET["quantity"]) ? $_GET["quantity"] : "";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $pokemons = $datos["pokemon_entries"];
    ?>

    <form action="" method="get">
        <label for="quantity" class="form-label">Cantidad de personajes:</label>
        <input type="text" name="quantity" id="quantity" class="form-control">
        <input type="submit" value="Mostrar">
    </form>
    <table>
        <thead >
            <tr>
                <th scope="col">Pokemon</th>
                <th scope="col">Imagen</th>
                <th scope="col">Tipos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($cantidad == "") $cantidad = 5;
                if ($cantidad > count($pokemons)) $cantidad = count($pokemons);
                for($i = 1; $i < $cantidad + 1; $i++) { ?>
                    <tr>
                        <td scope="row"><?php echo ucwords($pokemons[$i-1]["pokemon_species"]["name"])?></td>
                        <?php
                            $apiUrlPokemon = "https://pokeapi.co/api/v2/pokemon/$i";
    
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_URL, $apiUrlPokemon);
                            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                            $respuestaPokemon = curl_exec($curl);
                            curl_close($curl);
                    
                            $datosPokemon = json_decode($respuestaPokemon, true);
                        ?>
                        <td>
                            <img width="200px" src="<?php echo $datosPokemon["sprites"]["front_default"]?>">
                        </td>
                        <?php
                            $tipos = $datosPokemon["types"];
                            foreach($tipos as $tipo) { ?>
                                <td><?php echo ucwords($tipo["type"]["name"]) ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</body>
</html>
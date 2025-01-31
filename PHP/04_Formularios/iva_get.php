<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iva</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>
    <!--
    General = 21%
    reducido = 10%
    superrreducido = 4%
    10 iva = general pvp 12,1
    10 iva = reducido pvp 11 
    -->
    <form action="" method="get">
        <input type="text" name="Precio">
        <br>
        <select name="iva" id="iva">
            <option value="General">General</option>
            <option value="Reducido">Reducido</option>
            <option value="Superreducido">Superreducido</option>
        </select>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <?php
        //if ($_SERVER["REQUEST_METHOD"] == "GET") {
        //isset (is set) devuelve true si la variable existe
        if (isset($_GET["Precio"]) and isset($_GET["iva"])) {//esto es que si las variables que tienen ese nombre estan rellenas se hace eso.
       
            $precio = $_GET["Precio"];
            $iva = $_GET["iva"];

            if ($precio != '' and $iva != '') {
                $pvp = match ($iva) {
                    "General" => $precio * 1.21,
                    "Reducido" => $precio * 1.10,
                    "Superreducido" => $precio * 1.04,
                };
                echo "<h3> El PVP es $pvp </h3>";
            }
            else {
                echo "<p>Te faltan datos</p>";
            }
            
        //} Si le quitas esto es lo mismo porque al cargar la pagina tenemos un get
        }
        //con el get se reenvian los mismos formularios n se vuelve a pregunbtar si quieres reenviar el formulario como el post
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iva</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require ("../05_funciones/iva.php");
    ?>
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!--
    General = 21%
    reducido = 10%
    superrreducido = 4%
    10 iva = general pvp 12,1
    10 iva = reducido pvp 11 
    -->
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $precio = $_POST["Precio"];
            
            
            if($precio == '') {
                $err_precio = "<p>El precio es obligatorio</p>";
            } else {
                if(filter_var($tmp_precio, FILTER_VALIDATE_FLOAT) === FALSE) {
                    $err_precio = "<p>El precio debe ser un número</p>";
                } else {
                    if($precio < 0) {
                        $err_precio = "<p>El precio debe ser mayor o igual que cero</p>";
                    } else {
                        $tmp_precio = $precio;
                    }
                }
            }


            if (isset($_POST["iva"])) $iva = $_POST["iva"];//comprobamos esto para que tenga que meterte algo si o si y si no lo manda vacio
            else $iva = "";
            
            if($iva == '') {
                $err_iva = "<p>El IVA es obligatorio</p>";
            } else {
                $valores_validos_iva = ["general", "reducido", "superreducido"];
                if(!in_array($iva, $valores_validos_iva)) {
                    $err_iva = "<p>El IVA solo puede ser: general, reducido, superreducido</p>";
                } else {
                    $tmp_iva = $iva;
                }
            }
        }
    ?>
<!--
    Ponemos el php arriba porque si no la variable err_precio no existiria, siemor ese recomienda ponerlo arriba
    Aparte no influye porque la pagina cuando la abres entra por get, y cuando mandas el formulario se reinicia la pagina
    y sale el post y ya ahi se ejecuta el codigo php.
-->
    <form action="" method="post">
        <input type="text" name="Precio">
        <?php if(isset($err_precio)) echo "<span class = 'error'>$err_precio</span>";?><!--si se ha producido algun error sale por pantalla-->
        <br>
        <select name="iva" id="iva">
            <option disabled selected hidden>--- Elige un tipo de IVA ---</option><!-- Esto le pone un enunciado a lo de las opciones -->
            <option value="General">General</option>
            <option value="Reducido">Reducido</option>
            <option value="Superreducido">Superreducido</option>
        </select>
        <?php if(isset($err_iva)) echo "<span class = 'error'>$err_iva</span>";?>
        <br>
        <input type="submit" value="Calcular">
    </form>

    <!-- Ponemos esto aqui para que nos salga el precio abajo y no arriba -->
    <?php 
        if(isset($tmp_precio) && isset($tmp_iva)) {
            echo "<h1>El PVP es " . iva($tmp_precio, $tmp_iva) . "</h1>";
        }
    ?>
</body>
</html>
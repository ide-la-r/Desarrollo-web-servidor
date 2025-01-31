<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4 Formularios</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );

        require ('../../05_funciones/calculadora.php');
        require ('../../05_funciones/potencias.php');
        require ('../../05_funciones/iva.php');
        require ('../../05_funciones/irpf.php');
    ?>
</head>
<body>

    <h1>Formulario Calculadora</h1>

    <form action="" method="post">
        
        <label for="numero">Numero</label>
        <input type="text" name="numero" id="numero"><br><br>
        <input type="hidden" name="accion" value="formulario_Calculadora">
        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["accion"] == "formulario_Calculadora") {
                $numero = $_POST["numero"];
                calculadora($numero);
            }    
        }
    ?>

<h1>Formulario Potencias</h1>

    <form action="" method="post">
        <label for="base">Base</label>
        <input type="text" name="base" id="base"><br><br>
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente"><br><br>
        <input type="hidden" name="accion" value="formulario_Potencias">
        <input type="submit" value="Enviar">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["accion"] == "formulario_Potencias") {
                $base = $_POST["base"];
                $exponente = $_POST["exponente"];

                potencias($base, $exponente);
            }    
        }
    ?>

    <h1>Formulario Iva</h1>

    <form action="" method="post">
        <input type="text" name="Precio">
        <br>
        <select name="iva" id="iva">
            <option value="General">General</option>
            <option value="Reducido">Reducido</option>
            <option value="Superreducido">Superreducido</option>
        </select>
        <br>
        <input type="hidden" name="accion" value="formulario_Iva">
        <input type="submit" value="Calcular">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["accion"] == "formulario_Iva") {
                $precio = $_POST["Precio"];
                $iva = $_POST["iva"];

                iva($precio, $iva);
            }    
        }
    ?>

    <h1>Formulario IRPF</h1>

    <form action="" method="post">
        <input type="number" name="salario" placeholder="Salario">
        <input type="hidden" name="accion" value="formulario_Irpf">
        <input type="submit" value="Calcular salario bruto">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST["accion"] == "formulario_Irpf") {
                $salario = $_POST["salario"];

                irpf($salario);
            }    
        }
    ?>
    
</body>
</html>
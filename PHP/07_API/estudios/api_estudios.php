<?php
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    header("Content-Type: application/json");
    include("conexion_pdo.php");

    $metodo = $_SERVER["REQUEST_METHOD"];
    $entrada = json_decode(file_get_contents('php://input'), true);//coje todos los imput y ya nosotros escojemos cual queremos
    /**
     * $entrada["numero"] -> <input name = "numero">
     */

    switch($metodo) {
        case "GET":
            manejarGet($_conexion);
            break;
        case "POST":
            manejarPost($_conexion, $entrada);
            break;
        case "PUT":
            manejarPut($_conexion, $entrada);
            break;
        case "DELETE":
            manejarDelete($_conexion, $entrada);
            break;
        default:
            echo json_encode(["mensaje" => "otro"]);
            break;
    }

    function manejarGet($_conexion){
        if (isset($_GET["ciudad"])) {
            $sql = "SELECT * FROM estudios WHERE ciudad = :ciudad";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"]
            ]);
        } else{
            $sql = "SELECT * FROM estudios";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute();
        }
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); //Equivalencia al getResult de mysql
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada){
        $sql = "INSERT INTO estudios (nombre_estudio, ciudad, anno_fundacion) 
            VALUES (:nombre_estudio, :ciudad, :anno_fundacion)";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);
        if ($stmt) {
            echo json_encode(["mensaje" => "El estudio se ha insertado correctamente"]);
        } else{
            echo json_encode(["mensaje" => "Error al insertar el estudio"]);
        }
    }

    function manejarPut($_conexion, $entrada){
        $sql = "UPDATE estudios SET 
            ciudad = :ciudad,
            anno_fundacion = :anno_fundacion
            WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"],
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if ($stmt) {
            echo json_encode(["mensaje" => "el estudio se ha actualizado correctamente"]);
        }else {
            echo json_encode(["mensaje" => "ERROR, el estudio  NO se ha actualizado"]);
        }
    }

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);
        if ($stmt) {
            echo json_encode(["mensaje" => "El estudio se ha borrado correctamente"]);
        } else{
            echo json_encode(["mensaje" => "Error al borrar el estudio"]);
        }
    }
?>
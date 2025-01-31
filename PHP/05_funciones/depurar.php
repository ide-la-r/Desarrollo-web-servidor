<?php
function depurar(string $entrada) : string {//para que los parametros sean string y lo que salga sea string
    $salida = htmlspecialchars($entrada);//esto nos pone en modo texto cualquier cosa por si nos mete scripts y demas
    $salida = trim($salida); // esto lo que hace es quitar los espacios de los laterales
    $salida = stripslashes($salida); // esto te quita muchos \ que te puedan hacer bugs dentro de la aplicacion.
    $salida = preg_replace('!\s!', ' ', $salida); //esto nos quita todos los espacios sobrantes dentro de la cadena
    return $salida;
}


/*
EXPLICACION MANUVA

function depurar(string $entrada) : string {
    // Para que el usuario no pueda usar etiquetas en los campos Ej: <h1>Hola</h1>
    $salida = htmlspecialchars($entrada);
    // Para quitar los espacios de delante y detrás
    $salida = trim($salida);
    // Quita posibles bugs muy raros como que el usuario introduzca: \n (No está de más ponerla)
    $salida = stripcslashes($salida);
    // Para quitar los múltiples espacios entre variables y demás
    $salida = preg_replace('!\s+!', ' ', $salida);
    return $salida;
}

*/

?>

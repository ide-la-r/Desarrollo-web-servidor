<?php
	FUNCIONES PHP IMPORTANTES

	Para poner un patron:
		--> $patron = "/^...$/";

	preg_match($patron, $variable);
		--> Te comprueba si la variable cumple la condicion de el patron.
	strlen($variable);
		--> Te dice el tamaño que tiene la variable.
	isset($variable);
		--> Te dice si la variable ha sido creada o no;
	filter_var($variable, FILTER_VALIDATE_EMAIL);
		--> Te valida si la variable es un email.
		""("", FILTER_VALIDATE_FLOAT);
			--> Te valida si la variable es un float
		""("", FILTER_VALIDATE_INT);
			--> Te valida si la variable es un int
	in_array($variable, $array);
		--> Te dice si lo que hay en la variable esta dentro del array;
	strtoupper($variable);
		--> Pone Las letras en mayusculas
	substr($variable, n1, n2);
		--> Te coge la parte de la cadena que le digas desde n1, mientras que n2 es el numero de caracteres que coge.
	date("Y-m-d");
		--> Obtiene la fecha actual en un formato especifico.
		""("d/m/Y");
			--> Obtiene la fecha en un formato especifico.
	explode('caracter', $variable);
		--> Divide una cadena en varias partes usanso el caracter como punto de corte y devuelve un array.
	str_contains($cadena, $buscar);
		--> Busca el contenido de la variable buscar en la cadena;
	is_numeric($variable);
		--> Ve si la variable es numerica
	ucwords($variable);
		--> Convierte la primera letra de cada palabra en una cadena de texto

	function depurar(string $entrada) : string {  --> Para que los parametros sean string y lo que salga sea string.
		$salida = htmlspecialchars($entrada);  --> Esto nos pone en modo texto cualquier cosa por si nos mete scripts y demas.
		$salida = trim($salida);  --> Esto lo que hace es quitar los espacios de los laterales.
		$salida = stripslashes($salida);  --> esto te quita muchos \ que te puedan hacer bugs dentro de la aplicacion.
		$salida = preg_replace('!\s!', ' ', $salida);  --> esto nos quita todos los espacios sobrantes dentro de la cadena.
		return $salida;
	}

?>
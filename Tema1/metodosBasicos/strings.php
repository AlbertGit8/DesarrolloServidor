<?php

// ***LONGITUD Y MANIPULACIÓN BÁSICA***
strlen($string); //Devuelve la longitud de una cadena.

substr($string, $start, $length); //Extrae una parte de la cadena desde la posición $start y con longitud $length.

strrev($string); //Invierte la cadena


// ***CAMBIO DE MAYÚSCULAS Y MINUSCULAS***
strtoupper($string); //Convierte toda la cadena a mayúsculas.

strtolower($string); //Convierte toda la cadena a minúsculas.

ucfirst($string); //Convierte la primera letra de la cadena a mayúscula.

ucwords($string); //Convierte la primera letra de cada palabra en mayúscula.


// ***BÚSQUEDA Y REMPLAZO***
strpos($haystack, $needle); //Encuentra la posición de la primera ocurrencia de $needle en $haystack.

strrpos($haystack, $needle); //Encuentra la posición de la última ocurrencia de $needle en $haystack.

strstr($haystack, $needle); //Encuentra la primera ocurrencia de $needle y devuelve el resto de la cadena desde allí.

str_replace($search, $replace, $string); //Reemplaza todas las ocurrencias de $search en $string con $replace.

str_ireplace($search, $replace, $string); //Lo mismo que str_replace, pero no es sensible a mayúsculas.


// ***DIVIDIR Y UNIR CADENAS***
explode($delimiter, $string); //Divide una cadena en un array, usando $delimiter como separador.

implode($glue, $array); //Une los elementos de un array en una cadena, utilizando $glue como separador.


// ***FORMATEO Y REMOCIÓN DE ESPACIOS***
trim($string); //Elimina los espacios en blanco al inicio y al final de la cadena.

ltrim($string); //Elimina los espacios al inicio de la cadena.

rtrim($string); //Elimina los espacios al final de la cadena.

str_pad($string, $length, $pad_string); //Rellena la cadena a una longitud específica con un carácter o cadena adicional.


// ***CONVERSIÓN DE CÓGIGOS ASCII***
ord($char); //Devuelve el valor ASCII de un carácter.

chr($ascii); //Devuelve el carácter de un valor ASCII.


// ***COMPARACIÓN DE CADENAS***
strcmp($string1, $string2); //Compara dos cadenas de forma sensible a mayúsculas. Devuelve 0 si son iguales.

strcasecmp($string1, $string2); //Compara dos cadenas de forma insensible a mayúsculas.

?>
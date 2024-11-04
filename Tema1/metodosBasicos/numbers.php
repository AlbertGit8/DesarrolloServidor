<?php

// ***FUNCIONES MATEMATICAS BÁSICAS***
abs($num); //Devuelve el valor absoluto de un número.

round($num, $precision); //Redondea un número a una cantidad especificada de decimales.

ceil($num); //Redondea un número hacia arriba al entero más cercano.

floor($num); //Redondea un número hacia abajo al entero más cercano.

max($array); //Devuelve el valor máximo de un array o de una lista de números.

min($array); //Devuelve el valor mínimo de un array o de una lista de números.


// ***FUNCIONES DE CONVERSIÓN***
intval($var); //Convierte un valor a un número entero.

floatval($var); //Convierte un valor a un número de punto flotante.

number_format($num, $decimals); //Formatea un número con miles y decimales, devolviendo una cadena.


// ***ALEATORIEDAD***
rand($min, $max); //Genera un número aleatorio entre $min y $max.

mt_rand($min, $max); //Genera un número pseudoaleatorio con mejor rendimiento que rand.

random_int($min, $max); //Genera un número aleatorio criptográficamente seguro entre $min y $max.


// ***EXPONENCIALES***
pow($base, $exp); //Calcula el valor de $base elevado a la potencia $exp.

sqrt($num); //Devuelve la raíz cuadrada de un número.



?>
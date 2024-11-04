<?php

// ***CREACIÓN Y MANIPULACIÓN BÁSICA***
array_push($array, $elemento); //Añade uno o más elementos al final del array.

array_pop($array); //Elimina y devuelve el último elemento del array.

array_unshift($array, $elemento); //Añade uno o más elementos al inicio del array.

array_shift($array); //Elimina y devuelve el primer elemento del array.

array_merge($array1, $array2); //Combina dos o más arrays y devuelve el array resultante.


// ***EXTRACCIÓN DE CLAVES Y VALORES***
array_keys($array); //Devuelve todas las claves de un array.

array_values($array); //Devuelve todos los valores de un array.

array_key_exists($key, $array); //Comprueba si una clave existe en el array.

in_array($valor, $array); //Comprueba si un valor existe en el array.


// ***FILTRADO, BÚSQUEDA Y REDUCCIÓN***
array_filter($array, $callback); //Filtra elementos del array usando una función de callback.

array_map($callback, $array); //Aplica una función a cada elemento del array.

array_reduce($array, $callback, $initial); //Reduce un array a un solo valor acumulado, aplicando una función de callback.

array_search($valor, $array); //Busca un valor en un array y devuelve la clave correspondiente.


// ***ORDENACIÓN***
sort($array); //Ordena el array en orden ascendente, reindexando las claves numéricas.

rsort($array); //Ordena el array en orden descendente.

asort($array); //Ordena el array en orden ascendente, manteniendo las claves.

arsort($array); //Ordena el array en orden descendente, manteniendo las claves.

ksort($array); //Ordena un array en orden ascendente por clave.

krsort($array); //Ordena un array en orden descendente por clave.


// ***DIVISIÓN Y SUMA***
array_slice($array, $offset, $length); //Extrae una parte del array.

array_splice($array, $offset, $length, $replacement); //Elimina una parte del array y la reemplaza.

array_sum($array); //Devuelve la suma de todos los valores en un array.


// ***CONTEO Y COMPARACIÓN***
count($array); //Devuelve el número de elementos en el array.

array_count_values($array); //Cuenta el número de veces que un valor aparece en un array.

array_diff($array1, $array2); //Compara dos arrays y devuelve los valores que están en $array1 pero no en $array2.


// ***TRANSFORMACIÓN Y CLONACIÓN***
array_reverse($array); //Devuelve un array con el orden de los elementos invertido.

array_unique($array); //Elimina valores duplicados del array.

array_column($array, $column_key); //Extrae una columna de un array multidimensional.


// ***COMBINACIÓN Y PARTICIONAMIENTO***
array_combine($keys, $values); //Crea un array combinando un array de claves y otro de valores.

array_chunk($array, $size); //Divide un array en fragmentos de un tamaño especificado.

?>
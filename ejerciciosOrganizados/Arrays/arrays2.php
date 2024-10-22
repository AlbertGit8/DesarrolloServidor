<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 2</title>
</head>
<body>
    <?php
    //Implementa un array de 15 números enteros generados aleatoriamente. El programa incluye una función para buscar un número específico dentro del array y devolver su posición. Si el número no se encuentra, la función retorna -1. Además, se muestra el array completo y la posición del número buscado.

    function buscar($num, $array) {
        foreach ($array as $key => $value) {
            if ($num == $value) {
                return $key;
            }
        }
        return -1;
    }

    $array = array();

    for ($i=0; $i < 15; $i++) { 
        $array[$i] = rand(1, 10);
    }

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo " ]<br>";

    $buscado = buscar(5, $array);

    if ($buscado == -1) {
        echo "El número a buscar es 5 pero no se haya en el array";
    } else {
        echo "El número a buscar es 5 y se haya en la posicion $buscado";
    }


    ?>
</body>
</html>
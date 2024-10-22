<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 1</title>
</head>
<body>
    <?php
    //Crea un array de 10 números enteros en PHP, donde cada posición del array se rellena con valores generados mediante una operación aritmética. Luego, algunos de los valores son modificados manualmente. Finalmente, se recorre el array usando un bucle foreach para mostrar las claves y valores.

    //generamos el array
    $array = array();

    //lo rellenamos mediante un for cada posicion de una operacion aritmetica
    for ($i=0; $i < 10; $i++) { 
        $array[$i] = $i*2; 
    }

    //Modificamos manualmente los valores
    $array[2] = 99;

    $array[7] = 88;

    //recorremos y mostramos clave y valores
    foreach ($array as $clave => $valor) {
        echo "Clave: $clave, Valor: $valor<br>";
    }


    ?>
</body>
</html>
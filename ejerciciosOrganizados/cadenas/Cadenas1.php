<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadenas1</title>
</head>

<body>
    <?php
    //Realiza operaciones básicas sobre cadenas, como obtener su longitud, dividir el texto en partes y mostrar la información procesada.

    function lenght($cadena)
    {
        $longitud = 0;

        while (isset($cadena[$longitud])) { // Recorre cada carácter de la cadena hasta llegar al final
            $longitud++;
        }

        return $longitud;
    }

    function dividir($cadena, $division)
    {
        $dividida = array();
        $longitud = lenght($cadena); // Obtenemos la longitud de la cadena una vez

        // Calcular el tamaño de cada parte
        $parteLongitud = intval($longitud / $division); // Número de caracteres por división
        $contador = 0;

        for ($i = 0; $i < $division; $i++) {
            $char = ""; // Inicializamos una cadena vacía para cada parte

            // Concatenamos la cantidad de caracteres adecuada a cada parte
            for ($j = 0; $j < $parteLongitud && $contador < $longitud; $j++) {
                $char .= $cadena[$contador];
                $contador++;
            }

            // Agregamos la cadena parcial al array
            $dividida[] = $char;
        }

        // Si quedan caracteres sin agregar, los anexamos a la última división
        if ($contador < $longitud) {
            $dividida[count($dividida) - 1] .= substr($cadena, $contador);
        }

        return $dividida;
    }

    $texto = "Hola a todos amigos de youtube, que tal como estan, yo bien";
    $division = 3;

    $dividido = dividir($texto, $division);

    echo "$texto<br>";
    echo "La longitud del texto es " . lenght($texto) . "<br>";
    echo "Dividiremos el texto en $division partes<br>";

    foreach ($dividido as $key => $value) {
        echo "$value<br>";
    }
    ?>

</body>

</html>
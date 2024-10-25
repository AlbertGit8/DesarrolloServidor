<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 7</title>
</head>

<body>
    <?php
    //Similar al ejercicio anterior, pero aquí el objetivo es encontrar y mostrar el número más pequeño en un array de números enteros generados aleatoriamente.

    function menor($array)
    {
        $min = 0;

        foreach ($array as $key => $value) {
            if ($key == 0) {
                $min = $value;
            } else {
                if ($value < $min) {
                    $min = $value;
                }
            }
        }

        return $min;
    }

    $array = array();

    for ($i = 0; $i < 10; $i++) {
        $array[$i] = rand(-20, 20);
    }

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo " ]<br><br>";

    echo "El numero menor del array es " . menor($array);
    ?>
</body>

</html>
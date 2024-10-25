<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 6</title>
</head>
<body>
    <?php
    //Este ejercicio busca el número mayor en un array de números enteros generados aleatoriamente. Después de llenar el array, el programa recorre los elementos para encontrar y mostrar el mayor número.

    function mayor($array) {
        $max = 0;

        foreach ($array as $key => $value) {
            if ($key == 0) {
                $max = $value;
            } else {
                if ($value > $max) {
                    $max = $value;
                }
            }
        }

        return $max;
    }

    $array = array();

    for ($i=0; $i < 10; $i++) { 
        $array[$i] = rand(1, 20);
    }

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo " ]<br><br>";

    echo "El numero mayor del array es ".mayor($array); 
    ?>
</body>
</html>
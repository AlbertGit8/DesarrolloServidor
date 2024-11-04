<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 8</title>
</head>

<body>
    <?php
    //Crea un programa en PHP que utiliza un algoritmo de ordenación para ordenar los números dentro de un array. Después de generar los números, estos se muestran antes y después del proceso de ordenación.

    $array = array();

    for ($i = 0; $i < 10; $i++) {
        $array[$i] = rand(1, 15);
    }

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo "] <br><br>";

    sort($array);

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo "] <br><br>";
    ?>
</body>

</html>
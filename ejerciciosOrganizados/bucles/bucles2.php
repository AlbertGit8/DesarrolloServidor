<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 2</title>
</head>

<body>
    <?php
    //Implementa dos bucles anidados que imprimen los números del 1 al 100. El bucle externo controla las filas, y el bucle interno controla las columnas.
    $multiplicador = 1;
    for ($i = 0; $i < 10; $i++) {

        for ($j = 0; $j < 10; $j++) {

            echo "$multiplicador ";
            $multiplicador++;

            if ($j == 9) {
                echo "<br>";
            }
        }
    }

    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 6</title>
</head>

<body>
    <?php
    // Escribe un programa en PHP que utilice un bucle while para imprimir un número aleatorio de iteraciones. El número de iteraciones se selecciona aleatoriamente al principio y el bucle imprime un mensaje para cada iteración. 

    $contador = 1;
    $itereaciones = rand(1, 30);

    while ($contador != $itereaciones) {
        echo "Iteracion número $contador <br>";

        $contador++;
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 8 - Funciones</title>
</head>

<body>
    <?php
    //Este archivo define varias funciones en PHP, como una para calcular potencias y otra para decrementar un número. Las funciones son invocadas en el código principal para mostrar resultados de cálculos matemáticos.

    function potencia($num, $expo)
    {
        $result = 0;

        for ($i = 1; $i < $expo; $i++) {
            
            if ($i==1) {
                $result = $num * $num;
            } else {
                $result = $num *$result;
            }
        }

        return $result;
    }

    function decrementar($num)
    {
        return $num - 1;
    }

    // Invocar la función para calcular una potencia
    $base = 5;
    $exponente = 3;
    $resultadoPotencia = potencia($base, $exponente);
    echo "La potencia de $base elevado a $exponente es: $resultadoPotencia<br>";

    // Invocar la función para decrementar un número
    $numero = 10;
    $resultadoDecremento = decrementar($numero);
    echo "El número $numero decrementado es: $resultadoDecremento\n";

    ?>
</body>

</html>
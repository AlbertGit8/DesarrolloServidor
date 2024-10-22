<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 9</title>
</head>

<body>
    <?php
    //Implementa varias funciones en PHP, cada una de las cuales realiza una tarea específica, como cálculos matemáticos o manipulación de variables. Las funciones son invocadas dentro de bucles para procesar y mostrar resultados.

    // Función para calcular el cuadrado de un número
    function calcularCuadrado($numero)
    {
        return $numero * $numero;
    }

    // Función para sumar un número a una variable acumulativa
    function sumarAcumulativo($acumulador, $valor)
    {
        return $acumulador + $valor;
    }

    // Función para invertir una cadena
    function invertirCadena($cadena)
    {
        return strrev($cadena); // strrev() invierte una cadena en PHP
    }

    // Función para calcular el factorial de un número
    function calcularFactorial($numero)
    {
        $factorial = 1;
        for ($i = 1; $i <= $numero; $i++) {
            $factorial *= $i;
        }
        return $factorial;
    }

    // Código principal

    // 1. Calcular y mostrar el cuadrado de los primeros 5 números
    echo "Cuadrados de los primeros 5 números:\n";
    for ($i = 1; $i <= 5; $i++) {
        $cuadrado = calcularCuadrado($i);
        echo "El cuadrado de $i es: $cuadrado\n";
    }

    echo "\n";

    // 2. Acumular la suma de los números del 1 al 5
    $acumulador = 0;
    echo "Sumando números del 1 al 5:\n";
    for ($i = 1; $i <= 5; $i++) {
        $acumulador = sumarAcumulativo($acumulador, $i);
        echo "Acumulador tras sumar $i: $acumulador\n";
    }

    echo "\n";

    // 3. Invertir una lista de cadenas
    $cadenas = array("PHP", "programación", "funciones", "bucles");
    echo "Inversión de cadenas:\n";
    foreach ($cadenas as $cadena) {
        $cadenaInvertida = invertirCadena($cadena);
        echo "La cadena '$cadena' invertida es: '$cadenaInvertida'\n";
    }

    echo "\n";

    // 4. Calcular el factorial de números del 1 al 5
    echo "Factoriales de los números del 1 al 5:\n";
    for ($i = 1; $i <= 5; $i++) {
        $factorial = calcularFactorial($i);
        echo "El factorial de $i es: $factorial\n";
    }
    ?>

</body>

</html>
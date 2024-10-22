<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 10</title>
</head>

<body>
    <?php
    //Crea un programa que utiliza bucles para generar una tabla HTML con un número predefinido de filas y columnas. Los valores de cada celda de la tabla son calculados y mostrados dinámicamente.

    // Número de filas y columnas de la tabla
    $filas = 5;
    $columnas = 5;

    echo "<table border='1'>";  // Comienza la tabla HTML

    // Bucle para las filas
    for ($i = 1; $i <= $filas; $i++) {
        echo "<tr>";  // Inicia una nueva fila
        // Bucle para las columnas
        for ($j = 1; $j <= $columnas; $j++) {
            // Calcular el valor de cada celda (por ejemplo, el producto de $i * $j)
            $valorCelda = $i * $j;
            echo "<td>$valorCelda</td>";  // Crear la celda con el valor calculado
        }
        echo "</tr>";  // Cierra la fila
    }

    echo "</table>";  // Cierra la tabla HTML
    ?>

</body>

</html>
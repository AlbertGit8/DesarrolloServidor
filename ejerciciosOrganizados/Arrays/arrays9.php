<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 9</title>
</head>

<body>
    <?php
    //Genera una matriz bidimensional (array de arrays) y permite al usuario rellenar la matriz con números generados aleatoriamente. El programa también incluye funciones para mostrar y manipular la matriz.

    $filas = "";
    $colum = "";
    $limit = "";

    if (isset($_GET['generar'])) {
        $filas = $_GET['filas'];
        $colum = $_GET['colum'];
        $limit = $_GET['limit'];
    }


    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <label for="limit">Indica hasta que límite quieres que se generen los números:</label><br>
            <input type="number" id="limit" name="limit" value="<?php echo $limit ?>"><br><br>

            <label for="colum">Nº columnas:</label><br>
            <input type="number" id="colum" name="colum" pattern="^[1-9]\d*$" title="Por favor, ingresa un número entero positivo" value="<?php echo $colum ?>"><br><br>

            <label for="filas">Nº filas:</label><br>
            <input type="number" id="filas" name="filas" value="<?php echo $filas ?>" pattern="^[1-9]\d*$" title="Por favor, ingresa un número entero positivo" value="<?php echo $filas ?>"><br><br>

            <input type="submit" name="generar" value="generar">
        </form>
    </fieldset>

    <?php

    $matriz = array();

    for ($i = 0; $i < $filas; $i++) {

        $matriz[$i] = array();

        for ($j = 0; $j < $colum; $j++) {
            $matriz[$i][$j] = rand(1, $limit);
        }
    }

    foreach ($matriz as $fila) {


        foreach ($fila as $valor) {
            echo $valor . " ";
        }
        echo "<br>";
    }

    ?>
</body>

</html>
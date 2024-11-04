<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 4</title>
</head>

<body>
    <?php
    //Crea un array de números enteros y permite que el usuario defina el tamaño del array y un límite superior para los números. El programa también cuenta cuántas veces se repiten los números y muestra aquellos que superan una cierta cantidad de repeticiones.

    $tam = "";
    $lim = "";

    if (isset($_GET['crear'])) {
        $tam = $_GET['tam'];
        $lim = $_GET['lim'];

        $array = array();

        for ($i = 0; $i < $tam; $i++) {
            $array[$i] = rand(1, $tam);
        }
    }

    ?>


    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=" get">
            <label for="tam">Tamaño array: </label><br>
            <input type="number" id="tam" name="tam" value="<?php echo $tam ?>"><br><br>

            <label for="lim">Límite array: </label><br>
            <input type="number" id="lim" name="lim" value="<?php echo $lim ?>"><br><br>

            <input type="submit" name="crear" value="crear">
        </form>
    </fieldset>

    <?php

    if (isset($_GET['crear'])) {
        //funcion que cuenta cuantas veces esta repetido un valor dentro de un array
        function contar($array, $num)
        {
            $contador = 0;

            foreach ($array as $key => $value) {
                if ($num === $value) {
                    $contador++;
                }
            }

            return $contador;
        }

        //funcion que recorre un array y verifica si un numero se encuentra o no
        function recorrer($array, $num)
        {
            foreach ($array as $key => $value) {
                if ($num === $value) {
                    return true;
                }
            }
            return false;
        }

        $arraySinrepetir = array();

        //rellenamos un array auxiliar con los valores del array sin repetir
        foreach ($array as $key => $value) {
            if (!recorrer($arraySinRepetir, $value)) { // si el valor del array normal ya se encuentran en el array auxiliar no se almacenan

                $arraySinRepetir[$key] = $value;
            }
        }

        echo "[ ";
        foreach ($array as $key => $value) {
            echo "$value ";
        }
        echo " ]<br><br>";

        foreach ($arraySinRepetir as $key => $value) {
            if(contar($array, $value)>2) {
                echo "$value se repite más de dos veces<br>";
            }
        }
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 10</title>
</head>

<body>
    <?php
    //Implementa operaciones de conjunto (unión, intersección y diferencia) entre dos arrays. El usuario ingresa dos conjuntos de números, y el programa realiza las operaciones y muestra los resultados de cada una

    function union($arr1, $arr2) {
        $union = array_merge($arr1,$arr2);

        return $union;
    }

    if (isset($_GET['guardar'])) {
        $text1 = $_GET['arr1'];
        $text2 = $_GET['arr2'];

        $arr1 = explode(",",$text1);
        $arr2 = explode(",",$text2);
    }


    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="arr1">Introduce el primer conjunto de arrays separado por comas:</label><br>
        <input type="text" id="arr1" name="arr1"
            pattern="^\d+(,\d+)*$"
            title="Introduce solo números separados por comas, sin espacios ni otros caracteres"
            >
        <br><br>

        <label for="arr2">Introduce el segundo conjunto de arrays separado por comas:</label><br>
        <input type="text" id="arr2" name="arr2"
            pattern="^\d+(,\d+)*$"
            title="Introduce solo números separados por comas, sin espacios ni otros caracteres"
            >
        <br><br>

        <input type="submit" name="guardar" value="Guardar Conjuntos">
        <br><br>
        <input type="submit" name="union" value="union">
        <input type="submit" name="interseccion" value="interseccion">
        <input type="submit" name="diferencia" value="diferencia">
        <br><br>
    </form>

    <?php

    if (isset($_GET['guardar']) || isset($_GET['union']) || isset($_GET['interseccion']) || isset($_GET['diferencia'])) {

        echo "<input type='text' id='nombre' name='nombre' value='' readonly><br><br>";
        echo "[ ";
        foreach ($arr1 as $key => $value) {
            echo "$value ";
        }
        echo " ]<br>";

        
        echo "[ ";
        foreach ($arr2 as $key => $value) {
            echo "$value ";
        }
        echo " ]<br>";
    }

    if (isset($_GET['union'])) {
        
        echo "<h2>UNION</h2>";

        echo "[ ";
        foreach ($union as $key => $value) {
            echo "$value ";
        }
        echo " ]<br>";
    }

    ?>

</body>

</html>
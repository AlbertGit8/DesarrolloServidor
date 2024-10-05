<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $filas = "";
    $columnas = "";

    if (isset($_GET['mostrar'])) {
        $filas = $_GET['fila'];
        $columnas = $_GET['columna'];
    }
    ?>


    <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Tamaño columna<select name="columna" id="">
            <option value="<?php echo $columnas ?>"></option>
            <?php
            for ($i = 1; $i <= 10; $i++) {

                if ($i == $columnas) {
                    echo "<option value= '$i' selected>$i</option>";
                } else {
                    echo "<option value= '$i'>$i</option> ";
                }
            }


            ?>
        </select>
        Tamaño fila<select name="fila" id="">
            <option value="<?php echo $filas ?>"></option>
            <?php
            for ($i = 1; $i <= 10; $i++) {

                if ($i == $filas) {
                    echo "<option value= '$i' selected>$i</option>";
                } else {
                    echo "<option value= '$i'>$i</option> ";
                }
            }


            ?>
        </select>

        <input type="submit" name="mostrar" value="mostrar">


    </form>

<table border="2">
    <?php

    

    for ($i=0; $i < $filas ; $i++) { 
        echo "<tr>";
        for ($j=0; $j < $columnas; $j++) { 
            $num = rand(1,50);
            echo "<td>$num</td>";
        }
        echo "</tr>";
    }

    ?>
    </table>
</body>

</html>
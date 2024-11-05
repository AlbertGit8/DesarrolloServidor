<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $tam = '';

    if (isset($_GET['mostrar'])) {
        $tam = $_GET['tamano'];
    }
    ?>

    <fieldset>
        <legend>Creación de array</legend>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            De que tamaño quieres el array: <select name="tamano" id="">
                <option value="<?php echo $tam ?>"></option>
                <?php
                for ($i = 10; $i <= 20; $i++) {

                    if ($i == $tam) {
                        echo "<option value= '$i' selected>$i</option>";
                    } else {
                        echo "<option value= '$i'>$i</option> ";
                    }
                }
                ?>

            </select>
            <br>
            Hasta que número quieres que sean los elementos del array: <input type="number" name="numero" value="<?php isset($_GET['mostrar']) == TRUE ? $numero : "" ?>"">

            <input type="submit" name="mostrar" value="mostrar">
        </form>
    </fieldset>

    <?php

    if (isset($_GET['mostrar'])) {
        $lista = array();
        
        

        $num = $_GET['numero'];
        $tam = $_GET['tamano'];

        for ($i = 0; $i < $tam; $i++) {
            $lista[$i] = rand(1, $num);
        }
        $max = $lista[0];

        echo "[ ";
        foreach ($lista as $key => $value) {
            echo "$value ";

            if ($value > $max) {
                $max = $value;
            }
        }
        echo " ] <br>";

        echo "El mayor numero del array es $max";
    }


    ?>
</body>

</html>
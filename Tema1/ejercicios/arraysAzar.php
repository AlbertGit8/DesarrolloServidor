<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <legend>Creación de array</legend>

    <?php
    $oper = '';

    if (isset($_GET['mostrar'])) {
        $oper = $_GET['operacion'];

        $array1 = array();
        $array2 = array();

        echo "[ ";
        for ($i = 0; $i < 10; $i++) {
            $array1[]  = rand(1, 20);
            echo "$array1[$i] ";
        }
        echo " ]<br>";

        echo "[ ";
        for ($i = 0; $i < 10; $i++) {
            $array2[]  = rand(1, 20);
            echo "$array2[$i] ";
        }
        echo " ]<br>";
    }



    ?>

    <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Que quieres hacer con ambos array: <select name="operacion">
            <option value="u" <?php if ($oper = "u") {
                                    echo "selected";
                                } ?>>Union</option>
            <option value="i" <?php if ($oper = "i") {
                                    echo "selected";
                                } ?>>Interseccion</option>
            <option value="d" <?php if ($oper = "d") {
                                    echo "selected";
                                } ?>>Diferencia</option>

        </select>
        <br>

        <input type="submit" name="mostrar" value="mostrar">
    </form>

    <?php
    //crear dos arrays de 10 numeros al azar con numeros del 1 al 20, luego un desplegable con las opciones, union, intersecion y diferencia y un boto que muestre el resultado 



    ?>
</body>

</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
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
    $rep = '';

    if (isset($_GET['mostrar'])) {
        $tam = $_GET['tamano'];
        $rep = $_GET['rep'];
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
            De que tamaño quieres el array:<input type="number" name="numero" value="<?php isset($_GET['mostrar']) == TRUE ? $numero : "" ?>"">
            <br>
             NumRep<select name="rep" id="">
                <option value="<?php echo $rep ?>"></option>
                <?php
                for ($i = 1; $i <= 4; $i++) {

                    if ($i == $rep) {
                        echo "<option value= '$i' selected>$i</option>";
                    } else {
                        echo "<option value= '$i'>$i</option> ";
                    }
                }
                ?>
            </select>
            <input type="submit" name="mostrar" value="mostrar">
        </form>
    </fieldset>
    <?php

    if (isset($_GET['mostrar'])) {
        $lista = array();

        

        $num = $_GET['numero'];
        $tam = $_GET['tamano'];
        $rep = $_GET['rep'];

        for ($i = 0; $i < $tam; $i++) {
            $lista[$i] = rand(1, $num);
        }
        $max = $lista[0];

        echo "[ ";
        foreach ($lista as $key => $value) {
            echo "$value ";
        }
        echo " ] <br>";

        foreach ($lista as $key => $value) {
            $encontrados = array();
            $contador = 0;
            for ($i=0; $i < count($lista); $i++) { 

                if ($value == $lista[$i]) {
                    $contador++;
                }
            }

            if ($contador >= $rep && !isset($encontrados)) {
                echo "$value se repite $rep o mas veces<br>";
                $encontrados[] = $value;
            }
        }

    }


    ?>
</body>
</html>
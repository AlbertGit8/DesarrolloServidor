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

    $resultado2='';
    $n1='';
    $n2='';

    if (isset($_GET['calcular'])) {
        $n1 = $_GET['n1'];
        $n2 = $_GET['n2'];

        $signo = $_GET['operacion'];

        $resultado = $n1 . $signo . $n2;
        eval("\$resultado2=$resultado;");

     
    }
    ?>
    <fieldset>
        <legend>Calculadora</legend>
        <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input type="number" name="n1" value="<?php echo $n1 ?>">
            Operacion <select name="operacion" id="">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">x</option>
                <option value="/">÷</option>
            </select>
            <input type="number" name="n2" value="<?php echo $n2 ?>">

            Resultado <input type="text" name="resul" value="<?php echo $resultado2 ?>">

            <input type="submit" name="calcular" value="Calcular">
        </form>
    </fieldset>



</body>

</html>
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
    <title>Formulario 4</title>
</head>

<body>

    <?php
    // En este formulario, el usuario debe ingresar dos números y seleccionar una operación matemática (suma, resta, multiplicación o división). Al enviar el formulario, los datos son procesados y el resultado de la operación se muestra en pantalla.

    //Declaramos variables
    $n1 = "";
    $n2 = "";
    $resultado2 = "";

    if (isset($_GET['calcular'])) {
        $n1 = $_GET['n1'];
        $n2 = $_GET['n2'];
        $signo = $_GET['signo'];

        $resultado = $n1 . $signo . $n2;
        eval("\$resultado2=$resultado;");
    }

    ?>

    <h2>Calculadora básica</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <input type="number" name="n1" id="n1" value="<?php echo $n1 ?>">

        <select name="signo" id="signo">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>

        <input type="number" name="n2" id="n2" value="<?php echo $n2 ?>">

        = <input type="number" name="" id="" value="<?php echo $resultado2 ?>"><br>

        <input type="submit" value="calcular" name="calcular">
    </form>


</body>

</html>
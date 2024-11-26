<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
//formulario que
require "funciones.php";
$opc = "";
if (isset($_POST['opcion'])) {
    $opc = $_POST['opcion'];
}
$opc2 = "";
if (isset($_POST['opcion2'])) {
    $opc2 = $_POST['opcion'];
}
?>

<body>
    <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">


        opción:
        <?php
        $opciones = array(1 => "Mejores", 2 => "Peores");
        $opciones2 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        selectDinamico($opciones, $opc, "opcion", 1);
        selectDinamico($opciones2, $opc2, "opcion", 1);
        ?>
        <b>Con suspensos</b>
        Si <input type="radio" name="suspensos" value="1">
        No <input type="radio" name="suspensos" value="0">
        <input type="submit" name="mostrar" value="Mostrar">
    </form>

</body>

</html>
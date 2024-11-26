<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- mostrar los alumnos en una tabla segun las opciones elegidas en los select ordenanos de forma descendene -->
<?php
include_once("libreria-bd.php");

// mejores si empieza desde arriba peores si empieza desde abajo
$opc = "";
if (isset($_POST['opcion'])) {
    $opc = $_POST['opcion'];
}

//1 a 10 registros de busqueda
$numRegistros = "";
if (isset($_POST['numRegistros'])) {
    $numRegistros = $_POST['numRegistros'];
}

//1 si puede tener suspensos 0 si no puede tener suspensos
$suspensos = "";
if (isset($_POST['suspensos'])) {
    $suspensos = $_POST['suspensos'];
}

$mejorPeor = array("mejores" => "Mejores", "peores" => "Peores");
$registros = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
?>

<body>
    <fieldset>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <select name="opcion">
                <option value=""></option>

                <?php

                foreach ($mejorPeor as $clave => $item) {
                    echo "<option value='$clave' ";

                    if ($opc == $clave) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>

            <select name="numRegistros">
                <option value=""></option>

                <?php
                foreach ($registros as $clave => $item) {
                    echo "<option value='$clave' ";

                    if ($numRegistros == $clave) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>
            <b>Con suspensos</b>
            Si <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == 1) {
                                                        echo "checked";
                                                    }
                                                    ?> value="1">
            No <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == 0) {
                                                        echo "checked";
                                                    }
                                                    ?> value="0">
            <input type="submit" name="mostrar" value="Mostrar">
        </form>
    </fieldset>
    <?php
    if (isset($_POST['mostrar'])) {
        echo "$opc $numRegistros $suspensos";
    }
    ?>
</body>

</html>
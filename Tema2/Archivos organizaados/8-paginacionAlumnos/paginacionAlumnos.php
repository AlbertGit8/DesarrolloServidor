<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("08funciones.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginacion</title>
</head>

<body>
    <?php
    $alumnos = array();
    $fields = array();
    $seleccionados = array();

    $pagActual = 1; //pagina principal por defecto
    $numFilasPagina = 5; //valor de fila por pagina por defecto
    ?>

    <fieldset>
        <legend>Paginacion</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nombre'>Numero de filas por página: </label>
                <!-- al seleccionar una opcion del seleccionable se recarga la pagina -->
                <select name="numFilasPagina" onchange="form1.submit()">
                    <option value=""></option>

                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                        if ($numFilasPagina == $i) {
                            echo " selected ";
                        }
                        echo " >$i</option>";
                    }
                    ?>
            </p>
        </form>
    </fieldset>
</body>

</html>
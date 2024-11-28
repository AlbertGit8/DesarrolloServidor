<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8-Paginacion</title>
</head>

<body>
    <?php
    /**
     * Metodo que devuelve el numero total de filas o alumnos 
     * que hay en la tabla alumnos de la bdd
     */
    function obtenerTotalAlumnos()
    {
        global $db;

        $consulta = "SELECT * FROM `alumnos`";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }

        return count($alumnos);
    }

    function obtenerArrayPagActual($pagActual, $numFilasPagina)
    {
        global $db, $alumnos, $fields;

        if ($pagActual === 1) {
            $valorInicial = 0;
        } else {
            $valorInicial = ($pagActual - 1) * $numFilasPagina;
        }

        $consulta = "SELECT * FROM `alumnos` WHERE 1 LIMIT $valorInicial,$numFilasPagina";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
            // Obtener los encabezados de las columnas 
            $fields = mysqli_fetch_fields($resul);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }
    }

    function mostrarTablaBDD($arrayTabla, $fields)
    {
        global $seleccionados;

        $campoIdentificador = "NIF";

        echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'><th>Selec</th>";

        //primer foreach para mostrar los nombres de las columas de la tabla
        foreach ($fields as $nombreColumna) {
            echo "<th>$nombreColumna->name</th>";
        }

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayTabla as $nombreColumna => $fila) {
            echo "<tr>
            <td><input type='checkbox' name='seleccionados[$fila[$campoIdentificador]]' ";
            // Comprobar si el NIF del alumno está en el array $seleccionados
            if (array_key_exists($fila[$campoIdentificador], $seleccionados)) {
                echo " checked ";
            }
            echo "></td>
            ";

            foreach ($fila as $valor) {
                echo "<td> $valor </td>";
            }
            echo "</tr>";
        }

        echo "</table>
        </form></p>";
    }

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = "root"; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    $alumnos = array();
    $fields = array();
    $seleccionados = array();

    $pagActual = 1; //pagina principal por defecto
    $numFilasPagina = 5; //valor de fila por pagina por defecto

    if (isset($_POST['numFilasPagina'])) {
        $numFilasPagina = $_POST['numFilasPagina'];
    }else if (isset($_GET['numFilasPagina'])) {
        $numFilasPagina = $_GET['numFilasPagina'];
    }

    if (isset($_POST['pagActual'])) {
        $pagActual = $_POST['pagActual'];
    }else if (isset($_GET['pagActual'])) {
        $pagActual = $_GET['pagActual'];
    }

    obtenerArrayPagActual($pagActual, $numFilasPagina);

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
                        echo "<option value='$i' ";
                        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                        if ($numFilasPagina == $i) {
                            echo " selected ";
                        }
                        echo " >$i</option>";
                    }
                    ?>
                </select>
            </p>
        </form>
        <?php
        obtenerArrayPagActual($pagActual, $numFilasPagina);

        mostrarTablaBDD($alumnos, $fields);


        //calcular el numero de enlaces que apareceran con redondeo a la alta
        $numEnlaces = ceil(obtenerTotalAlumnos() / $numFilasPagina);
        echo "<p>";
        for ($i = 1; $i <= $numEnlaces; $i++) {
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?pagActual=$i&numFilasPagina=$numFilasPagina'>$i " . " " . "</a>";
        }
        echo "</p>";
        ?>
    </fieldset>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>
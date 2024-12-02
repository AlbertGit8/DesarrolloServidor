<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8-Paginacion</title>
</head>

<body>
    <?php
    include_once("libreria-bd.php");
    /**
     * Metodo que devuelve el numero total de filas o alumnos 
     * que hay en la tabla alumnos de la bdd
     */
    function obtenerTotalAlumnos()
    {
        $consulta = "SELECT * FROM `alumnos`";

        $arrayAlumnos = consultaDatos($consulta);

        return count($arrayAlumnos);
    }

    function obtenerArrayPagActual($pagActual)
    {
        global $numFilasPagina;

        if ($pagActual === 1) {
            $valorInicial = 0;
        } else {
            $valorInicial = ($pagActual - 1) * $numFilasPagina;
        }

        $consulta = "SELECT * FROM `alumnos` WHERE 1 LIMIT $valorInicial,$numFilasPagina";

        $arrayAlumnos = consultaDatos($consulta);

        return $arrayAlumnos;
    }

    function obtenerArrayModulos()
    {
        $consulta = "SELECT * FROM `modulos` WHERE 1";

        $arrayModulos = consultaDatos($consulta);

        return $arrayModulos;
    }

    function mostrarTablaAlumnos($arrayTabla)
    {
        global $alumnosSeleccionados;
        $campoIdentificador = "NIF";

        echo "<p><table border='2px'><th>Selec</th><th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Edad</th><th>Telefono</th>";

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayTabla as $fila) {

            echo "<tr>
            <td><input type='checkbox' name='alumnosSeleccionados[    [$campoIdentificador]]'></td> ";

            foreach ($fila as $valor) {
                echo "<td> $valor </td>";
            }
            echo "</tr>";
        }

        echo "</table> </p>";
    }

    function mostrarTablaModulos($arrayTabla)
    {

        global $modulosSeleccionados;
        $campoIdentificador = "ID";

        echo "<p><table border='2px'><th>Selec</th><th>ID</th><th>Nombre</th><th>Curso</th><th>Horas</th>";

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayTabla as $fila) {

            echo "<tr>
            <td><input type='checkbox' name='modulosSeleccionados[$fila[$campoIdentificador]]'></td> ";

            foreach ($fila as $valor) {
                echo "<td> $valor </td>";
            }
            echo "</tr>";
        }

        echo "</table> </p>";
    }

    function matricularSeleccionados($alumnosSeleccionados, $modulosSeleccionados, $curso)
    {
        foreach ($alumnosSeleccionados as $IdAlum => $value) {
            foreach ($modulosSeleccionados as $IdMod => $value) {
                //comprobar que el alumno no esta matriculado en ningun modulo seleccionado
                //si lo está guarda su info en Errores.txt
                if (alumnoEstaMatriculado($IdAlum, $IdMod, $curso)) {

                    $nombreFichero = "Errores.txt";
                    $saltoLinea = "\r\n";

                    $fd = fopen($nombreFichero, "a+") or die("Error al abrir el archivo");

                    $fila = "$IdAlum" . $saltoLinea;

                    fputs($fd, $fila);

                    fclose($fd);
                } else {
                    $numero = comprobarCurso($IdAlum, $IdMod);

                    $consulta = "insert into matricula(IdCurso, IdAlum, IdMod, Numero) values('$curso', '$IdAlum', '$IdMod','$numero')";

                    consultaSimple($consulta);
                }
            }
        }
    }

    function alumnoEstaMatriculado($IdAlum, $IdMod, $curso)
    {

        $consulta = "SELECT * FROM matricula WHERE IdAlum='$IdAlum' AND IdMod='$IdMod' AND IdCurso='$curso'";

        $arrayResultados = consultaDatos($consulta);

        //si no hay ningun registro NO está matriculado
        if (count($arrayResultados) === 0) {
            return false;
        } else {
            //si hay al menos un registro SI está matriculado
            return true;
        }
    }

    function comprobarCurso($IdAlum, $IdMod)
    {
        $consulta = "SELECT * FROM matricula WHERE IdAlum='$IdAlum' AND IdMod='$IdMod' ";

        $arrayResultados = consultaDatos($consulta);

        return count($arrayResultados) + 1;
    }

    $arrayAlumnos = array();
    $arrayModulos = array();
    $alumnosSeleccionados = array();
    $modulosSeleccionados = array();
    $curso = ""; //almacena el id del curso seleccionado

    $pagActual = 1; //pagina principal por defecto
    $numFilasPagina = 10; //valor de fila por pagina por defecto


    if (isset($_POST['alumnosSeleccionados'])) {
        $alumnosSeleccionados = $_POST['alumnosSeleccionados'];
    }

    if (isset($_POST['modulosSeleccionados'])) {
        $modulosSeleccionados = $_POST['modulosSeleccionados'];
    }

    if (isset($_POST['curso'])) {
        $curso = $_POST['curso'];
    }

    if (isset($_GET['pagActual'])) {
        $pagActual = $_GET['pagActual'];
    }


    ?>
    <fieldset>
        <legend>Matricular Alumnos</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <b>TABLA DE ALUMNOS </b>
            </p>
            <?php
            $arrayAlumnos = obtenerArrayPagActual($pagActual);
            mostrarTablaAlumnos($arrayAlumnos);

            //calcular el numero de enlaces que apareceran con redondeo a la alta
            $numEnlaces = ceil(obtenerTotalAlumnos() / $numFilasPagina);
            echo "<p>";
            for ($i = 1; $i <= $numEnlaces; $i++) {
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?pagActual=$i'>$i  &nbsp </a>";
            }
            echo "</p>";
            ?>

            <p>
                <b>TABLA DE MODULOS </b>
                <?php
                $arrayModulos = obtenerArrayModulos();
                mostrarTablaModulos($arrayModulos)
                ?>
            </p>

            <p>
                <label for="curso"><b>CURSO</b></label>
                <select name="curso">
                    <option value=""></option>
                    <option value="1">22-23</option>
                    <option value="2">23-24</option>
                    <option value="3">24-25</option>
                </select>
            </p>
            <input type="submit" name="matricular" value="Matricular">
        </form>
        <?php
        if (isset($_POST['matricular'])) {
            if (count($alumnosSeleccionados) !== 0 && count($modulosSeleccionados) !== 0 && $curso !== "") {
                matricularSeleccionados($alumnosSeleccionados, $modulosSeleccionados, $curso);
            } else {
                echo "<p>Debe seleccionar al menos un alumno, un modulo y un curso para continuar.</p>";
            }
        }
        ?>
    </fieldset>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- lista el nombre y apellido de los alumnos en una tabla como un enlace, al hacer click en el alumno muestra las notas de ese alumno en todos los modulos -->
    <?php

    function mostrarTablaAlumnos($arrayAlumnos)
    {
        // Extraer las columnas de Apellido1 y Apellido2 para ordenar
        $apellido1 = array_column($arrayAlumnos, 'Apellido1');
        $apellido2 = array_column($arrayAlumnos, 'Apellido2');

        // Ordenar el array por Apellido1 y luego por Apellido2
        array_multisort($apellido1, SORT_ASC, $apellido2, SORT_ASC, $arrayAlumnos);

        echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'><th>NIF</th><th>Nombre y Apellidos</th>";

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayAlumnos as $fila) {
            echo "<tr>";
            echo "<td> $fila[NIF] </td>";
            echo "<td><a href='$_SERVER[PHP_SELF]?NIFSelec=$fila[NIF]'>$fila[Apellido1] $fila[Apellido2], $fila[Nombre]</a> </td>";
            echo "</tr>";
        }

        echo "</table>
        </form></p>";
    }

    function mostrarNotasAlumno($NIF)
    {
        //obtener alumno seleccionado
        $consultaAlumnos = "SELECT * FROM alumnos WHERE NIF='$NIF' ";
        $arrayAlumnos = consultaDatos($consultaAlumnos);
        $alumno = $arrayAlumnos[0];

        tablaAlumnoSeleccionado($alumno);

        //obtener modulos
        $consultaModulos = "SELECT * FROM modulos WHERE 1 ";
        $arrayModulos = consultaDatos($consultaModulos);

        tablaModuloNota($arrayModulos, $NIF);
    }

    function tablaAlumnoSeleccionado($alumno)
    {
        echo "<p><table border='2px'><th>NIF</th><th>Nombre y Apellidos</th>";

        // Obtener y mostrar los datos de todas las filas
        echo "<tr>";
        echo "<td> $alumno[NIF] </td>";
        echo "<td>$alumno[Apellido1] $alumno[Apellido2], $alumno[Nombre] </td>";
        echo "</tr>";


        echo "</table></p>";
    }
    function tablaModuloNota($arrayModulos, $NIF)
    {
        echo "<p><table border='2px'><th>Módulo</th><th>Nota</th>";

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayModulos as $campo) {

            $consultaNotas = "SELECT * FROM notas WHERE IdAlum='$NIF' AND IdMod='$campo[ID]'";
            $filaNota = consultaUnaFila($consultaNotas);

            echo "<tr>";
            echo "<td>$campo[Nombre] </td>";
            echo "<td>$filaNota[Nota]</td>";
            echo "</tr>";
        }

        echo "</table></p>";
    }

    require_once("libreria-bd.php");

    $consulta = "SELECT * FROM alumnos WHERE 1 ";

    $arrayAlumnos = consultaDatos($consulta);

    if (isset($_GET['NIFSelec'])) {
        $NIF = $_GET['NIFSelec'];
        mostrarNotasAlumno($NIF);
    } else {
        mostrarTablaAlumnos($arrayAlumnos);
    }

    ?>

</body>

</html>
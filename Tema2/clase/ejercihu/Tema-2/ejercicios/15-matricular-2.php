<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8-Paginacion</title>
</head>

<body>
    <?php
    // Incluimos el archivo de librería con las funciones de conexión a la base de datos.
    include_once("libreria-bd.php");

    /**
     * Obtiene todos los módulos disponibles desde la base de datos.
     * 
     * @return array Devuelve un array con los módulos obtenidos desde la base de datos.
     */
    function obtenerArrayModulos()
    {
        $consulta = "SELECT * FROM modulos WHERE 1"; // Consulta SQL para obtener todos los módulos
        $arrayModulos = consultaDatos($consulta); // Ejecuta la consulta y almacena los resultados en un array
        return $arrayModulos; // Devuelve el array con los módulos
    }

    /**
     * Obtiene todos los alumnos disponibles desde la base de datos.
     * 
     * @return array Devuelve un array con los alumnos obtenidos desde la base de datos.
     */
    function obtenerArrayAlumnos()
    {
        $consulta = "SELECT * FROM alumnos WHERE 1"; // Consulta SQL para obtener todos los alumnos
        $arrayAlumnos = consultaDatos($consulta); // Ejecuta la consulta y almacena los resultados en un array
        return $arrayAlumnos; // Devuelve el array con los alumnos
    }

    /**
     * Muestra la tabla de módulos en el formulario.
     * 
     * @param array $arrayTabla array con los datos de los módulos a mostrar.
     */
    function mostrarTablaModulos($arrayTabla)
    {
        $campoIdentificador = "ID"; // Especificamos que el campo 'ID' es el identificador del módulo

        echo "<p><table border='2px'><th>Selec</th><th>ID</th><th>Nombre</th><th>Curso</th><th>Horas</th>"; // Cabecera de la tabla

        // Recorremos cada fila del array y mostramos los datos en una tabla HTML
        foreach ($arrayTabla as $fila) {
            echo "<tr>
            <td><input type='checkbox' name='modulosSeleccionados[$fila[$campoIdentificador]]'></td>"; // Checkbox para seleccionar el módulo

            foreach ($fila as $valor) {
                echo "<td> $valor </td>"; // Mostramos los valores de la fila en cada celda de la tabla
            }
            echo "</tr>";
        }

        echo "</table> </p>"; // Cerramos la tabla
    }

    /**
     * Obtiene los alumnos matriculados en un módulo y curso específicos.
     * 
     * @param int $IdMod ID del módulo seleccionado.
     * @param int $curso ID del curso seleccionado.
     * 
     * @return array array con los alumnos matriculados en el módulo y curso dados.
     */
    function obtenerArrayMatriculados($IdMod, $curso)
    {
        $consulta = "SELECT alumnos.* 
                     FROM alumnos 
                     INNER JOIN matricula ON alumnos.NIF = matricula.IdAlum
                     WHERE matricula.IdMod = '$IdMod' AND matricula.IdCurso = '$curso'"; // Consulta SQL para obtener los alumnos matriculados en un módulo y curso específicos

        return consultaDatos($consulta); // Ejecuta la consulta y devuelve los resultados
    }

    /**
     * Muestra las tablas de alumnos matriculados en los módulos seleccionados para un curso dado.
     * 
     * @param array $arrayModulos array con los módulos disponibles.
     * @param array $modulosSeleccionados array con los módulos seleccionados.
     * @param int $curso ID del curso seleccionado.
     */
    function mostrarTablasMatriculados($arrayModulos, $modulosSeleccionados, $curso)
    {
        foreach ($modulosSeleccionados as $IdMod => $value) {

            // Buscar la fila del módulo correspondiente por su ID
            $filaModulo = ""; // Reinicia la variable para cada módulo seleccionado
            foreach ($arrayModulos as $modulo) {
                if ($modulo['ID'] == $IdMod) {
                    $filaModulo = $modulo;
                }
            }

            // Mostrar nombre del módulo
            echo "<p><b>TABLA DE ALUMNOS MATRICULADOS EN: $filaModulo[Nombre]</b></p>";

            // Obtener los alumnos matriculados
            $arrayFilasAlumnos = obtenerArrayMatriculados($IdMod, $curso);

            // Mostrar tabla de alumnos
            echo "<p><table border='2px'>
            <th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th>
            <th>Edad</th><th>Telefono</th><th>Desmatricular</th>";

            foreach ($arrayFilasAlumnos as $alumno) {
                echo "<tr>
                <td>$alumno[NIF]</td>
                <td>$alumno[Nombre]</td>
                <td>$alumno[Apellido1]</td>
                <td>$alumno[Apellido2]</td>
                <td>$alumno[Edad]</td>
                <td>$alumno[Telefono]</td>
                <td><input type='checkbox' name='alumnosDesmatricular[$alumno[NIF]]'></td>
              </tr>";
            }

            echo "</table></p>
            <p><input type='submit' name='desmatricular' value='Desmatricular alumnos'></p>
            ";
            
        }
    }

    function desmatricularAlumnos($alumnosDesmatricular) {
        foreach ($alumnosDesmatricular as $NIF => $value) {
            $consulta = "DELETE FROM matricula WHERE IdAlum = '$NIF'";
            consultaSimple($consulta);
        }
    }

    // selección de módulos y curso
    $arrayAlumnos = obtenerArrayAlumnos(); // Obtenemos todos los alumnos
    $arrayModulos = array(); // Inicializamos el array de módulos
    $modulosSeleccionados = array(); // Inicializamos el array de módulos seleccionados
    $curso = ""; // Inicializamos la variable que almacenará el ID del curso seleccionado

    if (isset($_POST['modulosSeleccionados'])) {
        $modulosSeleccionados = $_POST['modulosSeleccionados'];
    }

    if (isset($_POST['curso'])) {
        $curso = $_POST['curso'];
    }

    if (isset($_GET['pagActual'])) {
        $pagActual = $_GET['pagActual'];
    }

    // desmatricular alumnos seleccionados
    $alumnosDesmatricular = array(); // Inicializamos el array para los alumnos a desmatricular
    if (isset($_POST['alumnosDesmatricular'])) {
        $alumnosDesmatricular = $_POST['alumnosDesmatricular'];
    }

    ?>

    <fieldset>
        <legend>Mostrar Alumnos Matriculados</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>

            <p>
                <label for="curso"><b>CURSO</b></label>
                <select name="curso">
                    <option value=""></option>
                    <option value="1" <?php if ($curso == 1) {
                                            echo " selected ";
                                        } ?>>22-23</option>
                    <option value="2" <?php if ($curso == 2) {
                                            echo " selected ";
                                        } ?>>23-24</option>
                    <option value="3" <?php if ($curso == 3) {
                                            echo " selected ";
                                        } ?>>24-25</option>
                </select>
            </p>

            <p>
                <b>TABLA DE MODULOS </b>
                <?php
                // Obtenemos todos los módulos y mostramos la tabla
                $arrayModulos = obtenerArrayModulos();
                mostrarTablaModulos($arrayModulos)
                ?>
            </p>

            <input type="submit" name="mostrar" value="Mostrar resultados">

            <?php
            // Si se ha presionado el botón de mostrar
            if (isset($_POST['mostrar'])) {
                // Verificamos que se hayan seleccionado módulos y un curso
                if (count($modulosSeleccionados) !== 0 && $curso !== "") {
                    // Si todo es correcto, mostramos las tablas de alumnos matriculados
                    mostrarTablasMatriculados($arrayModulos, $modulosSeleccionados, $curso);
                } else {
                    // Si falta algún dato, mostramos un mensaje de error
                    echo "<p>Debe seleccionar al menos un curso y un módulo para continuar.</p>";
                }
            }
            ?>
            
            <?php
            if (isset($_POST['desmatricular'])) {
                if (count($alumnosDesmatricular) !== 0) {
                    desmatricularAlumnos($alumnosDesmatricular);
                } else {
                    echo "<p>Debe seleccionar al menos un alumno para desmatricularlo.</p>";
                }
                
            }
            ?>
        </form>


    </fieldset>
</body>

</html>
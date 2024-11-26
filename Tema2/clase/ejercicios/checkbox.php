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
    <title>Checkbox</title>
</head>

<body>
    <?php
    //igual que el anterior pero en vez de  desplegable una tabla con checkbox y en funcion de los que se seleccionen mostrar formularios para cada alumno

    // Declaramos los arrays para almacenar los alumnos y los alumnos seleccionados
    $alumnos = array();
    $seleccionados = array();

    // Datos conexión base de datos
    $host = "localhost";
    $user = "root";
    $password = "root";
    $database = "tema2";

    // Conexión base de datos
    $db = mysqli_connect($host, $user, $password, $database);

    // Gurdamos los nifs de los alumnos seleccionados en el array $seleccionados como claves
    if (isset($_POST['seleccionados'])) {
        # code...
    }

    // Comprobamos si hemos actualizado
    if (isset($_POST['actualizar'])) {
        # code...
    }

    // Realizamos la consulta a la base de datos
    $consulta = "SELECT * FROM `alumnos`";
    $resul = mysqli_query($db, $consulta);

    // Comprobamos si la consulta fue exitosa y almacenar los datos
    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }

    /**
     * Función para mostrar la tabla de alumnos con checkboxes para seleccionar
     *
     * @return void
     */
    function mostrarTablaAlumnos() {
        
    }

    /**
     * Función para mostrar el formulario de edición de un alumno específico
     *
     * @param [type] $nifAlumno
     * @return void
     */
    function mostrarAlumno($nifAlumno) {
        
    }

    /**
     * Función para actualizar los datos de un alumno en la base de datos
     *
     * @param [type] $nifAlumno
     * @param [type] $nombreAct
     * @param [type] $apellido1Act
     * @param [type] $apellido2Act
     * @param [type] $telefonoAct
     * @return void
     */
    function actualizarAlumnos($nifAlumno, $nombreAct, $apellido1Act, $apellido2Act, $telefonoAct) {
        
    }

    ?>
    <fieldset>
        <legend>Tabla de alumnos</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <table border="2px">
                <tr>
                    <th>Selec</th>
                    <th>Alumno</th>
                </tr>
                <?php
                // Llamamos a la funcion para mostrar a los alumnos
                mostrarTablaAlumnos();
                ?>
            </table>
        </form>
    </fieldset>
</body>

</html>
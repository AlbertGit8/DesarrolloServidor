<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- cargar los alumnos del fichero alumnos.txt e inserte los datos en la bdd -->
    <?php
    function convFichArray($nombreFichero)
    {
        $arrayFichero = array();
        $fd = fopen($nombreFichero, "r") or die("Error al abrir el archivo");

        while (!feof($fd)) {
            $fila = fgets($fd);
            if ($fila) { // Verificamos que la línea no esté vacía
                $linea = explode(":", trim($fila));
                if (count($linea) >= 4) { // Aseguramos que tenga al menos 2 campos
                    $arrayFichero[$linea[0]] = $linea;
                }
            }
        }
        fclose($fd);
        return $arrayFichero;
    }

    $ficheroAlumnos = "../databases/alumnos.txt";
    $ficheroModulos = "../databases/modulos.txt";

    $arrayAlumnos = array();
    $arrayModulos = array();

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    $arrayAlumnos = convFichArray($ficheroAlumnos);
    $arrayModulos = convFichArray($ficheroModulos);

    $cont = 0;
    echo "<p>";
    foreach ($arrayAlumnos as $alumno) {
        $consulta = "SELECT count(*) as cuenta FROM `alumnos` WHERE NIF='$alumno[0]'";
        $resul = mysqli_query($db, $consulta);
        $row = mysqli_fetch_assoc($resul);

        if ($row['cuenta'] == 0) { // Verificar si cuenta es igual a 0
            $consulta = "insert into alumnos values('$alumno[0]','$alumno[1]','$alumno[2]','$alumno[3]','$alumno[4]','$alumno[5]')";
            $resul = mysqli_query($db, $consulta);
            if ($resul) {
                $cont++;
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        } else {
            echo "El alumno ya existe <br>";
        }
    }
    echo "<p>Se han insertado $cont registros.</p>";

    $cont = 0; // Reiniciar contador

    echo "<p>";
    foreach ($arrayModulos as $modulo) {
        $consulta = "SELECT count(*) AS cuenta FROM `modulos` WHERE ID='$modulo[0]'";
        $resul = mysqli_query($db, $consulta);
        $row = mysqli_fetch_assoc($resul);

        if ($row['cuenta'] == 0) { // Verificar si cuenta es igual a 0
            $consulta = "insert into modulos values(null,'$modulo[1]')";
            $resul = mysqli_query($db, $consulta);
            if ($resul) {
                $cont++;
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        } else {
            echo "El modulo ya existe <br>";
        }
    }
    echo "<p>Se han insertado $cont registros.</p>";

    // Cerrar la conexión a la base de datos
    mysqli_close($db);
    ?>
</body>
</html>

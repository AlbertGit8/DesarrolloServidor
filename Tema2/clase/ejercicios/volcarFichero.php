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

    function existeNIf($nif)  {

        global $db;

        $consulta = "SELECT count(*) as cuenta
        FROM Alumnos
        WHERE NIF='$nif'";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $fila = mysqli_fetch_assoc($resul); //Extraemos una fila (la unica posible) del resultado
        } else {
            echo mysqli_error($db);
        }
    }

    $ficheroAlumnos = "/ficheros/alumnos.txt";
    $ficheroModulos = "/ficheros/modulos.txt";

    $arrayAlumnos = array();
    $arrayModulos = array();

    $host = "localhost";

    $user = "root";

    $password = "root";

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    $arrayAlumnos = convFichArray($ficheroAlumnos);
    $arrayModulos = convFichArray($ficheroModulos);

    // foreach ($arrayAlumnos as $alumno) {
    //     $consulta = "insert into alumnos values('$alumno[0]','$alumno[1]','$alumno[2]','$alumno[3]','$alumno[4]','$alumno[5]')";

    //     $resul = mysqli_query($db, $consulta);

    //     if (!$resul) {
    //         echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
    //     }
    // }

    foreach ($arrayModulos as $modulo) {

        $consulta = "SELECT ID FROM `modulos` WHERE ID='$modulo[0]'";

        $resul = mysqli_query($db, $consulta);

        if (!$resul) {
            $consulta = "insert into modulos values(null,'$modulo[1]')";

            $resul = mysqli_query($db, $consulta);

            if (!$resul) {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        }else {
            echo "El modulo ya existe <br>";
        }
    }


    ?>
</body>

</html>
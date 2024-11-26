<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("04funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volcar Ficheros</title>
</head>

<body>
    <!-- cargar los alumnos del fichero alumnos.txt e inserte los datos en la bdd -->
    <?php
    $ficheroAlumno = "alumnos.txt";
    $ficheroModulo = "modulos.txt";

    $arrayAlumnos = array();
    $arrayModulos = array();

    $arrayAlumnos = convertirFicheroArray($ficheroAlumno);
    $arrayModulos = convertirFicheroArray($ficheroModulo);

    $cont = 0;
    echo "<p>";
    foreach ($arrayAlumnos as $alumno) {
        $consulta = "SELECT count(*) as cuenta FROM `alumnos` WHERE NIF='$alumno[0]'";
        $resul = consultaDatos($consulta);
        $row = mysqli_fetch_assoc($resul);

        if ($row['cuenta'] == 0) { // Verificar si cuenta es igual a 0
            $consulta = "insert into alumnos values('$alumno[0]','$alumno[1]','$alumno[2]','$alumno[3]','$alumno[4]','$alumno[5]')";
            $resul = consultaDatos($consulta);
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
    
    ?>
</body>

</html>
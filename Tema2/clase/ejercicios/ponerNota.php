<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Un desplegable para cargar los alumnos, desplegable para modulos y un input para las notas

$host = "localhost";

$user = "root";

$password = "root";

$database = "tema2";

//se conecta al servidor de bbdd y devuelve un descriptor database
$db = mysqli_connect($host, $user, $password, $database);

if (isset($_POST['ponerNota'])) {
    $idAlum = $_POST['alumno'];
    $idMod = $_POST['modulo'];
    $nota = $_POST['nota'];

    $consulta = "INSERT INTO notas(idAlum, idMod, Nota) VALUES ('$idAlum', $idMod, $nota);";

    $resul = mysqli_query($db, $consulta);
    if ($resul) {
        echo "Registro actualizado correctamente";
    } else {
        echo mysqli_error($db);
    }
}

//declaramos arrays para gurdar tanto alumnos como modulos
$alumnos = array();
$modulos = array();

$consulta = "SELECT * FROM alumnos;";

$resul = mysqli_query($db, $consulta);

if ($resul) {
    while ($alumno = mysqli_fetch_assoc($resul)) {

        $alumnos[$alumno['NIF']] = $alumno;
    }
} else {

    echo "Error:" . mysqli_error($db);
}

$consulta = "SELECT * FROM modulos;";

$resul = mysqli_query($db, $consulta);

if ($resul) {
    while ($modulo = mysqli_fetch_assoc($resul)) {
        $modulos[$modulo['ID']] = $modulo;
    }
} else {
    echo "Error: " . mysqli_error($db);
}


$alu = "";

if (isset($_POST['alumno'])) {
    $alu = $_POST['alumno'];
}

$modul = "";
if (isset($_POST['modulo'])) {
    $modul = $_POST['modulo'];
}

mysqli_close($db);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poner notas</title>
</head>

<body>
    <fieldset>
        <legend>Poner notas</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="alumno">Alumno: </label>
            <select name="alumno" id="alumno">
                <?php

                foreach ($alumnos as $alumno) {
                    echo "<option value='$alumno[NIF]' ";

                    if ($alu == $alumno['NIF']) {
                        echo " selected ";
                    }
                    echo "> $alumno[Apellido1] $alumno[Apellido2], $alumno[Nombre]</option>";
                }

                ?>
            </select>

            <label for="modulo">Modulo: </label>
            <select name="modulo" id="modulo">
                <?php

                foreach ($modulos as $modulo) {
                    echo "<option value='$modulo[ID]' ";

                    if ($modul == $modulo['ID']) {
                        echo ' selected ';
                    }

                    echo "> $modulo[Nombre]</option>";
                }
                ?>
            </select>

            <label for="nota">Nota: </label>
            <input type="number" id="nota" name="nota">
            <br><br>

            <input type="submit" value="Actualizar nota" name="ponerNota">
        </form>
    </fieldset>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Básico</title>
</head>

<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //require_once('libreria.php');  
          

    function obtenerLocalidades($pais, $prov)
    {
        global $db;

        $consulta = "SELECT * FROM localidades WHERE IdPais=$pais AND IdProvincia=$prov;";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        } else {

            echo "Error:" . mysqli_error($db);
        }

        return $filas;
    }

    function obtenerProvincias($pais)
    {
        global $db;

        $consulta = "SELECT * FROM provincias WHERE IdPais='$pais';";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        } else {

            echo "Error:" . mysqli_error($db);
        }

        return $filas;
    }

    function obtenerPaises()
    {
        global $db;

        $consulta = "SELECT * FROM paises;";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        } else {

            echo "Error:" . mysqli_error($db);
        }

        return $filas;
    }

    $host = "localhost";

    $user = "root";

    $password = "root";

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    $pais = "";
    if (isset($_POST['Pais'])) {
        $pais = $_POST['Pais'];
    }
    $prov = "";
    if (isset($_POST['Provincia'])) {
        $prov = $_POST['Provincia'];
    }
    $localidad = "";
    if (isset($_POST['Localidad'])) {
        $localidad = $_POST['Localidad'];
    }

    ?>


    <h2>Paises</h2>
    <fieldset>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">


            <label for="Pais">Pais: </label>
            <select name="Pais" id="Pais" onchange="f1.submit()">
                <?php
                $filas = obtenerPaises();
                foreach ($filas as $fila) {
                    echo "<option value='$fila[Id]' ";

                    if ($pais == $fila['Id']) {
                        echo " selected ";
                    }
                    echo "> $fila[Nombre]";
                }


                ?>
            </select>

            <?php

            if ($pais != "") {
                echo "<label for='Provincia'>Provincia: </label>";
                echo "<select name='Provincia' id='Provincia' onchange='f1.submit()''>";

                $filas = obtenerProvincias($pais);
                foreach ($filas as $fila) {
                    echo "<option value='$fila[IdPro]' ";

                    if ($prov == $fila['IdPro']) {
                        echo " selected ";
                    }
                    echo "> $fila[Nombre]";
                }
                echo "</select>";
            }



            if ($prov != "" && $pais != "") {
                echo "<label for='Localidad'>Localidad: </label>";
                echo "<select name='Localidad' id='Localidad' >";

                $filas = obtenerLocalidades($pais, $prov);

                foreach ($filas as $fila) {
                    echo "<option value='$fila[IdLoc]' ";

                    if ($localidad == $fila['IdLoc']) {
                        echo " selected ";
                    }
                    echo "> $fila[Nombre]";
                }
                echo "</select>";
            }

            ?>

        </form>
    </fieldset>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>
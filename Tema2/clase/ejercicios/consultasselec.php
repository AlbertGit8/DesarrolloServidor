<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas Selec</title>
</head>

<body>
    <?php
    function mostrarCampos($fila)
    {
        foreach ($fila as $clave => $campo) {
            echo "Campo: $clave es $campo<br>";
        }

        echo "<br><br><br>";
    }

    function mostrarTabla($filas)
    {
        echo "<table border='2'>";
        echo "<th>NIF</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Telefono</th>";
        foreach ($filas as $fila) {
            echo "<tr>";

            foreach ($fila as $campo) {
                echo "<td>$campo</td>";
            }

            echo "</tr>";
        }
    }

    $host = "localhost";

    $user = "root";

    $password = "root";

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    $consulta = "SELECT * FROM alumnos;";

    $resul = mysqli_query($db, $consulta);

    if ($resul == FALSE) {
        echo "Error en la consulta:" . mysqli_error($db);
    } else {
        $filas = array();

        //$filas=mysqli_fetch_all($resul);

        $fila = mysqli_fetch_assoc($resul);
        echo "Extraccion con array asociativo:<br>";
        mostrarCampos($fila);

        $fila = mysqli_fetch_array($resul);
        echo "Extraccion con ambos indices:<br>";
        mostrarCampos($fila);

        $fila = mysqli_fetch_row($resul);
        echo "Extraccion con array numérico:<br>";
        mostrarCampos($fila);

        //mostrarTabla($filas);
    }
    ?>
</body>

</html>
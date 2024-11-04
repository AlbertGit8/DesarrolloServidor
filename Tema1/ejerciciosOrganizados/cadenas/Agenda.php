<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>

<body>
    <?php
    // Gestiona un conjunto de entradas en una agenda, permitiendo almacenar, comparar y mostrar los datos de forma organizada.

    $agenda = "";

    if (isset($_GET['agenda'])) {

        $agenda = $_GET['agenda'];
    }

    if (isset($_GET['Guardar'])) {
        $nombre = $_GET['nombre'];
        $ape1 = $_GET['apellido1'];
        $ape2 = $_GET['apellido2'];
        $tel = $_GET['telefono'];

        if ($agenda == "") {
            $agenda = $agenda . $nombre . "," . $ape1 . "," . $ape2 . "," . $tel;
        } else {
            $agenda = $agenda . "|" . $nombre . "," . $ape1 . "," . $ape2 . "," . $tel;
        }
    }

    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <legend>Agenda</legend>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" ><br><br>

            <label for="apellido1">Primer Apellido:</label><br>
            <input type="text" id="apellido1" name="apellido1" ><br><br>

            <label for="apellido2">Segundo Apellido:</label><br>
            <input type="text" id="apellido2" name="apellido2"><br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" ><br><br>

            <input type="hidden" name="agenda" value="<?php echo $agenda ?>">

            <input type="submit" value="Guardar" name="Guardar">
            <input type="submit" value="Mostrar" name="Mostrar">
        </form>
    </fieldset>

    <?php

    if (isset($_GET['Mostrar'])) {
        $lineas = explode("|", $agenda);

        $agendaSeparada = array();

        foreach ($lineas as $cadena) {
            $agendaSeparada[] = explode(",", $cadena);
        }

        echo "<table border='2'>
              <tr>
              <td>Nombre</td><td>Apellido1</td><td>Apellido2</td><td>Teléfono</td>
              <tr>  ";
        foreach ($agendaSeparada as $clave => $linea) {
            echo "<tr>";

            foreach ($linea as $clave => $cadena) {
                echo "<td>$cadena</td>";
            }
            echo "<tr>";
        }
        echo "</table>";
    }

    ?>
</body>

</html>
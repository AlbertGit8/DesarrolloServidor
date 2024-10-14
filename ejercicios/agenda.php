<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda con control de DNI</title>
</head>

<body>

    <?php
    // Inicializamos la variable agenda que almacenará todos los registros
    $agenda = "";

    // Si la agenda ya fue enviada previamente (por el formulario), la recuperamos
    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda']; // Recuperamos la cadena de la agenda
    }

    // Si se presiona el botón "Guardar"
    if (isset($_GET['Guardar'])) {
        $dni = $_GET['DNI']; // Obtenemos el DNI ingresado
        $nombre = $_GET['Nombre']; // Obtenemos el nombre ingresado
        $apellido1 = $_GET['Apellido1']; // Obtenemos el primer apellido
        $apellido2 = $_GET['Apellido2']; // Obtenemos el segundo apellido

        // Comprobamos si el DNI ya existe en la agenda
        $dni_repetido = false;
        $registros = explode("|", $agenda); // Convertimos la cadena en un array usando el delimitador '|'

        foreach ($registros as $registro) {
            list($registro_dni) = explode(",", $registro); // Obtenemos solo el DNI del registro
            if ($registro_dni == $dni) {
                $dni_repetido = true;
                break;
            }
        }

        if ($dni_repetido) {
            // Si el DNI ya existe, mostramos un mensaje de error
            echo "<p style='color: red;'>Error: El DNI ya está registrado.</p>";
        } else {
            // Si el DNI no está repetido, lo guardamos en la agenda
            if ($agenda == "") {
                // Si la agenda está vacía, solo agregamos el registro
                $agenda .= "$dni,$nombre,$apellido1,$apellido2";
            } else {
                // Si ya hay registros, agregamos un nuevo registro separado por '|'
                $agenda .= "|$dni,$nombre,$apellido1,$apellido2";
            }
        }
    }

    // Si se presiona el botón "Mostrar"
    if (isset($_GET['Mostrar'])) {
        // Mostramos los datos en una tabla
        echo "<table border='2'>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                </tr>";

        $registros = explode("|", $agenda); // Convertimos la cadena en un array

        foreach ($registros as $registro) {
            if (!empty($registro)) {
                list($dni, $nombre, $apellido1, $apellido2) = explode(",", $registro); // Extraemos los campos
                echo "<tr>";
                echo "<td>$dni</td>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1</td>";
                echo "<td>$apellido2</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    }
    ?>

    <!-- Formulario para introducir los datos de la persona -->
    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

            DNI: <input type="text" name="DNI" required><br><br>
            Nombre: <input type="text" name="Nombre" required><br><br>
            Primer Apellido: <input type="text" name="Apellido1" required><br><br>
            Segundo Apellido: <input type="text" name="Apellido2" required><br><br>

            <?php
            // Campo oculto para almacenar los datos de la agenda en una cadena
            echo "<input type='hidden' name='Agenda' value='$agenda'>";
            ?>

            <!-- Botón para guardar los datos -->
            <input type="submit" value="Guardar" name="Guardar">

            <!-- Botón para mostrar los datos en la tabla -->
            <input type="submit" value="Mostrar" name="Mostrar">
        </form>
    </fieldset>

</body>

</html>

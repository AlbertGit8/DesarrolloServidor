<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda con control de DNI</title>
</head>

<body>

    <?php
    //En la cabecera, del titulo de la tabla, añadir un enlace a los litulos para que cuando pulses solo salga el campo seleccionado, tambien añadir un checkbox al lado de cada registro para que al seleccionar, borrar dicho registro.
    // Inicializamos la variable agenda que almacenará todos los registros
    $agenda = "";

    // Si la agenda ya fue enviada previamente (por el formulario), la recuperamos
    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['Agenda']; // Recuperamos la cadena de la agenda
    }

    if (isset($_GET['Campo'])) {// Si me ha llegado un campo de ordenación
        //Ordenamos la agenda por ese campo

        $campo  = $_GET['Campo']; //Recuperamos el campo de ordenación

        $campoOrd=array("Dni","Nombre","Apellido1","Apellido2");

        $pos=array_search($campo, $campoOrd);// Buscamos la posición de ese campo

        $filas=explode("|",$agenda);// Convertimos el string en un array de filas

        $filasOrd=array();//Array donde van a guradarse las filas ordenadas por ese campo

        foreach ($filas as $clave => $fila) {
            $campos=explode(",",$fila);

            $filasOrd[$campos[$pos]]=$fila; 
        }

        ksort($filasOrd);
        $agenda=implode("|");
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
                    <th>Select</th>
                    <th><a href='$_SERVER[PHP_SELF]?Campo=dni&Agenda=$agenda'>DNI</a></th>
                    <th><a href='$_SERVER[PHP_SELF]?Campo=nombre&Agenda=$agenda'>Nombre</a></th>
                    <th><a href='$_SERVER[PHP_SELF]?Campo=apellido1&Agenda=$agenda'>Primer Apellido</a></th>
                    <th><a href='$_SERVER[PHP_SELF]?Campo=apellido2&Agenda=$agenda'>Segundo Apellido</a></th>
                </tr>";

        $registros = explode("|", $agenda); // Convertimos la cadena en un array

        foreach ($registros as $registro) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='' id=''></td>";
            if (!empty($registro)) {
                list($dni, $nombre, $apellido1, $apellido2) = explode(",", $registro); // Extraemos los campos
                
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

            DNI: <input type="text" name="DNI" ><br><br>
            Nombre: <input type="text" name="Nombre" ><br><br>
            Primer Apellido: <input type="text" name="Apellido1" ><br><br>
            Segundo Apellido: <input type="text" name="Apellido2" ><br><br>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BorraMulti</title>
</head>

<body>
    <!-- Permite eliminar múltiples registros (líneas) de un archivo de texto
('Alumnos.txt'). El usuario selecciona los registros a borrar, y el script copia todas las líneas,
excepto las seleccionadas, en un archivo temporal, que luego reemplaza al archivo original. -->

    <?php
    function obtenerAlumno()
    {

        //Creamos un array que tendrá las lineas del archivo Alumnos.txt
        $alumnos = array();

        //Abrimos el archivo el archivo en modo lectura
        $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

        //Recorremos el archivo línea por línea con fgets() y divide los datos en un array $campos usando explode(":").
        //Es decir, recorremos el array para separar los campos y crear una matriz de alumnos con cada lina y sus respectivos campos separados

        while (!feof($fd)) { //Mientras no lleguemos al final del archivo

            //Extramos una linea del archivo
            $linea = fgets($fd);

            //Dividimos la linea en un array de campos
            $campos = explode(":", $linea);

            // Verificamos si la línea contiene exactamente 6 campos (nombre, apellido1, apellido2, DNI, teléfono, edad).
            if (count($campos) == 6) {

                // Usamos el primer campo (NIF o identificador único) como clave en el array de alumnos y guardamos la línea completa como su valor.
                $alumnos[$campos[0]] = $linea;
            }
        }

        //Cerrramos el archivo despues de leerlo completamente
        fclose($fd);

        // Devolvemos el array de alumnos con cada línea completa como valor y el NIF como clave.
        return  $alumnos;
    }

    function pasaFiltro($campos, $filtro)
    {
        //Inicializamos la variable $pasa como TRUE; indicará si el registro cumple todos los criterios de filtro.
        $pasa = TRUE;

        // Recorremos los índices del filtro (del 1 al 5), correspondientes a los campos de la información del alumno (nombre, apellido1, apellido2, edad, y teléfono)
        for ($i = 1; $i <= 5; $i++) {

            // Comprobamos si el campo de filtro está vacío o si coincide con el valor de $campos en la misma posición
            // Si el filtro está vacío, no se aplica ningún filtro en este campo.
            // Si hay un valor en el filtro, lo comparamos con el valor correspondiente en $campos.
            // trim() elimina los espacios al inicio y al final para evitar errores de comparación.
            $pasa = $pasa && (($filtro[$i] == "") || (trim($filtro[$i]) == trim($campos[$i])));

            // $pasa será TRUE solo si todos los campos en el filtro coinciden con los campos del registro actual.
            // Si algún campo no cumple, $pasa se convierte en FALSE, y la función devolverá FALSE.
        }

        // Retornamos el valor de $pasa, indicando si el registro cumple todos los criterios del filtro o no.
        return $pasa;
    }

    function borrar($selec, $alumnos)
    {

        //recorremos el dni de los seleccionados
        foreach ($selec as $clave => $valor) {
            unset($alumnos[$clave]); //lo eliminamos del array 
        }

        $fd = fopen("Alumnos.txt", "w") or die("Error al abrir el archivo alumnos");

        foreach ($alumnos as $clave => $linea) {
            fputs($fd, $linea);
        }

        fclose($fd);
    }

    $alumnos = obtenerAlumno();   //Recogemos los alumnos del archivo en un array

    if ((isset($_GET['Borrar']))  &&  (isset($_GET['Selec'])))   //Si hemos marcado borrar y seleccionado algun check
    {
        $selec = $_GET['Selec'];  //Recogemos el array de filas seleccionadas

        borrar($selec, $alumnos);  //Eliminamos los alumnos seleccionados del array alumnos

    }
    ?>



    <fieldset>
        <legend>Busqueda y borrado de alumnos</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br><br>

            <label for="apellido1">Primer Apellido:</label><br>
            <input type="text" id="apellido1" name="apellido1"><br><br>

            <label for="apellido2">Segundo Apellido:</label><br>
            <input type="text" id="apellido2" name="apellido2"><br><br>

            <label for="edad">Edad:</label><br>
            <input type="text" id="edad" name="edad"><br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono"><br><br>

            <input type="submit" value="Buscar" name="Buscar">

            <?php

            if (isset($_GET['Buscar'])) {

                //Declaramos variables
                $nombre = $_GET['nombre'];
                $ape1 = $_GET['apellido1'];
                $ape2 = $_GET['apellido2'];
                $edad = $_GET['edad'];
                $tel = $_GET['telefono'];

                //Creamos un array donde almacenaremos los campos a filtrar
                $filtro = array();

                $filtro[1] = $nombre;
                $filtro[2] = $ape1;
                $filtro[3] = $ape2;
                $filtro[4] = $edad;
                $filtro[5] = $tel;

                //Recogemos los alumnos del fichero en un array
                $alumnos = obtenerAlumno();

                //Creamos la tabla para mostrar los alumnos buscados
                echo "<table border='2'>
                        <tr>
                            <th>Selec</th><th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Edad</th><th>Telefono</th>
                        </tr>
                ";

                foreach ($alumnos as $clave => $linea) {
                    $campos = explode(":", $linea);

                    // Verifica si la fila pasa el filtro de búsqueda usando la función PasaFiltro
                    if (pasaFiltro($campos, $filtro)) {

                        echo "<tr>";

                        //Creamos una celda con checkbox
                        //El name='Selec[$campos[0]]' permite seleccionar cada alumno por su NIF, almacenándolo en el array 'Selec' si es marcado.
                        echo "<td><input type='checkbox' name='Selec[$campos[0]]'></td>";

                        //Itera sobre cada campo de la línea actual del alumno, representando las celdas de sus datos
                        foreach ($campos as $clave => $campo) {
                            echo "<td>$campo</td>";
                        }

                        echo "</tr>";
                    }
                }

                echo "</table>";

                echo "<input type='submit' name='Borrar' value='Borrar'>";
            }


            ?>
        </form>
    </fieldset>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricular</title>
</head>

<body>
    <?php

    function PasaFiltro($campos, $filtro)
    {
        $pasa = TRUE;

        for ($i = 1; $i <= 5; $i++) {
            $pasa = $pasa && (($filtro[$i] == "") || (trim($filtro[$i]) == trim($campos[$i])));
        }

        return $pasa;
    }

    function ObtenerAlumnos()
    {
        $alumnos = array(); //Array con las lineas del archivo

        $fd = fopen("Alumnos.txt", "r") or die("Error al abrir el archivo");

        //Mostramos el contenido del archivo

        while (!feof($fd)) //Mientras No llegado al fin del archivo
        {
            $linea = fgets($fd); //Extraemos una linea de ese archivo

            $campos = explode(":", $linea); //Separamos la linea en campos

            if (count($campos) == 6) //Solo queremos la linenas con los 6 campos del alumno
            {
                $alumnos[$campos[0]] = $linea; //Guardamos ese linea en el array de alumnos
            }
        }

        fclose($fd);

        return $alumnos;
    }



    $alumnos = ObtenerAlumnos(); //Recogemos los alumnos del archivo en un array

    

    ?>





    <fieldset>
        <legend>Busqueda de alumnos</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF']  ?>">

            Nombre<input type="text" name="Nombre"><br>
            Apellido1<input type="text" name="Apellido1"><br>
            Apellido2<input type="text" name="Apellido2"> <br>
            Edad<input type="number" name="Edad"> <br>
            Telefono<input type="text" name="Telefono"> <br>

            <input type="submit" name="Buscar" value="Buscar">



            <?php


            if (isset($_GET['Buscar'])) {
                //Recogemos los valores de los campos

                $nombre = $_GET['Nombre'];
                $apellido1 = $_GET['Apellido1'];
                $apellido2 = $_GET['Apellido2'];
                $edad = $_GET['Edad'];
                $telefono = $_GET['Telefono'];

                $filtro = array(); //Array con los valores del campos a filtrar

                $filtro[1] = $nombre;
                $filtro[2] = $apellido1;
                $filtro[3] = $apellido2;
                $filtro[4] = $edad;
                $filtro[5] = $telefono;

                $alumnos = ObtenerAlumnos();   //Recogemos los alumnos del archivo en un array

                echo "<fieldset>";

                echo "<legend>Matricular</legend>";

                echo "<table border='2'>";
                echo "<th>Selec</th><th>NIF</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th><th>Edad</th><th>Telefono</th>";

                foreach ($alumnos as $clave => $linea) {
                    $campos = explode(":", $linea);

                    if (PasaFiltro($campos, $filtro))       //Si la fila de esos campos pasa el filro
                    {
                        echo "<tr>";

                        echo "<td><input type='checkbox' name='Selec[$campos[0]]'></td>";

                        foreach ($campos as $clave => $campo) {
                            echo "<td>$campo</td>";
                        }

                        echo "</tr>";
                    }
                }

                echo "</table>";

                echo "</fieldset>";

               
            }

            ?>


        </form>

    </fieldset>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AltaAlumnos</title>
</head>

<body>
    <?php
    //Continuación del ejercicio 1 de ficheros AltaAlumno.php. Al hacer click en las cabeceras de las tablas, se mostrará la tabla ordenada por el campo seleccionado.(Enlaces).

    /*
        *** Metodos de apertura ***
        r Lectura Al inicio del archivo
        
        w Escritura Si e archivo no existe, intenta crearlo. Si existe, lo sobreescribe. Al inicio del archivo

        a+ Lectura y escritura Si e archivo no existe, intenta crearlo. Al final del archivo*/

    function guardarArchivo($alumno,$archivo)  {
        $fd = fopen($archivo,"a+") or die("Error al abrir el archivo");
        fputs($fd,$alumno);
        fclose($fd);
       
    }


    $ciclos = array("DAW", "DAM", "Mecánica", "Administración", "Marketing");

    if (isset($_GET['Guardar'])) {
        $nombre = $_GET['nombre'];
        $ape1 = $_GET['apellido1'];
        $ape2 = $_GET['apellido2'];
        $curso = $_GET['curso'];
        $ciclo = $_GET['ciclo'];

        $alumno .=$nombre.":".$ape1.":".$ape2.":".$curso.":".$ciclo."\r\n";

        $archivo = "Alumnos.txt";

        guardarArchivo($alumno,$archivo);
    }


    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <legend><b>Alta Alumnos</b></legend>

            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br><br>

            <label for="apellido1">Primer Apellido:</label><br>
            <input type="text" id="apellido1" name="apellido1"><br><br>

            <label for="apellido2">Segundo Apellido:</label><br>
            <input type="text" id="apellido2" name="apellido2"><br><br>

            <label for="curso">Curso:</label><br>
            <select name="curso" id="curso">
                <option value="1">1</option>
                <option value="2">2</option>
            </select><br><br>

            <label for="ciclo">Ciclo:</label><br>
            <select name="ciclo" id="">
                <option value="<?php echo $ciclo ?>"></option>

                <?php

                foreach ($ciclos as $key => $valor) {
                    if ($valor == $ciclo) {
                        echo "<option value='$valor' slected>$valor</option>";
                    } else {
                        echo "<option value='$valor'>$valor</option>";
                    }
                }
                ?>

            </select><br><br>


            <input type='submit' value='Guardar' name='Guardar'>




        </form>
    </fieldset>
</body>

</html>
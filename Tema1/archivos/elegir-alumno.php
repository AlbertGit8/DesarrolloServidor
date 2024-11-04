<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<!-- Desplegable que liste los alumnos pero solo por nombre y apellido y al elegirlo que salgan sus datos en un formulario rellenando con sus datos -->

<!--Luego que tambien se pueda modificar los datos desde el formulario y un formulario que permita buscar un alumno (como el alumnos variados) a partir de lo introducido en los campos-->

<?php

function ObtenerAlumno() {
    $alumnos=array(); //Array con las lineas del archivo

    $fd=fopen("alumnos_variados.txt","r") or die("Error al abrir el archivo");

    //Mostramos el contenido

    while(!feof($fd)) {
        $linea = fgets($fd);
        $campos=explode(":",$linea); //separamos la linea en campos
        $alumnos[] = $linea;
    }

    fclose($fd);

    return $alumnos;
}

if (isset($_GET['alumno'])) {
   $alu = $_GET['alumno'];
}


?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
    Alumno
    <select name="" id="">
        <option value=""></option>
        <?php
        $alumnos = ObtenerAlumno();
        foreach ($alumnos as $clave => $alumno) {
            $campos = explode(":",$alumno);
            echo  "<option value= '$campos[0]' ";
            if ($alu === $campos[3]) {
                echo "selected";
            }
            echo ">$campos[0],$campos[0]</option>";
        }
        ?>
        <input type="submit" name="enviar">
    </select>
</form>
</body>
</html>
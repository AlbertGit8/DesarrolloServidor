<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //Modificar el fomulario para que en lugar de un campo nombre habra, DNI, nombre, apellido 1 y apellido2, habria que controlar el dni ya que no se puede repetir
    $agenda = "";

    if (isset($_GET['Agenda'])) {
        $agenda = $_GET['agenda'];
    }

    if (isset($_GET['Guardar'])) {
        $agenda=$_GET['Agenda'];

        $nombre=$_GET['Nombre'];

        if ($agenda=="") {
            $agenda.=$agenda.$nombre;
        } else {
            $agenda.=$agenda. ",".$nombre;
        }
        

    }

    if (isset($_GET['Mostrar'])) {

        $agenda=$_GET['Agenda'];

        $nombres=explode(",",$agenda); //convertimos el string en un array de nombres

        echo "<table border='2'>";

        foreach ($nombres as $clave => $valor) {
           echo "<tr>";

           echo "<td>$valor</td>";
           
           echo "</tr>";
        }

        echo "</table>";

    }

    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">

            Nombre<input type="text" name="Nombre">

            <?php
            echo "<input type='hidden' name='Agenda' value='$agenda'>";
            ?>

            <input type="submit" value="Guardar" name="Guardar">

            <input type="submit" value="Mostrar" name="Mostrar">
        </form>
    </fieldset>

</body>

</html>
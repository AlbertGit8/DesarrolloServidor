<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<fieldset>
        <legend>Formulario de registro</legend>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Nombre<input type="text" name="Nombre">
            Apellido1<input type="text" name="Apellido1">
            Apellido2<input type="text" name="Apellido2">

            Salario <input type="number" name="salario">
            Fecha <input type="date" name="fecha" id="">


            <fieldset>
                <legend>Aficiones</legend>
                Tenis <input type="checkbox" name="Tenis" id="">
                <br>
                Padel <input type="checkbox" name="Padel" id="">
                <br>
                Futbol <input type="checkbox" name="Futbol" id="">
            </fieldset>
            <fieldset>
                <legend>Deportista</legend>
                No<input type="radio" name="deportista" id="" value="0">
                Si<input type="radio" name="deportista" id="" value="1">
            </fieldset>

            <input type="submit" name="Enviar" value="Envio de datos">


        </form>
    </fieldset>

    <?php

    if (isset($_GET['Enviar'])) { //Aqui controlamos si hemos pulsado el boton de submit

        $nom = $_GET['Nombre'];

        $ap1 = $_GET['Apellido1'];

        $ap2 = $_GET['Apellido2'];

        $salario = $_GET['salario'];
        $fecha = $_GET['fecha'];



        echo "Hola $nom $ap1 $ap2";
        echo "<br>";
        echo "Tu salario es $salario y tu fecha es $fecha";
        echo "<br>";

        $deportista = $_GET['deportista'];

        if ($deportista) {
            if (isset($_GET['Tenis'])) {
                echo "Me gusta el tenis";
                echo "<br>";
            }
            if (isset($_GET['Padel'])) {
                echo "Me gusta el Padel";
                echo "<br>";
            }
            if (isset($_GET['Futbol'])) {
                echo "Me gusta el Futbol";
                echo "<br>";
            }
        } else {
            echo "A $nom no le gustan los deportes es un vago";
        }
    }

    ?>

</body>
</html>
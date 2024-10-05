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

            Sexo <input type="checkbox" name="" id="">

            <fieldset>
                <legend>Aficiones</legend>
                Tenis <input type="checkbox" name="Tenis" id="">
                <br>
                Padel <input type="checkbox" name="Padel" id="">
                <br>
                Futbol <input type="checkbox" name="Futbol" id="">
            </fieldset>
            <fieldset>
                <legend>Estado civil</legend>
                Soltero<input type="radio" name="estado" id="" value="soltero">
                Casado<input type="radio" name="estado" id="" value="casado">
                Viudo<input type="radio" name="estado" id="" value="viudo">
            </fieldset>


            <textarea name="observaciones" id=""></textarea>

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

        if (isset($_GET['Tenis'])) {
            echo "Me gusta el tenis";
        }
        if (isset($_GET['Padel'])) {
            echo "Me gusta el Padel";
        }
        if (isset($_GET['Futbol'])) {
            echo "Me gusta el Futbol";
        }

        $estado = $_GET['estado'];

        echo "El estado civil es: $estado";

        echo "br";

        $obs = $_GET['observaciones'];

        echo "Observaciones realizadas: $obs";
    }

    ?>

</body>

</html>
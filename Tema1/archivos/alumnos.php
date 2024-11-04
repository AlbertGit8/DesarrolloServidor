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
    <?php
    //Instertar datos de los alumnos nof, nombre ape1 y 2 telefono y edad
    function guadar($linea,$archivo){
        $fd=fopen($archivo,"a+") or die("Error al abrir el archivo");
        fputs($fd,$linea);
        fclose($fd);
    }

    if (isset($_GET["Enviar"])) {
        $nombre = $_GET["nombre"];
        $ape1 = $_GET["apellido2"];
        $ape2 = $_GET["apellido2"];
        $nif = $_GET["nif"];
        $tel = $_GET["telefono"];
        $edad= $_GET["edad"];

       

        $saltoLin = "\r\n";

        $alumno = "$nombre:$ape1:$ape2:$nif:$tel:$edad";

        $alumno .=$saltoLin;

        $file = "alumnos.txt";

        guadar($alumno,$file);
    }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido1">Primer Apellido:</label><br>
        <input type="text" id="apellido1" name="apellido1" required><br><br>

        <label for="apellido2">Segundo Apellido:</label><br>
        <input type="text" id="apellido2" name="apellido2"><br><br>

        <label for="nif">NIF:</label><br>
        <input type="text" id="nif" name="nif" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="edad">Edad:</label><br>
        <input type="text" id="edad" name="edad" required><br><br>

        <input type="submit" name="Enviar">
    </form>
</body>

</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../libreriaBD.php");
require_once("01funciones.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Alumnos</title>
</head>
<body>
     <!-- formulario para dar de alta un alumno comprobando las longitudes de los campos -->

     <?php
     $nif = "";
     $nombre = "";
     $apellido1 = "";
     $apellido2 = "";
     $edad = "";
     $telefono = "";

     if (isset($_POST['enviar'])) {
         $nif = $_POST['nif'];
         $nombre = $_POST['nombre'];
         $apellido1 = $_POST['apellido1'];
         $apellido2 = $_POST['apellido2'];
         $edad = $_POST['edad'];
         $telefono = $_POST['telefono'];

         $valido = validarDatos($nif, $nombre, $apellido1, $apellido2,$edad, $telefono);

         if ($valido) {
            $consulta = "INSERT INTO alumnos VALUES('$nif','$nombre','$apellido1','$apellido2','$edad','$telefono')";

            consulta($consulta);
         }
     }
     ?>

     <fieldset>
        <legend>Alta Alumno</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <p>
                <label for="nif">NIF: </label>
                <input type="text" name="nif" value="<?php echo $nif ?>">
            </p>

            <p>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" value="<?php echo $nombre ?>">
            </p>

            <p>
                <label for="apellido1">Apellido 1: </label>
                <input type="text" name="apellido1" value="<?php echo $apellido1 ?>">
            </p>

            <p>
                <label for="apellido2">Apellido 2: </label>
                <input type="text" name="apellido2" value="<?php echo $apellido2 ?>">
            </p>

            <p>
                <label for="edad">Edad: </label>
                <input type="text" name="edad" value="<?php echo $edad ?>">
            </p>

            <p>
                <label for="telefono">Telefono: </label>
                <input type="text" name="telefono" value="<?php echo $telefono ?>">
            </p>

            <input type="submit" name="enviar" value="Enviar">
        </form>
     </fieldset>
</body>
</html>
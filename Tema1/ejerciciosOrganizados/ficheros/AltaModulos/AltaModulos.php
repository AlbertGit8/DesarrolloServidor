<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AltaModulos</title>
</head>

<body>
    <?php
    /* Implementa un formulario para registrar módulos. Los datos incluyen
    el nombre del módulo, el curso y el ciclo. El programa guarda esta información en el archivo
    'Modulos.txt'. También genera un código único para cada módulo en función de los datos
    ingresados.
    */

    ?>
    <!-- Formulario para registrar módulos -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <label for="nombre">Nombre del Módulo:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="curso">Curso:</label><br>
        <input type="number" id="curso" name="curso" min="1" max="4" required><br><br>

        <label for="ciclo">Ciclo:</label><br>
        <input type="text" id="ciclo" name="ciclo" required><br><br>

        <input type="submit" name="guardar" value="Guardar Módulo">
    </form>

    <?php
    if (isset($_GET['guardar'])) {
        // Capturamos los datos ingresados
        $nombre = $_GET['nombre'];
        $curso = $_GET['curso'];
        $ciclo = $_GET['ciclo'];

        // Generamos un código único en función de los datos
        $codigo = substr($nombre, 0, 3) . "-" . $curso . "-" . substr($ciclo, 0, 3);
        $codigo = strtoupper($codigo); // Pasamos a mayúsculas para uniformidad

        // Preparamos el texto a guardar en el archivo
        $linea = "$codigo, $nombre, $curso, $ciclo" . PHP_EOL;

        // Guardamos en el archivo Modulos.txt
        $archivo = fopen("Modulos.txt", "a"); // Modo 'a' para añadir al final
        if ($archivo) {
            fwrite($archivo, $linea);
            fclose($archivo);
            echo "<p>¡Módulo guardado correctamente con el código $codigo!</p>";
        } else {
            echo "<p>Error al abrir el archivo.</p>";
        }
    }
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paises</title>

</head>

<body>
    <?php
    /*Este programa gestiona un archivo llamado 'Paises.txt' para almacenar los
nombres de países. Verifica si un país ya está registrado antes de agregarlo al archivo y
genera un ID único para cada nuevo país. Si un país ya existe, muestra un mensaje de error.*/


    function generarCodigo($paises, $pais)
    {

        $codigo = strtoupper(substr($pais, 0, 2) . rand(100, 300));

        foreach ($paises as $registro) {
            if ($registro[0] === $codigo) {
                return generarCodigo($paises, $pais);
            }
        }

        return $codigo;
    }

    function existe($paises, $pais)
    {

        foreach ($paises as $registro) {
            if (trim($registro[1] === trim($pais))) {
                return true;
            }
        }

        return false;
    }

    function obtenerPaises()
    {
        $paises = array();

        $fd = fopen("paises.txt", "r") or die("Error al abrir el archivo");

        while (!feof($fd)) {

            $linea = fgets($fd);

            $campos = explode(":", $linea);

            if (count($campos) === 2) {
                $paises[] = array(trim($campos[0]), trim($campos[1]));
            }
        }

        fclose($fd);

        return $paises;
    }

    function guardarPais($pais, $paises)
    {
        if (existe($paises, $pais)) {
            echo "<p><span style='color:red;'>ERROR</span> el pais ya existe</p>";
        } else {
            $codigo = generarCodigo($paises, $pais);

            $idPais = $codigo . ":" . $pais . "\n";

            $fd = fopen("paises.txt", "a+") or die("Error al abrir el archivo");

            fputs($fd, $idPais);

            fclose($fd);

            echo "<p>El pais $pais ha sido guardado con el código $codigo</p>";
        }
    }
    ?>


    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <label for="pais">Introduce un pais a guardar:</label><br>
            <input type="text" id="pais" name="pais" required><br><br>

            <input type="submit" value="Guardar" name="Guardar">
        </form>
    </fieldset>

    <?php
    if (isset($_GET['Guardar'])) {
        $pais = $_GET['pais'];

        $paises = obtenerPaises();

        guardarPais($pais, $paises);
    }
    ?>
</body>

</html>
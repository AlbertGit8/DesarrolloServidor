<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgendaCampos</title>
</head>

<body>

    <?php
    // Gestiona una agenda de datos donde se permite ordenar los registros alfabéticamente por diferentes campos, y muestra los resultados al usuario.

    
    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <legend>Agenda</legend>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="apellido1">Primer Apellido:</label><br>
            <input type="text" id="apellido1" name="apellido1" required><br><br>

            <label for="apellido2">Segundo Apellido:</label><br>
            <input type="text" id="apellido2" name="apellido2"><br><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" pattern="[0-9]{9}" title="Introduce un número de 9 dígitos" required><br><br>

            <input type="hidden" name="agenda" value="<?php echo $agenda ?>">

            <input type="submit" value="Guardar">
        </form>
    </fieldset>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 7</title>
</head>

<body>
    <?php
    //Crea un programa que utiliza un array multidimensional para almacenar información de alumnos (nombre, apellidos y DNI). Luego, utiliza un bucle foreach para recorrer y mostrar los datos en una tabla HTML.

    $alumnos = array(
        array("nombre" => "Juan", "apellidos" => "Pérez", "dni" => "12345678A"),
        array("nombre" => "Ana", "apellidos" => "García", "dni" => "87654321B"),
        array("nombre" => "Luis", "apellidos" => "Martínez", "dni" => "56781234C"),
        array("nombre" => "María", "apellidos" => "López", "dni" => "43218765D")
    );

    
    echo "<table border='1'>";
    echo "<tr><th>Nombre</th><th>Apellidos</th><th>DNI</th></tr>";

    foreach ($alumnos as $alumno) {
        echo "<tr>";
        echo "<td>" . $alumno['nombre'] . "</td>";
        echo "<td>" . $alumno['apellidos'] . "</td>";
        echo "<td>" . $alumno['dni'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>

</html>
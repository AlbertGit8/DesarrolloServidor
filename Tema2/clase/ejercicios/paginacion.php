<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$password = "root";
$database = "tema2";
$recordsPerPage = 10; // Número de registros por página

// Conexión a la base de datos
$db = mysqli_connect($host, $user, $password, $database);

// Página actual
$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Consulta con paginación
$consulta = "SELECT * FROM alumnos LIMIT $recordsPerPage OFFSET $offset";
$resul = mysqli_query($db, $consulta);

$alumnos = [];
if ($resul) {
    $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
} else {
    echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos con Paginación</title>
</head>
<body>
    <fieldset>
        <legend>Seleccionar Página</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="page">Página: </label>
            <input type="number" id="page" name="page" value="<?php echo $page ?>" min="1">
            <input type="submit" value="Ver página">
        </form>
    </fieldset>

    <fieldset>
        <legend>Resultado de la búsqueda</legend>
        <table border="2">
            <tr>
                <th>NIF</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Edad</th>
                <th>Telefono</th>
            </tr>
            <?php foreach ($alumnos as $alumno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($alumno['NIF']) ?></td>
                    <td><?php echo htmlspecialchars($alumno['Nombre']) ?></td>
                    <td><?php echo htmlspecialchars($alumno['Apellido1']) ?></td>
                    <td><?php echo htmlspecialchars($alumno['Apellido2']) ?></td>
                    <td><?php echo htmlspecialchars($alumno['Edad']) ?></td>
                    <td><?php echo htmlspecialchars($alumno['Telefono']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </fieldset>
</body>
</html>
   
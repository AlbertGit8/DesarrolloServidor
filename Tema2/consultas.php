<?php
//fichero con las consultas mas usadas
$consulta = "";

// Seleccionar todos los alumnos
$consulta = "SELECT * FROM alumnos";

// Seleccionar un alumno específico
$consulta = "SELECT * FROM alumnos WHERE Apellido1='Garcia' AND Apellido2='Perez' AND Nombre='Juan'";

// Seleccionar alumnos que cumplan al menos una de las condiciones
$consulta = "SELECT * FROM alumnos WHERE Apellido1='Garcia' OR Apellido2='Perez' OR Nombre='Juan'";

// Consulta con COUNT: contar alumnos específicos
$consulta = "SELECT COUNT(*) FROM alumnos WHERE Apellido1='Garcia' AND Apellido2='Perez' AND Nombre='Juan'";

// Consulta con AVG: promedio de notas
$consulta = "SELECT NIF, AVG(nota) AS promedio_notas FROM alumnos GROUP BY NIF";

// Consulta con SUM: sumar las calificaciones de cada alumno
$consulta = "SELECT NIF, SUM(nota) AS suma_notas FROM alumnos GROUP BY NIF";

// Consulta con LIKE: buscar alumnos por nombre parcial
$consulta = "SELECT NIF, Nombre, Apellido1, Apellido2 FROM alumnos WHERE Nombre LIKE '%$nombre%'";

// Consulta con ORDER BY: ordenar por apellidos en orden descendente
$consulta = "SELECT * FROM alumnos WHERE Apellido1='Garcia' ORDER BY Apellido1 DESC";

// Consulta con LIMIT: obtener los primeros 5 registros
$consulta = "SELECT * FROM alumnos WHERE Apellido1='Garcia' ORDER BY Apellido1 DESC LIMIT 5";

// Consulta con LIMIT para un rango específico
$consulta = "SELECT * FROM alumnos WHERE Apellido1='Garcia' ORDER BY Apellido1 DESC LIMIT 5, 10";

// Consulta con INNER JOIN: combinar con otra tabla (ejemplo: notas)
$consulta = "SELECT a.NIF, a.Nombre, a.Apellido1, a.Apellido2, n.nota 
             FROM alumnos a 
             INNER JOIN notas n ON a.NIF = n.IdAlum 
             WHERE a.Apellido1='Garcia' 
             ORDER BY a.Apellido1";

// Consulta con HAVING: filtrar después de calcular el promedio de notas
$consulta = "SELECT NIF, AVG(nota) AS promedio_notas 
             FROM alumnos 
             GROUP BY NIF 
             HAVING promedio_notas > 10";

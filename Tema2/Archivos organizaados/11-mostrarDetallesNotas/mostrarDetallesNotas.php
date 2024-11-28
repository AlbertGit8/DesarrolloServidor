<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("11funciones.php");

$consulta = "SELECT * FROM alumnos WHERE 1 ";
$arrayAlumnos = consultaDatosAssoc($consulta);

if (isset($_GET['NIFSelec'])) {
    $NIF = $_GET['NIFSelec'];
    mostrarNotasAlumno($NIF);
} else {
    mostrarTablaAlumnos($arrayAlumnos);
}
?>
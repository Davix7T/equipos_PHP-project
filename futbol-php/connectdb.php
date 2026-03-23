<?php
$host = "db";  // En Docker, el host es el nombre del servicio
$usuario = "admin-futbol";
$password = "futbol123";
$bd = "futbol";

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

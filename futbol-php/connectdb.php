<?php
$host = "localhost";
$usuario = "admin-futbol";
$password = "futbol123";
$bd = "futbol";

$conexion = new mysqli($host, $usuario, $password, $bd);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
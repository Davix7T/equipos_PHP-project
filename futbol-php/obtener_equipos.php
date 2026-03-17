<?php
include("connectdb.php");

$sql = "SELECT * FROM equipos ORDER BY nombre";
$resultado = $conexion->query($sql);

$equipos = [];

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $equipos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($equipos);

$conexion->close();
?>
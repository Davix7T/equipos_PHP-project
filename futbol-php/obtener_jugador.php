<?php
include("connectdb.php");

$sql = "SELECT j.id, j.nombre, j.posicion, j.edad, j.equipo_id, 
               e.nombre as equipo_nombre, e.dorsal, e.precio
        FROM jugadores j
        LEFT JOIN equipos e ON j.equipo_id = e.id
        ORDER BY j.id DESC";
        
$resultado = $conexion->query($sql);

$jugadores = [];

if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $jugadores[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($jugadores);

$conexion->close();
?>
<?php
include("connectdb.php");

// Total de jugadores
$sqlJugadores = "SELECT COUNT(*) as total FROM jugadores";
$resultJugadores = $conexion->query($sqlJugadores);
$totalJugadores = $resultJugadores->fetch_assoc()['total'];

// Total de equipos
$sqlEquipos = "SELECT COUNT(*) as total FROM equipos";
$resultEquipos = $conexion->query($sqlEquipos);
$totalEquipos = $resultEquipos->fetch_assoc()['total'];

// Jugadores por posición
$sqlPorPosicion = "SELECT posicion, COUNT(*) as cantidad FROM jugadores GROUP BY posicion";
$resultPorPosicion = $conexion->query($sqlPorPosicion);
$jugadoresPorPosicion = [];
while($row = $resultPorPosicion->fetch_assoc()) {
    $jugadoresPorPosicion[] = $row;
}

// Jugadores por equipo
$sqlPorEquipo = "SELECT e.nombre as equipo, COUNT(j.id) as cantidad 
                 FROM equipos e 
                 LEFT JOIN jugadores j ON e.id = j.equipo_id 
                 GROUP BY e.id, e.nombre 
                 ORDER BY cantidad DESC";
$resultPorEquipo = $conexion->query($sqlPorEquipo);
$jugadoresPorEquipo = [];
while($row = $resultPorEquipo->fetch_assoc()) {
    $jugadoresPorEquipo[] = $row;
}

// Promedio de edad
$sqlEdadPromedio = "SELECT AVG(edad) as promedio FROM jugadores";
$resultEdadPromedio = $conexion->query($sqlEdadPromedio);
$edadPromedio = round($resultEdadPromedio->fetch_assoc()['promedio'], 1);

// Jugadores sin equipo
$sqlSinEquipo = "SELECT COUNT(*) as total FROM jugadores WHERE equipo_id IS NULL";
$resultSinEquipo = $conexion->query($sqlSinEquipo);
$jugadoresSinEquipo = $resultSinEquipo->fetch_assoc()['total'];

// Precio promedio de camisetas
$sqlPrecioPromedio = "SELECT AVG(precio) as promedio FROM equipos";
$resultPrecioPromedio = $conexion->query($sqlPrecioPromedio);
$precioPromedio = round($resultPrecioPromedio->fetch_assoc()['promedio'], 2);

// Top 3 equipos más caros
$sqlEquiposCaros = "SELECT nombre, precio FROM equipos ORDER BY precio DESC LIMIT 3";
$resultEquiposCaros = $conexion->query($sqlEquiposCaros);
$equiposCaros = [];
while($row = $resultEquiposCaros->fetch_assoc()) {
    $equiposCaros[] = $row;
}

$estadisticas = [
    'totalJugadores' => $totalJugadores,
    'totalEquipos' => $totalEquipos,
    'jugadoresPorPosicion' => $jugadoresPorPosicion,
    'jugadoresPorEquipo' => $jugadoresPorEquipo,
    'edadPromedio' => $edadPromedio,
    'jugadoresSinEquipo' => $jugadoresSinEquipo,
    'precioPromedio' => $precioPromedio,
    'equiposCaros' => $equiposCaros
];

header('Content-Type: application/json');
echo json_encode($estadisticas);

$conexion->close();
?>
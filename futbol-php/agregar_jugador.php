<?php
error_reporting(0);
ini_set('display_errors', 0);

include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : '';
    $equipo_id = isset($_POST['equipo_id']) && $_POST['equipo_id'] !== '' ? intval($_POST['equipo_id']) : null;
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    
    if (!empty($nombre) && !empty($posicion) && $edad > 0) {
        $sql = "INSERT INTO jugadores (nombre, posicion, equipo_id, edad) VALUES (?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssii", $nombre, $posicion, $equipo_id, $edad);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Jugador agregado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar jugador: ' . $conexion->error]);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conexion->close();
?>
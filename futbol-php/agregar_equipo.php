<?php
error_reporting(0);
ini_set('display_errors', 0);

include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $dorsal = isset($_POST['dorsal']) ? intval($_POST['dorsal']) : 0;
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    
    if (!empty($nombre) && $dorsal > 0 && $precio > 0) {
        $sql = "INSERT INTO equipos (nombre, dorsal, precio) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sid", $nombre, $dorsal, $precio);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Equipo agregado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar equipo: ' . $conexion->error]);
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
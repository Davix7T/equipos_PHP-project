<?php
error_reporting(0);
ini_set('display_errors', 0);

include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $dorsal = isset($_POST['dorsal']) ? intval($_POST['dorsal']) : 0;
    $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
    
    if ($id > 0 && !empty($nombre) && $dorsal > 0 && $precio > 0) {
        $sql = "UPDATE equipos SET nombre=?, dorsal=?, precio=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sidi", $nombre, $dorsal, $precio, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Equipo actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar equipo']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }
}

$conexion->close();
?>
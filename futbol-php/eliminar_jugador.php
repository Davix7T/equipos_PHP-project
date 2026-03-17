<?php
include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {
        $sql = "DELETE FROM jugadores WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Jugador eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar jugador']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}

$conexion->close();
?>
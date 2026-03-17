<?php
include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {
        $sql = "DELETE FROM equipos WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Equipo eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar equipo']);
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
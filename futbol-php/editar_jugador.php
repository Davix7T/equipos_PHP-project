<?php
error_reporting(0);
ini_set('display_errors', 0);

include("connectdb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $posicion = isset($_POST['posicion']) ? $_POST['posicion'] : '';
    $equipo_id = isset($_POST['equipo_id']) && $_POST['equipo_id'] !== '' ? intval($_POST['equipo_id']) : null;
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    
    if ($id > 0 && !empty($nombre) && !empty($posicion) && $edad > 0) {
        $sql = "UPDATE jugadores SET nombre=?, posicion=?, equipo_id=?, edad=? WHERE id=?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssiii", $nombre, $posicion, $equipo_id, $edad, $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Jugador actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar jugador']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }
}

$conexion->close();
?>
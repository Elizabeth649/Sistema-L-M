<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión']));
}

// Obtener datos del JSON enviado
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];

    // Eliminar el producto
    $sql = "DELETE FROM liquidacion WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado']);
}

$conn->close();
?>

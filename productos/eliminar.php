<?php
// eliminar.php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

if ($id) {
    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
}

$conn->close();
?>

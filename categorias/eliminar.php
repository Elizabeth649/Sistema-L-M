<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Obtener datos de la solicitud JSON
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// Preparar y ejecutar la consulta de eliminación
$sql = "DELETE FROM categorias WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error deleting category: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

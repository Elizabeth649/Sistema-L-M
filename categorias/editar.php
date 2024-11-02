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
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];

// Preparar y ejecutar la consulta de actualización
$sql = "UPDATE categorias SET nombre=?, descripcion=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $nombre, $descripcion, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error updating category: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

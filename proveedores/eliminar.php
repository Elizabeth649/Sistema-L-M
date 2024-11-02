<?php 

header('Content-Type: application/json');

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Obtener el ID del proveedor a eliminar
$data = json_decode(file_get_contents('php://input'), true);
$id = isset($data['id']) ? $data['id'] : '';

// Validar que el ID no esté vacío
if (!empty($id)) {
    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("DELETE FROM proveedores WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el proveedor: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID del proveedor es requerido.']);
}

$conn->close();
?>

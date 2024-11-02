<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Decodificar los datos JSON recibidos
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si todos los campos necesarios están presentes y tienen el tipo correcto
if (isset($data['id'], $data['producto_id'], $data['cantidad'], $data['precio_total'], $data['fecha']) &&
    is_numeric($data['id']) && is_numeric($data['producto_id']) && is_numeric($data['cantidad']) && is_numeric($data['precio_total'])) {
    
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE ventas SET productos_id = ?, cantidad = ?, precio_total = ?, fecha = ? WHERE id = ?");
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error]);
        exit;
    }

    // Asignar variables
    $id = (int)$data['id'];
    $productos_id = (int)$data['producto_id'];
    $cantidad = (int)$data['cantidad'];
    $precio_total = (float)$data['precio_total'];
    $fecha = $data['fecha'];

    // Vincular los parámetros correctamente ("isdis" en lugar de "iiisi" para el tipo de datos)
    $stmt->bind_param("iidsi", $productos_id, $cantidad, $precio_total, $fecha, $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Venta actualizada con éxito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Complete todos los campos']);
}

$conn->close();
?>

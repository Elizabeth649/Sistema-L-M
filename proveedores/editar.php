<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar si hay errores en la conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
    exit;
}

// Leer el JSON enviado por el frontend
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos necesarios están presentes
if (!isset($data['id'], $data['empresa'], $data['nombre'], $data['telefono'], $data['email'])) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos para actualizar el proveedor']);
    exit;
}

// Asignar los datos a variables
$id = $data['id'];
$empresa = $data['empresa'];
$nombre = $data['nombre'];
$telefono = $data['telefono'];
$email = $data['email'];

// Preparar la consulta de actualización
$sql = "UPDATE proveedores SET empresa = ?, nombre = ?, telefono = ?, email = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta: ' . $conn->error]);
    exit;
}

// Vincular los parámetros y ejecutar la consulta
$stmt->bind_param("ssssi", $empresa, $nombre, $telefono, $email, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Proveedor actualizado correctamente']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al actualizar el proveedor: ' . $stmt->error]);
}

// Cerrar la conexión y la declaración
$stmt->close();
$conn->close();
?>

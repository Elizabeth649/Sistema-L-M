<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión']));
}

// Obtener datos del JSON enviado
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'], $data['nombre'], $data['estado'], $data['descripcion'], $data['costo'], $data['cantidad'])) {
    $id = $data['id'];
    $nombre = $conn->real_escape_string($data['nombre']);
    $estado = $conn->real_escape_string($data['estado']); // Escapar el campo 'estado'
    $descripcion = $conn->real_escape_string($data['descripcion']);
    $costo = $data['costo'];
    $cantidad = $data['cantidad'];

    // Actualizar el producto incluyendo el campo 'estado'
    $sql = "UPDATE liquidacion SET nombre='$nombre', estado='$estado', descripcion='$descripcion', costo='$costo', cantidad='$cantidad' WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
}

$conn->close();
?>

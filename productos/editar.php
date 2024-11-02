<?php
// editar.php
header('Content-Type: application/json');

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Comprobar conexión
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Conexión fallida: ' . $conn->connect_error]);
    exit;
}

// Obtener los datos JSON
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['id'];
$nombre = $data['nombre'];
$descripcion = $data['descripcion'];
$cantidad = $data['cantidad'];
$unidadMedida = $data['unidadMedida'];
$precio_unidad = $data['precio_unidad'];
$precio_mayoreoad = $data['precio_mayoreoad'];
$precio_unidadlym = $data['precio_unidadlym'];
$precio_mayoreolym = $data['precio_mayoreolym'];
$fecha_vencimiento = $data['fecha_vencimiento'];

// Preparar y ejecutar la consulta de actualización
$stmt = $conn->prepare("UPDATE productos SET nombre=?, descripcion=?, cantidad=?, unidad_medida=?, precio_unidad=?, precio_mayoreoad=?, precio_unidadlym=?, precio_mayoreolym=?, fecha_vencimiento=? WHERE id=?");
$stmt->bind_param("ssissssssi", $nombre, $descripcion, $cantidad, $unidadMedida, $precio_unidad, $precio_mayoreoad, $precio_unidadlym, $precio_mayoreolym, $fecha_vencimiento, $id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la consulta: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>

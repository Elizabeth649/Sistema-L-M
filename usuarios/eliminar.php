<?php
// Conexión a la base de datos
include '../DB/conexion.php';

header('Content-Type: application/json'); // Establece el tipo de contenido a JSON

// Obtener la entrada JSON
$data = json_decode(file_get_contents('php://input'), true);

// Verificar que se recibió un ID
if (isset($data['id'])) {
    $id = $data['id'];

    // Preparar la consulta para eliminar el usuario
    $query = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id); // Bind del parámetro como entero

    if ($stmt->execute()) {
        // Si la eliminación fue exitosa
        echo json_encode(['success' => true]);
    } else {
        // Si hubo un error en la eliminación
        echo json_encode(['success' => false, 'message' => 'Error al eliminar el usuario.']);
    }

    $stmt->close();
} else {
    // Si no se proporcionó un ID
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
}

$conn->close();
?>

<?php

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Leer el cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
    // Obtener el ID de la venta a eliminar
    $id = $data->id;

    // Consulta para eliminar la venta
    $sql = "DELETE FROM ventas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Respuesta de éxito en formato JSON
        echo json_encode(["success" => true]);
    } else {
        // Respuesta de error en formato JSON
        echo json_encode(["success" => false, "error" => $conn->error]);
    }

    $stmt->close();
} else {
    // Respuesta de error si no se recibe un ID válido
    echo json_encode(["success" => false, "error" => "ID no válido"]);
}

$conn->close();
?>

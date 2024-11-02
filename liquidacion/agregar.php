<?php
// Crear conexión
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $cantidad = $_POST['cantidad'];

    // Preparar y bindear
    $stmt = $conn->prepare("INSERT INTO liquidacion (nombre, estado, descripcion, costo, cantidad) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $nombre, $estado, $descripcion, $costo, $cantidad);

    // Ejecutar
    if ($stmt->execute()) {
        // Redirigir a index.php después de guardar
        header("Location: ../liquidacion/index.php");
        exit(); // Asegúrate de llamar a exit después de header
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar declaración
    $stmt->close();
}

// Cerrar conexión
$conn->close();
?>

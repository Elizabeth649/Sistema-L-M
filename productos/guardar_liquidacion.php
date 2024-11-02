<?php
// Crear conexión
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Desactivar la verificación de claves foráneas
$conn->query("SET FOREIGN_KEY_CHECKS=0");

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado']; // Estado puede ser 'Liquidación'
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $cantidad = $_POST['cantidad'];

    // Preparar y bindear la inserción en la tabla 'liquidacion'
    $stmt = $conn->prepare("INSERT INTO liquidacion (nombre, estado, descripcion, costo, cantidad, id_producto) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssddi", $nombre, $estado, $descripcion, $costo, $cantidad, $id_producto);

    // Ejecutar la inserción en 'liquidacion'
    if ($stmt->execute()) {
        // Preparar y bindear la eliminación de la tabla 'productos'
        $deleteStmt = $conn->prepare("DELETE FROM productos WHERE id = ?");
        $deleteStmt->bind_param("i", $id_producto);

        if ($deleteStmt->execute()) {
            // Redirigir a la página de liquidación
            header("Location: ../liquidacion/index.php");
            exit(); // Asegúrate de terminar la ejecución después de la redirección
        } else {
            echo "Error al eliminar el producto de la tabla 'productos': " . $deleteStmt->error;
        }

        // Cerrar la declaración de eliminación
        $deleteStmt->close();
    } else {
        echo "Error al insertar el producto en 'liquidacion': " . $stmt->error;
    }

    // Cerrar la declaración de inserción
    $stmt->close();
}

// Reactivar la verificación de claves foráneas
$conn->query("SET FOREIGN_KEY_CHECKS=1");

// Cerrar conexión
$conn->close();
?>

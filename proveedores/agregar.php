<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario
$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Validar que los campos no estén vacíos
if (!empty($empresa) && !empty($nombre)&& !empty($telefono) && !empty($email)) {
    // Preparar y ejecutar la consulta
    $stmt = $conn->prepare("INSERT INTO proveedores (empresa, nombre, telefono, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $empresa, $nombre, $telefono, $email);

    if ($stmt->execute()) {
        // Redirigir a la página principal después de guardar
        header("Location: ../proveedores/index.php");
        exit();
    } else {
        // Manejar error si la consulta falla
        echo "Error al agregar el proveedor: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Manejar error si los campos están vacíos
    echo "Todos los campos son requeridos.";
}

$conn->close();
?>

<?php
require '../DB/conexion.php'; // Incluir la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $nueva_contra = $_POST['nueva_contra'];

    // Preparar la consulta para actualizar la contraseña y limpiar el token
    $sql = "UPDATE usuarios SET contraseña = ?, token = NULL WHERE token = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Si la preparación falla, muestra el error
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // En lugar de hashear la contraseña, se utilizará tal como está (texto plano)
    // Asignar los parámetros
    $stmt->bind_param("ss", $nueva_contra, $token);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo 'Contraseña actualizada exitosamente.';
        } else {
            echo 'No se encontró un usuario con ese token.';
        }
    } else {
        echo "Error al actualizar la contraseña: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    echo 'Método no permitido.';
}
?>

<!-- Botón para volver a la página de inicio de sesión -->
<div style="margin-top: 20px;">
    <a href="../index.php">
        <button style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">
            Volver a Iniciar Sesión
            </button>
    </a>
</div>
<?php
// Conexión a la base de datos
include '../DB/conexion.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña']; // La nueva contraseña si se quiere cambiar

// Verificar si el campo de contraseña está vacío o no
if (!empty($contraseña)) {
    // Si el campo de contraseña no está vacío, actualiza también la contraseña
    $query = "UPDATE usuarios SET nombre = ?, correo = ?, contraseña = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssi", $nombre, $correo, $contraseña, $id);
} else {
    // Si no se quiere cambiar la contraseña, actualiza solo el nombre y correo
    $query = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $nombre, $correo, $id);
}

if ($stmt->execute()) {
    // Redirigir de vuelta a la página de usuarios o mostrar un mensaje de éxito
    header("Location: ../usuarios/index.php?mensaje=usuario_actualizado");
} else {
    // En caso de error
    echo "Error al actualizar usuario: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

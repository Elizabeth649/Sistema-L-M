<?php
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// Verificar si el correo ya existe
$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // El correo ya existe, redirigir con mensaje de error
    header("Location: index.php?error=correo_existente");
} else {
    // El correo no existe, proceder a agregar el usuario
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $contraseña);
    $stmt->execute();

    // Redirigir con mensaje de éxito
    header("Location: index.php?agregado=true");
}

$stmt->close();
$conn->close();
?>



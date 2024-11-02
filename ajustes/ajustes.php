<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevo_nombre = $_POST['nombre_negocio'];
    $nueva_imagen = $_POST['imagen_negocio']; // Tomar la URL de la imagen

    // Actualizar el nombre del negocio y la imagen
    $sql = "UPDATE ajustes SET nombre_negocio = ?, imagen_negocio = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nuevo_nombre, $nueva_imagen);
    
    if ($stmt->execute()) {
        // Redirigir a index.php con mensaje de éxito
        header("Location: ../ajustes/index.php?mensaje=exito");
        exit(); 
    } else {
        echo "Error al actualizar los datos: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

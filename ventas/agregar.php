<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventario_lym";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se recibió el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $productos_id = $_POST['productos_id']; // Asegúrate de que este campo esté definido en tu formulario
    $cantidad = $_POST['cantidad'];
    $precio_total = $_POST['precio_total'];
    $fecha = $_POST['fecha'];
    
    $sql = "INSERT INTO ventas (productos_id, cantidad, precio_total, fecha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iids", $productos_id, $cantidad, $precio_total, $fecha);

    if ($stmt->execute()) {
        // Redirigir a la página de ventas después de agregar la venta
        header("Location: ../ventas/index.php"); // Asegúrate de que la ruta sea correcta
        exit();
    } else {
        echo "Error al agregar la venta: " . $conn->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar que se reciban los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $descripcion = $conn->real_escape_string($_POST['descripcion']);
    $categoria_id = (int)$_POST['categoria'];
    $cantidad = (int)$_POST['cantidad']; // Asegúrate de obtener la cantidad del formulario
    $unidad_medida = $conn->real_escape_string($_POST['unidad_medida']);
    $precio_unidad = (float)$_POST['precio_unidad'];
    $precio_mayoreoad = (float)$_POST['precio_mayoreoad'];
    $precio_unidadlym = (float)$_POST['precio_unidadlym'];
    $precio_mayoreolym = (float)$_POST['precio_mayoreolym'];
    $cantidad = (int)$_POST['cantidad']; // Asegúrate de obtener la cantidad del formulario
    $fecha_vencimiento = $conn->real_escape_string($_POST['fecha_vencimiento']); // Obtener la fecha de vencimiento

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO productos (nombre, descripcion, cantidad,  unidad_medida, categoria_id, precio_unidad, precio_mayoreoad, precio_unidadlym, precio_mayoreolym, fecha_vencimiento)
            VALUES ('$nombre', '$descripcion', $cantidad, '$unidad_medida', $categoria_id, $precio_unidad, $precio_mayoreoad, $precio_unidadlym, $precio_mayoreolym, '$fecha_vencimiento')";
            
            
    if ($conn->query($sql) === TRUE) {
        // Redirigir de nuevo a index.php después de guardar
        header("Location: ../productos/index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>

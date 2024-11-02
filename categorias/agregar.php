<?php
session_start(); // Inicia la sesión para usar variables de sesión

// Datos de la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "inventario_lym"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';

    // Verificar que ambos campos no estén vacíos
    if (!empty($nombre) && !empty($descripcion)) {
        // Preparar la consulta SQL para insertar la nueva categoría
        $sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Enlazar los valores a los parámetros de la consulta
            $stmt->bind_param("ss", $nombre, $descripcion);
            // Ejecutar la consulta
            if ($stmt->execute()) {
                // Guardar mensaje de éxito en la sesión
                $_SESSION['mensaje'] = 'Categoría guardada correctamente.';
                header("Location: ../categorias/index.php");
                exit;
            } else {
                // Guardar mensaje de error en la sesión
                $_SESSION['mensaje'] = 'Error al guardar la categoría: ' . $stmt->error;
                header("Location: ../categorias/index.php");
                exit;
            }
            // Cerrar la declaración
            $stmt->close();
        } else {
            $_SESSION['mensaje'] = 'Error en la preparación de la consulta: ' . $conn->error;
            header("Location: ../categorias/index.php");
            exit;
        }
    } else {
        $_SESSION['mensaje'] = 'Por favor, completa todos los campos.';
        header("Location: ../categorias/index.php");
        exit;
    }
}

// Cerrar la conexión
$conn->close();

<?php
// Inicializa la variable para almacenar el mensaje de error
$error = "";

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Cambia esto por tu usuario de la base de datos
$password = ""; // Cambia esto por tu contraseña de la base de datos
$dbname = "inventario_lym"; // Cambia esto por el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejo del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Verifica que se hayan ingresado ambos campos
    if (empty($correo) || empty($contraseña)) {
        $error = "Por favor ingrese ambos campos.";
    } else {
        // Consulta a la base de datos
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica si el usuario existe
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();

            // Verifica la contraseña (usa password_verify si usas hash)
            if ($contraseña === $usuario['contraseña']) { // Cambia esto a password_verify si usas hashing
                session_start();
                $_SESSION['usuario'] = $correo; // O el ID del usuario, según tu diseño
                header("Location: ./dashboard.php"); // Cambia esto a la página de destino
                exit();
            } else {
                $error = "Correo y/o contraseña incorrectos.";
            }
        } else {
            $error = "Correo y/o contraseña incorrectos.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
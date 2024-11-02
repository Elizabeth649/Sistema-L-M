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

// Consulta para obtener el nombre del negocio y la imagen
$sql = "SELECT nombre_negocio, imagen_negocio FROM ajustes WHERE id = 1"; // Asegúrate de que tienes la columna imagen_negocio en tu tabla
$result = $conn->query($sql);

// Obtener el nombre del negocio y la imagen
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_negocio = $row['nombre_negocio'];
    $imagen_negocio = $row['imagen_negocio']; // URL del logo
} else {
    $nombre_negocio = "LIBRERIA Y VARIEDADES LyM";
    $imagen_negocio = "img/logo.png"; // Ruta por defecto si no se encuentra en la base de datos
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librería y Variedad L y M</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-purple-100 flex items-center justify-center min-h-screen">
    <div class="bg-pink-200 w-full lg:w-3/4 xl:w-2/3 p-10 rounded-lg shadow-lg flex flex-col lg:flex-row">
        <div class="bg-white p-20 flex flex-col justify-center w-full lg:w-1/2">
            <h2 class="text-xl font-bold mb-6 text-center"><?php echo htmlspecialchars($nombre_negocio); ?></h2>

            <img src="<?php echo htmlspecialchars($imagen_negocio); ?>" alt="Logo de <?php echo htmlspecialchars($nombre_negocio); ?>" class="mb-4 mx-auto" width="120" height="120">
            <h2 class="text-xl font-bold mb-6 text-center">INICIAR SESIÓN</h2>

            <!-- Mensaje de error si hay fallos en la autenticación -->
            <?php if (!empty($error)): ?>
                <div class="text-red-500 mb-4 text-center">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de inicio de sesión -->
            <form action="" method="POST" class="flex flex-col items-center">
                <div class="flex items-center mb-4 w-full">
                    <i class="fas fa-user mr-2 text-gray-500"></i>
                    <input type="email" name="correo" placeholder="Correo electrónico" class="border border-gray-300 p-2 rounded w-full" required>
                </div>
                <div class="flex items-center mb-6 w-full">
                    <i class="fas fa-lock mr-2 text-gray-500"></i>
                    <input type="password" name="contraseña" placeholder="Contraseña" class="border border-gray-300 p-2 rounded w-full" required>
                </div>
                <button type="submit" class="bg-green-500 text-white p-2 rounded w-full">INICIAR SESIÓN</button>
            </form>

            <a href="./contraseña/olvide_contra.php" class="text-sm text-blue-700 mt-4 text-center">¿Olvidaste tu contraseña?</a>
        </div>

        <div class="bg-white p-10 flex flex-col justify-center w-full lg:w-1/2">
            <img src="img/local.jpg" alt="Logo de Librería y Variedad L y M" class="w-80 mx-auto" width="400" height="400">
        </div>
    </div>
</body>
</html>

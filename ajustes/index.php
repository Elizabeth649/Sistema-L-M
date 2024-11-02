<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'inventario_lym');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener el nombre del negocio y la imagen
$sql = "SELECT nombre_negocio, imagen_negocio FROM ajustes WHERE id = 1";
$result = $conn->query($sql);

// Inicializar variables
$nombre_negocio = "LIBRERIA Y VARIEDADES LyM"; // Valor por defecto
$imagen_negocio = ''; // Inicializar como cadena vacía

// Obtener el nombre del negocio y la imagen
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre_negocio = $row['nombre_negocio'];
    $imagen_negocio = $row['imagen_negocio']; // URL de la imagen
}

// Asegurarse de que "$imagen_negocio" tenga un valor válido
if (empty($imagen_negocio)) {
    $imagen_negocio = 'img/logo.png'; // Ruta por defecto si no hay imagen
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBRERIA Y VARIEDADES LyM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-pink-100">
    <div class="flex items-center justify-between p-4">
        <i class="fas fa-bars text-2xl"></i>
        <h1 class="text-center text-2xl font-semibold"></h1>
        <i class="fas fa-user-circle text-2xl"></i>
    </div>
    <div class="flex">
        <div class="flex flex-col space-y-4 p-4">
            <a href="../dashboard.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-home"></i>
                <span>INICIO</span>
            </a>
            <a href="../categorias/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-list"></i>
                <span>CATEGORIAS</span>
            </a>
            <a href="../productos/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-box"></i>
                <span>PRODUCTOS</span>
            </a>
            <a href="../proveedores/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-truck"></i>
                <span>PROVEEDORES</span>
            </a>
            <a href="../ventas/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-shopping-cart"></i>
                <span>VENTAS</span>
            </a>
            <a href="../liquidacion/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-tags"></i>
                <span>LIQUIDACION</span>
            </a>
            <a href="../usuarios/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-user"></i>
                <span>USUARIOS</span>
            </a>
            <a href="" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-cog"></i>
                <span>AJUSTES</span>
            </a>
            <a href="../logout.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <span>CERRAR SESION</span>
            </a>
        </div>

        <div class="w-4/5 p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">MODIFICAR DATOS DEL NEGOCIO</h1>
            </div>
            <div class="bg-white p-8 rounded-lg w-1/2">
                <h2 class="flex items-center justify-center space-x-4 bg-pink-200 mb-6 py-2 text-lg font-bold text-gray-800">
                    DATOS DEL NEGOCIO
                </h2>
                <form method="POST" action="../ajustes/ajustes.php">
                    <!-- Campo para el nombre del negocio -->
                    <div class="mb-4">
                        <label for="nombre_negocio" class="block text-sm font-medium text-gray-700">Nombre del Negocio</label>
                        <input type="text" id="nombre_negocio" name="nombre_negocio" value="<?php echo htmlspecialchars($nombre_negocio); ?>"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Campo para ingresar la URL de la imagen del negocio -->
                    <div class="mb-4">
                        <label for="imagen_negocio" class="block text-sm font-medium text-gray-700">URL del Logo del Negocio</label>
                        <input type="text" id="imagen_negocio" name="imagen_negocio" value="<?php echo htmlspecialchars($imagen_negocio); ?>"
                               class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex justify-left">
                        <button type="submit" class="bg-green-500 text-black font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>

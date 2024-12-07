<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no hay sesión de usuario, redirigir a la página de inicio de sesión
    header("Location: index.php");
    exit();
}

// Conectar a la base de datos
$host = 'localhost'; // Cambia según tu configuración
$db = 'inventario_lym'; // Cambia al nombre de tu base de datos
$user = 'root'; // Cambia al usuario de tu base de datos
$pass = ''; // Cambia a la contraseña de tu base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}

// Consultas para obtener los datos
$cantidadProductos = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
$cantidadCategorias = $pdo->query("SELECT COUNT(*) FROM categorias")->fetchColumn();
$cantidadProveedores = $pdo->query("SELECT COUNT(*) FROM proveedores")->fetchColumn();
$cantidadVentas = $pdo->query("SELECT COUNT(*) FROM ventas")->fetchColumn();
$cantidadLiquidacion = $pdo->query("SELECT COUNT(*) FROM liquidacion")->fetchColumn();

// Consulta para productos a vencer
$fechaLimite = date('Y-m-d', strtotime('+30 days')); // Productos que venzan en los próximos 30 días
$queryProductosAVencer = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE fecha_vencimiento <= :fecha_limite AND fecha_vencimiento != '0000-00-00'");
$queryProductosAVencer->execute([':fecha_limite' => $fechaLimite]);
$cantidadProductosAVencer = $queryProductosAVencer->fetchColumn();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBRERIA Y VARIEDADES LyM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-pink-100">
    <div class="flex items-center justify-between p-4">
        <i class="fas fa-bars text-2xl"></i>
        <h1 class="text-center text-2xl font-semibold"></h1>
        <i class="fas fa-user-circle text-2xl"></i>
    </div>
    
    <div class="flex">
        <div class="flex flex-col space-y-4 p-4">
            <a href="dashboard.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-home"></i>
                <span>INICIO</span>
            </a>
            <a href="./categorias/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-list"></i>
                <span>CATEGORIAS</span>
            </a>
            <a href="./productos/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-box"></i>
                <span>PRODUCTOS</span>
            </a>
            <a href="./proveedores/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-truck"></i>
                <span>PROVEEDORES</span>
            </a>
            <a href="./ventas/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-shopping-cart"></i>
                <span>VENTAS</span>
            </a>
            <a href="./liquidacion/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-tags"></i>
                <span>LIQUIDACION</span>
            </a>
            <a href="./usuarios/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-user"></i>
                <span>USUARIOS</span>
            </a>
            <a href="./ajustes/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
                <i class="fas fa-cog"></i>
                <span>AJUSTES</span>
            </a>
            <a href="./videos de apoyo/index.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-300 text-black font-semibold py-2 px-4 rounded">
            <i class="fab fa-youtube"></i>
            <span>VIDEOS DE APOYO</span>
            </a>
            <a href="logout.php" class="flex items-center space-x-2 bg-pink-200 hover:bg-pink-200 text-black font-semibold py-2 px-4 rounded">
                <span>CERRAR SESION</span>
            </a>
        </div>

        <!-- Panel de control -->
        <div class="flex-grow p-6">
            <h2 class="text-2xl font-bold mb-4">Panel de Control</h2>
            
            <!-- Alerta de productos a vencer -->
            <?php if ($cantidadProductosAVencer > 0): ?>
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <strong>¡Atención!</strong> Tienes <?php echo $cantidadProductosAVencer; ?> productos que están por vencer en los próximos 30 días.
                </div>
            <?php else: ?>
                <div class="bg-green-500 text-white p-4 rounded mb-4">
                    <strong>Todo bien:</strong> No hay productos por vencer pronto.
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <a href="./productos/index.php" class="block bg-blue-500 text-white p-4 rounded-lg shadow-lg hover:bg-blue-600 text-center">
                    <i class="fas fa-box fa-2x mb-2"></i>
                    <h2 class="text-lg font-bold">Productos</h2>
                    <p>Cantidad: <?php echo $cantidadProductos; ?></p>
                </a>
                <a href="./categorias/index.php" class="block bg-green-500 text-white p-4 rounded-lg shadow-lg hover:bg-green-600 text-center">
                    <i class="fas fa-list fa-2x mb-2"></i>
                    <h2 class="text-lg font-bold">Categorías</h2>
                    <p>Cantidad: <?php echo $cantidadCategorias; ?></p>
                </a>
                <a href="./proveedores/index.php" class="block bg-yellow-500 text-white p-4 rounded-lg shadow-lg hover:bg-yellow-600 text-center">
                    <i class="fas fa-truck fa-2x mb-2"></i>
                    <h2 class="text-lg font-bold">Proveedores</h2>
                    <p>Cantidad: <?php echo $cantidadProveedores; ?></p>
                </a>
                <a href="./ventas/index.php" class="block bg-red-500 text-white p-4 rounded-lg shadow-lg hover:bg-red-600 text-center">
                    <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                    <h2 class="text-lg font-bold">Ventas</h2>
                    <p>Cantidad: <?php echo $cantidadVentas; ?></p>
                </a>
                <a href="./liquidacion/index.php" class="block bg-purple-500 text-white p-4 rounded-lg shadow-lg hover:bg-purple-600 text-center">
                    <i class="fas fa-tags fa-2x mb-2"></i>
                    <h2 class="text-lg font-bold">Liquidación</h2>
                    <p>Cantidad: <?php echo $cantidadLiquidacion; ?></p>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
